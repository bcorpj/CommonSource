<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserService
 *
 * @property int $id
 * @property int $user_id
 * @property int $blocked
 * @property int $service_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserService query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserService whereBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserService whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Service $service
 * @property-read \App\Models\User $user
 */
class UserService extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'blocked',
        'service_id',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }


    // UserService::query()->where('user_id', 1)->with('service', 'user')->get()[0]

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
