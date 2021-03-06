<?php

namespace App\Application\Resources\Listeners;

use App\Application\Resources\Events\StoredCardEvent;
use App\Application\Resources\Notifications\StoredCardNotification;
use App\Domain\Entities\User;

class NotifyStoredCardListener
{
    public function handle(StoredCardEvent $event)
    {
        $admins = User::with('role')->where('role.name', 'admin');
        foreach ($admins as $admin) {
            $admin->notify(new StoredCardNotification($event->card));
        }
    }
}
