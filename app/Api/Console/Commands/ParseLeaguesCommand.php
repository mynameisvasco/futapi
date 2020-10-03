<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Actions\StoreLeagueAction;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ParseLeaguesCommand extends Command
{
    protected $signature = 'parse:leagues';

    protected $description = 'Parse leagues.';

    private IParser  $parser;

    public function __construct(IParser $parser)
    {
        $this->parser = $parser;
        parent::__construct();
    }

    public function handle()
    {
        $this->info("⌛️ Parsing leagues...");
        $leagues = $this->parser->parseLeagues();
        $this->info("✅  A total of {$leagues->count()} leagues were parsed with success!");
        $this->info("⌛️ Saving on database...");
        foreach ($leagues as $league) {
            $request = new Request();
            $request->setMethod("POST");
            $request->request->add($league->attributesToArray());
            (new StoreLeagueAction())($request);
        }
        $this->info("✅  All leagues saved to database");
        return 0;
    }
}
