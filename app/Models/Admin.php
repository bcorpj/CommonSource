<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property int $user_uuid
 * @property mixed $department_access
 * @property mixed $access
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereDepartmentAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUserUuid($value)
 * @mixin \Eloquent
 */
class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;
}
