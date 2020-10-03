<?php

namespace App\Api\Console\Commands;

use App\Domain\Entities\User;
use Illuminate\Console\Command;

class ResetAllUsersTodayRequestsCommand extends Command
{
    protected $signature = 'users:resetAllTodayRequests';

    protected $description = 'Parse nations.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info("⌛️ Resetting user's today requests...");
        User::query()->update(["num_requests_today" => 0]);
    }
}
