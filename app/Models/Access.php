<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Access
 *
 * @property int $id
 * @property string $name
 * @property mixed $keys
 * @method static \Illuminate\Database\Eloquent\Builder|Access newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Access newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Access query()
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereKeys($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereName($value)
 * @mixin \Eloquent
 * @property mixed $department_access
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereDepartmentAccess($value)
 * @property int $user_property_id
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereUserPropertyId($value)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereUserId($value)
 * @property-read \App\Models\User|null $access
 */
class Access extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'keys',
        'department_access',
        'user_id'
    ];

    protected $casts = [
        'keys' => 'array',
        'department_access' => 'array'
    ];

    public function access(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
