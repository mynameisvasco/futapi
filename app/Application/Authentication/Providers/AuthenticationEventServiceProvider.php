<?php

namespace App\Application\Authentication\Providers;

use App\Application\Resources\Events\LoginEvent;
use App\Application\Resources\Events\RegisterEvent;
use App\Application\Resources\Events\RequestResetPasswordEvent;
use App\Application\Authentication\Listeners\NewSessionListener;
use App\Application\Authentication\Listeners\RequestResetPasswordListener;
use App\Application\Authentication\Listeners\VerifyAccountListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class AuthenticationEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        LoginEvent::class => [
            NewSessionListener::class
        ],
        RegisterEvent::class => [
            VerifyAccountListener::class
        ],
        RequestResetPasswordEvent::class => [
            RequestResetPasswordListener::class
        ]
    ];
}
