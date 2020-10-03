<?php

namespace App\Application\Resources\Notifications;

use App\Domain\Entities\Card;
use App\Domain\Entities\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;

class StoredCardNotification extends Notification
{
    use Queueable;

    public Card $card;
    public Carbon $deliverTime;

    public function __construct(Card $card)
    {
        $this->card = $card;
        $this->deliverTime = Carbon::now();
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram(User $notifiable)
    {
        return TelegramFile::create()
            ->to($notifiable->telegram_user_id)
            ->content("{$this->card->display_name} ({$this->card->rating}) {$this->card->position} added to database at {$this->deliverTime->format("jS \o\f F, Y g:i:s a")}")
            ->file($this->card->face_path, 'photo');
    }
}
