<?php

namespace App\Api\Console\Commands;

use App\Application\Common\Interfaces\IParser;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;

class ParseAllCardsCommand extends Command
{
    protected $signature = 'parse:allCards';

    protected $description = 'Parse all cards available.';

    private IParser  $parser;

    public function __construct(IParser $parser)
    {
        $this->parser = $parser;
        parent::__construct();
    }

    public function handle()
    {
        $this->info("⌛️ Parsing all cards...");
        $processes = new Collection();
        for ($k = 402; $k <= 546; $k += 3) {
            $i = $k;
            while ($processes->count() < 3) {
                $process = new Process(['php', 'artisan', 'parse:cardsPage', $i]);
                $processes->add($process);
                $process->start();
                $i++;
            }
            $this->info("➡ Parsing pages ".($k)." to ".($k + 3 - 1));
            $running = true;
            while ($running) {
                $running = false;
                foreach ($processes as $runningProcess) {
                    if ($runningProcess->isRunning()) {
                        $running = true;
                        sleep(1);
                    }
                }
            }
            $processes = new Collection();
        }
        return 0;
    }
}
