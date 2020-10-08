<?php

namespace App\Support\Parsers;

use App\Application\Common\Interfaces\IParser;
use App\Domain\Entities\Card;
use App\Domain\Entities\CardAttribute;
use App\Domain\Entities\Club;
use App\Domain\Entities\League;
use App\Domain\Entities\Nation;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PHPHtmlParser\Dom;

class FutbinParser implements IParser
{
    private const baseUrl = "https://www.futbin.com";

    public function parseClubs(): Collection
    {
        $pageNum = 1;
        $clubs = new Collection();
        $dom = new Dom();
        while (true) {
            $dom->loadFromUrl(FutbinParser::baseUrl."/clubs?page={$pageNum}");
            $nodes = $dom->find("[class*=player_tr]");
            if ($nodes[0]->find("td")[0]->text == "No Results") {
                break;
            }
            foreach ($nodes as $node) {
                $node = $node->find("td");
                $club = new Club();
                $club->name = $node->find("a")->text ?? "";
                $club->badge_path = urldecode($node->find("img")->getAttribute("src") ?? "");
                $club->fifa_id = intval(Str::replaceFirst(".png", "", Str::afterLast($club->badge_path, "/")));
                $clubs->add($club);
            }
            $pageNum++;
        }
        return $clubs;
    }

    public function parseNations(): Collection
    {
        $pageNum = 1;
        $nations = new Collection();
        $dom = new Dom();
        while (true) {
            $dom->loadFromUrl(FutbinParser::baseUrl."/nations?page={$pageNum}");
            $nodes = $dom->find("[class*=player_tr]");
            if ($nodes[0]->find("td")[0]->text == "No Results") {
                break;
            }
            foreach ($nodes as $node) {
                $node = $node->find("td");
                $nation = new Nation();
                $nation->name = $node->find("a")->text ?? "";
                $nation->badge_path = urldecode($node->find("img")->getAttribute("src") ?? "");
                $nation->fifa_id = intval(Str::replaceFirst(".png", "", Str::afterLast($nation->badge_path,
                    "/")));
                $nations->add($nation);
            }
            $pageNum++;
        }
        return $nations;
    }

    public function parseLeagues(): Collection
    {
        $pageNum = 1;
        $leagues = new Collection();
        $dom = new Dom();
        while (true) {
            $dom->loadFromUrl(FutbinParser::baseUrl."/leagues?page={$pageNum}");
            $nodes = $dom->find("[class*=player_tr]");
            if ($nodes[0]->find("td")[0]->text == "No Results") {
                break;
            }
            foreach ($nodes as $node) {
                $node = $node->find("td");
                $league = new League();
                $league->name = $node->find("a")->text ?? "";
                $league->badge_path = urldecode($node->find("img")->getAttribute("src") ?? "");
                $league->fifa_id = intval(Str::replaceFirst(".png", "", Str::afterLast($league->badge_path,
                    "/")));
                $leagues->add($league);
            }
            $pageNum++;
        }
        return $leagues;
    }

    public function parseAllCards(int $pageNum): Collection
    {
        $cards = new Collection();
        $dom = new Dom();
        $dom->loadFromUrl(FutbinParser::baseUrl."/players?page={$pageNum}");
        $nodes = $dom->find("[class*=player_tr]");
        if ($nodes[0]->text == "No Results") {
            return $cards;
        }
        foreach ($nodes as $node) {
            $node = $node->find(".table-row-text");
            $card = $this->parseCard($node->find("a")->getAttribute("href"));
            $cards->add($card);
        }
        return $cards;
    }

    public function parseLatestCards(Carbon $latestAddedDate): Collection
    {
        $cards = new Collection();
        $dom = new Dom();
        $dom->loadFromUrl(FutbinParser::baseUrl."/latest");
        $nodes = $dom->find("[class*=player_tr]");
        foreach ($nodes as $node) {
            $addedOn = Carbon::parse($node->find("td")[9]->text);
            if ($latestAddedDate->isAfter($addedOn) or $latestAddedDate->isSameDay($addedOn)) {
                break;
            }
            $node = $node->find(".table-row-text");
            $card = $this->parseCard($node->find("a")->getAttribute("href"));
            $cards->add($card);
        }
        return $cards;
    }

