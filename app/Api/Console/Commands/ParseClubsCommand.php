<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Actions\StoreClubAction;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ParseClubsCommand extends Command
{
    protected $signature = 'parse:clubs';

    protected $description = 'Parse clubs.';

    private IParser  $parser;

    public function __construct(IParser $parser)
    {
        $this->parser = $parser;
        parent::__construct();
    }

    public function handle()
    {
        $this->info("⌛️ Parsing clubs...");
        $clubs = $this->parser->parseClubs();
        $this->info("✅  A total of {$clubs->count()} clubs were parsed with success!");
        $this->info("⌛️ Saving on database...");
        foreach ($clubs as $club) {
            $request = new Request();
            $request->setMethod("POST");
            $request->request->add($club->attributesToArray());
            (new StoreClubAction())($request);
        }
        $this->info("✅  All clubs saved to database");
        return 0;
    }
}
