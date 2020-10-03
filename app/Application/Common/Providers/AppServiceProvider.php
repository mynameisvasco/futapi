<?php

namespace App\Application\Common\Providers;

use App\Application\Authentication\Providers\AuthenticationServiceProvider;
use App\Application\Resources\Providers\CardServiceProvider;
use App\Application\Common\Interfaces\IParser;
use App\Application\Resources\Providers\ResourcesServiceProvider;
use App\Application\User\Providers\UserServiceProvider;
use App\Support\Parsers\FutbinParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AuthenticationServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
        $this->app->register(ResourcesServiceProvider::class);
        $this->app->bind(IParser::class, FutbinParser::class);
    }
}
