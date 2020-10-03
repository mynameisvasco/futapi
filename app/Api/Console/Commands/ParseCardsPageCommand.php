<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Actions\StoreCardAction;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ParseCardsPageCommand extends Command
{
    protected $signature = 'parse:cardsPage {page}';

    protected $description = 'Parse cards available.';

    private IParser  $parser;

    public function __construct(IParser $parser)
    {
        $this->parser = $parser;
        parent::__construct();
    }

    public function handle()
    {
        $cards = $this->parser->parseAllCards($this->argument("page"));
        foreach ($cards as $card) {
            $request = new Request();
            $request->setMethod("POST");
            $request->request->add($card->jsonSerialize());
            (new StoreCardAction())($request);
        }
        return 0;
    }
}
