<?php

namespace App\Application\Resources\Providers;

use App\Application\Resources\Events\StoredCardEvent;
use App\Application\Resources\Listeners\NotifyStoredCardListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class ResourcesEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        StoredCardEvent::class => [
            NotifyStoredCardListener::class
        ]
    ];
}
