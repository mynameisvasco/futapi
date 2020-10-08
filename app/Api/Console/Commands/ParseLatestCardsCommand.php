<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Actions\StoreCardAction;
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
        $fromIndex = 0;
        $toIndex = 2;
        $alreadyOnDatabase = false;
        while (!$alreadyOnDatabase) {
            $cards = $this->parser->parseLatestCards($fromIndex, $toIndex);
            $this->info("➡️  A total of {$cards->count()} new cards were parsed");
            foreach ($cards as $card) {
                $request = new Request();
                $request->setMethod("POST");
                $request->request->add($card->jsonSerialize());
                $response = (new StoreCardAction())($request);
                if ($response->getData()["isAlreadyOnDatabase"]) {
                    $alreadyOnDatabase = true;
                }
            }
            $fromIndex += $toIndex + 1;
            $toIndex += 3;
        }
        return 0;
    }
}
