<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserProperty
 *
 * @property int $id
 * @property int|null $position_id
 * @property int|null $department_id
 * @property int|null $access_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty whereAccessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $profile_image
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty whereProfileImage($value)
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|UserProperty whereIsActive($value)
 */
class UserProperty extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'position_id',
        'department_id',
        'user_id',
        'profile_image',
        'is_active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }



//    public function user(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function position(): BelongsTo
//    {
//        return $this->belongsTo(Position::class);
//    }
//
//    public function department(): BelongsTo
//    {
//        return $this->belongsTo(Department::class);
//    }





}
