<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Entities\ResourcesController
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $rating
 * @property int $rare_type
 * @property int $weak_foot
 * @property int $weight
 * @property int $height
 * @property string $position
 * @property string $display_name
 * @property string $level
 * @property int $foot
 * @property string $def_work_rate
 * @property string $att_work_rate
 * @property string $name
 * @property string $face_path
 * @property int $club_id
 * @property int $nation_id
 * @property int $league_id
 * @property int $skills
 * @property int $baseId
 * @property int $resourceId
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Entities\CardAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \App\Domain\Entities\Club $club
 * @property-read \App\Domain\Entities\League $league
 * @property-read \App\Domain\Entities\Nation $nation
 * @method static \Illuminate\Database\Eloquent\Builder|Card newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card query()
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereAttWorkRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereBaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereDefWorkRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereFacePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereFoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereNationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereRareType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereWeakFoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereWeight($value)
 * @mixin \Eloquent
 * @property int $base_id
 * @property int $resource_id
 */
class Card extends Model
{
    protected $fillable = [
        "rating",
        "rare_type",
        "weak_foot",
        "weight",
        "height",
        "position",
        "display_name",
        "level",
        "foot",
        "def_work_rate",
        "att_work_rate",
        "name",
        "face_path",
        "club_id",
        "nation_id",
        "league_id",
        "skills",
        "base_id",
        "resource_id"
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function nation()
    {
        return $this->belongsTo(Nation::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function attributes()
    {
        return $this->hasMany(CardAttribute::class);
    }
}
