<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Entities\League
 *
 * @property int $id
 * @property string $name
 * @property int $fifa_id
 * @property string $badge_path
 * @property int $nation_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Entities\Club[] $clubs
 * @property-read int|null $clubs_count
 * @property-read \App\Domain\Entities\Nation $nation
 * @method static \Illuminate\Database\Eloquent\Builder|League newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|League newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|League query()
 * @method static \Illuminate\Database\Eloquent\Builder|League whereBadgePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereFifaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereNationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class League extends Model
{
    protected $fillable = [
        "name",
        "fifa_id",
        "badge_path",
    ];
}
