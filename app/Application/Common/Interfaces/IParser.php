<?php

namespace App\Application\Common\Interfaces;

use App\Domain\Entities\Card;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface IParser
{
    public function parseCard(string $link): Card;

    public function parseAllCards(int $pageNum): Collection;

    public function parseClubs(): Collection;

    public function parseNations(): Collection;

    public function parseLeagues(): Collection;

    public function parseLatestCards(Carbon $latestAddedDate): Collection;
}

