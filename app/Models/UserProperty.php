<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class UserProperty extends Model
{
    use HasFactory;

    public $timestamps = false;
}
