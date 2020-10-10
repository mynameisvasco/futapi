<?php

namespace App\Application\Resources\Providers;

use App\Api\Http\Controllers\ResourcesController;
use App\Application\Common\Middleware\LimitRequests;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class ResourcesRoutesServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api/resources')
                ->middleware(["api", "auth:api", LimitRequests::class])
                ->namespace($this->namespace)
                ->group(function () {
                    Route::get("cards", [ResourcesController::class, "cards"]);
                    Route::post("card/price", [ResourcesController::class, "cardPrice"]);
                    Route::get("card/draw", [ResourcesController::class, "drawCard"]);
                    Route::get("nations", [ResourcesController::class, "nations"]);
                    Route::get("leagues", [ResourcesController::class, "leagues"]);
                    Route::get("clubs", [ResourcesController::class, "clubs"]);
                });
        });
    }
}
