<?php

namespace App\Models;

use App\Http\Resources\CommonUI\User\AdminResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

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
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUserId($value)
 * @property-read \App\Models\User $user
 */
class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'department_access',
        'access'
    ];

    protected $casts = [
        'department_access' => 'array',
        'access' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //

    public static function permissions (User $user): array
    {
        try {
            return array_keys( collect($user->admin()->get()[0]->access)->filter()->all() );
        } catch (\ErrorException $exception) {}
        return ['read'];
    }
}
