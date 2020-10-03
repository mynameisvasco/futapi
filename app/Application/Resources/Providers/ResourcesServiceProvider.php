<?php

namespace App\Application\Resources\Providers;

use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(ResourcesRoutesServiceProvider::class);
        $this->app->register(ResourcesEventServiceProvider::class);
    }
}