    public function parseCard(string $link): Card
    {
        $infoOffset = 0;
        $card = new Card();
        $dom = new Dom();
        $dom->loadFromUrl(FutbinParser::baseUrl.$link);
        $infoTable = $dom->find("#info_content td");
        $pageInfo = $dom->find("#page-info")[0];
        $playerCard = $dom->find("#Player-card")[0];
        $mainStatsValues = $dom->find("[class*=main] > .stat_val");
        $mainStatsNames = $dom->find("[class*=main] > .stat_holder_main");
        $otherStatsValues = $dom->find(".sub_stat > .stat_val");
        $otherStatsNames = $dom->find(".sub_stat > .stat_holder_sub");
        $card->name = $infoTable[0]->text ?? "";
        $card->skills = intval(trim($infoTable[4]->text) ?? 0);
        $card->weak_foot = intval(trim($infoTable[5]->text ?? 0));
        if (!is_numeric(trim($infoTable[6]->text))) {
            $infoOffset = -1;
        }
        $card->foot = trim($infoTable[7 + $infoOffset]->text ?? "");
        $card->height = trim($infoTable[8 + $infoOffset]->text ?? "");
        $card->weight = trim($infoTable[9 + $infoOffset]->text ?? "");
        $card->def_work_rate = trim($infoTable[11 + $infoOffset]->text ?? "");
        $card->att_work_rate = trim($infoTable[12 + $infoOffset]->text ?? "");
        $card->rating = intval($dom->find(".pcdisplay-rat")[0]->text ?? 0);
        $card->display_name = $dom->find(".pcdisplay-name")[0]->text ?? "";
        $card->face_path = urldecode($dom->find(".pcdisplay-picture-width")[0]->getAttribute("src") ?? "");
        $card->rare_type = intval($playerCard->getAttribute("data-rare-type") ?? 0);
        $card->level = $playerCard->getAttribute("data-level") ?? "";
        $card->resource_id = intval($pageInfo->getAttribute("data-player-resource") ?? 0);
        $card->base_id = intval($pageInfo->getAttribute("data-baseid") ?? 0);
        $card->nation_id = intval($pageInfo->getAttribute("data-nation") ?? 0);
        $card->league_id = intval($pageInfo->getAttribute("data-league") ?? 0);
        $card->club_id = intval($pageInfo->getAttribute("data-club") ?? 0);
        $card->position = $pageInfo->getAttribute("data-position") ?? "";

        for ($i = 0; $i < $mainStatsNames->count(); $i++) {
            $attribute = new CardAttribute();
            try {
                $attribute->name = trim($mainStatsNames[$i]->find("span")->text);
                $attribute->value = intval(trim($mainStatsValues[$i]->find(".stat_val")->text) ?? 0);
            } catch (\Exception $e) { //Goal Keepers do not have a span inside the stat div
                $attribute->name = trim($mainStatsNames[$i]->text);
                $attribute->value = intval(trim($mainStatsValues[$i]->text) ?? 0);
            }
            $card->attributes->add($attribute);
        }

        for ($i = 0; $i < $otherStatsNames->count(); $i++) {
            $attribute = new CardAttribute();
            try {
                $attribute->name = trim($otherStatsNames[$i]->find("span")->text);
                $attribute->value = intval(trim($otherStatsValues[$i]->find(".stat_val")->text) ?? 0);
            } catch (\Exception $e) {
                $attribute->name = trim($otherStatsNames[$i]->text);
                $attribute->value = intval(trim($otherStatsValues[$i]->text) ?? 0);
            }
            if ($attribute->value != 0) {
                $card->attributes->add($attribute);
            }
        }

        return $card;
    }
}
