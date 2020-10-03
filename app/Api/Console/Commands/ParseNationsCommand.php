<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Actions\StoreNationAction;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ParseNationsCommand extends Command
{
    protected $signature = 'parse:nations';

    protected $description = 'Parse nations.';

    private IParser  $parser;

    public function __construct(IParser $parser)
    {
        $this->parser = $parser;
        parent::__construct();
    }

    public function handle()
    {
        $this->info("⌛️ Parsing nations...");
        $nations = $this->parser->parseNations();
        $this->info("✅  A total of {$nations->count()} nations were parsed with success!");
        $this->info("⌛️ Saving on database...");
        foreach ($nations as $nation) {
            $request = new Request();
            $request->setMethod("POST");
            $request->request->add($nation->attributesToArray());
            (new StoreNationAction())($request);
        }
        $this->info("✅  All nations saved to database");
        return 0;
    }
}
