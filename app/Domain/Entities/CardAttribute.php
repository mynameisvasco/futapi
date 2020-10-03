<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Entities\CardAttribute
 *
 * @property-read \App\Domain\Entities\Card $card
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $value
 * @property int $card_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute whereCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CardAttribute whereValue($value)
 */
class CardAttribute extends Model
{
    protected $fillable = [
        "name",
        "value",
        "card_id",
    ];

    protected $hidden = [
        "id",
        "created_at",
        "updated_at",
        "card_id"
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
