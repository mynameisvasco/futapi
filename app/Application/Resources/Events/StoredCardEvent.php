<?php

namespace App\Application\Resources\Events;

use App\Domain\Entities\Card;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoredCardEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Card $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }
}
