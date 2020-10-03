<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Entities\Club
 *
 * @property int $id
 * @property string $name
 * @property int $fifa_id
 * @property string $badge_path
 * @property int $league_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domain\Entities\League $league
 * @property-read \App\Domain\Entities\Nation $nation
 * @method static \Illuminate\Database\Eloquent\Builder|Club newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Club newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Club query()
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereBadgePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereFifaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Club extends Model
{
    protected $fillable = [
        "name",
        "fifa_id",
        "badge_path",
    ];
}
