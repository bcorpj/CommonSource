<?php

namespace App\Models;

use App\Http\Resources\CommonUI\InError\ServiceResource;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $fullname Name of user as "Surname N.F"
 * @property string $login
 * @property string $email
 * @property string|null $phone_number
 * @property string $password
 * @property boolean $LDAP
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLDAP($value)
 * @property-read \App\Models\Access|null $access
 * @property-read \App\Models\Admin|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $department
 * @property-read int|null $department_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Log[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $position
 * @property-read int|null $position_count
 * @property-read \App\Models\UserProperty|null $property
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'login',
        'email',
        'phone_number',
        'password',
        'LDAP'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function property(): HasOne
    {
        return $this->hasOne(UserProperty::class)->with('department', 'position');
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'user_services')->withPivot(['blocked'])->as('service_for');
    }

    public function department(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'user_properties');
    }

    public function position(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'user_properties');
    }

    public function access(): HasOne
    {
        return $this->hasOne(Access::class);
    }


    //

    public static function isActive (User $user): bool
    {
        try {
            return $user->property()->get()[0]->is_active;
        } catch (Exception $exception) {}
        return false;
    }

}
