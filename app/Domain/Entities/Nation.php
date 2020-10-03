<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Entities\Nation
 *
 * @property int $id
 * @property string $name
 * @property int $fifa_id
 * @property string $badge_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Nation[] $leagues
 * @property-read int|null $leagues_count
 * @method static \Illuminate\Database\Eloquent\Builder|Nation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nation whereBadgePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nation whereFifaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Nation extends Model
{
    protected $fillable = [
        "name",
        "fifa_id",
        "badge_path",
    ];
}
