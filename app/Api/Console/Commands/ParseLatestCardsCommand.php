<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Actions\StoreCardAction;
use App\Domain\Entities\Card;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ParseLatestCardsCommand extends Command
{
    protected $signature = 'parse:latestCards';

    protected $description = 'Parse latest cards available.';

    private IParser  $parser;

    public function __construct(IParser $parser)
    {
        $this->parser = $parser;
        parent::__construct();
    }

    public function handle()
    {
        $this->info("⌛️ Parsing latest cards...");
        $latestAddedDate = Card::latest()->first()->created_at;
        $cards = $this->parser->parseLatestCards($latestAddedDate);
        $this->info("➡️  A total of {$cards->count()} new cards were parsed");
        foreach ($cards as $card) {
            $request = new Request();
            $request->setMethod("POST");
            $request->request->add($card->jsonSerialize());
            (new StoreCardAction())($request);
        }
        return 0;
    }
}
