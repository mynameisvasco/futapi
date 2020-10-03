<?php

namespace App\Domain\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Entities\ConfirmationPin
 *
 * @property-read \App\Domain\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $pin
 * @property \Illuminate\Support\Carbon $expires_at
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationPin whereUserId($value)
 */
class ConfirmationPin extends Model
{
    use HasFactory;

    protected $fillable = [
        "pin",
        "expires_at",
        "user_id"
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
