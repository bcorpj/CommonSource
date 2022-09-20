<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property int|null $owner Department owner ID
 * @property string $name Name of department
 * @property string $abbreviation Short name of department
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereOwner($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserProperty[] $users_properties
 * @property-read int|null $users_properties_count
 */
class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'owner',
        'name',
        'abbreviation'
    ];

    public function users_properties(): HasMany
    {
        return $this->hasMany(UserProperty::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_properties');
    }

}
