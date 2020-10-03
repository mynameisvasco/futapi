<?php

namespace App\Application\Resources\Providers;

use App\Api\Http\Controllers\ResourcesController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class ResourcesRoutesServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->routes(fn() => Route::prefix('api/resources')
            ->middleware(["api", "auth:api"])
            ->namespace($this->namespace)
            ->group(function () {
                Route::get("cards", [ResourcesController::class, "cards"]);
                Route::get("nations", [ResourcesController::class, "nations"]);
                Route::get("leagues", [ResourcesController::class, "leagues"]);
                Route::get("clubs", [ResourcesController::class, "clubs"]);
            }));
    }
}
