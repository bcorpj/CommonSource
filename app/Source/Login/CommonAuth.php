<?php

namespace App\Source\Login;

use App\Http\Requests\ServicePasswordRequest;
use App\Models\Department;
use App\Source\Login\Access\ServiceAccess;
use App\Source\Login\Access\TokenProvider;
use App\Source\Login\Intention\ICommonAuth;
use App\Source\Login\Intention\Save;
use App\Source\Service\Intentions\Service;
use App\Source\Service\Resources\DepartmentServiceResource;
use App\Source\Service\Resources\PasswordServiceResource;
use App\Source\Service\Resources\UserServiceResource;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Request;

class CommonAuth implements ICommonAuth
{
    public static User $user;

    public static function init(AuthRequest $request): JsonResponse
    {
        if ( !self::getUser($request) )
            return self::invalid();

        if ( !User::isActive(self::$user) )
            return self::not_active();

        if ( self::$user->LDAP )
            LDAP::init(self::$user);

        return self::validate($request);
    }

    public static function getUser(AuthRequest $request): User
    {
        return self::$user = User::where('login', $request->login)->first();
    }

    public static function validate(AuthRequest $request): JsonResponse
    {
        if ( !TokenProvider::attempt($request->password, self::$user->password) )
            return self::invalid();

//        return response()->json(Service::produce(\App\Models\Service::query()->where('id', 1)->get(), User::find(1)) );
//        return response()->json( Service::notify(UserServiceResource::class, User::find(5)) );
//        Service::notify(DepartmentServiceResource::class, Department::find(1));
//        response()->json(Http::get('http://commonsource/api/free')->json())->throwResponse();

        return response()->json(
            Save::in( self::$user )
        );
    }

    /**
     * This method receive a password and user id along service-key in header
     * It checks the system key, user by id
     *
     * Update CS password from LDAP calling LDAP::init() function, which will update password in everywhere
     *
     * Return boolean state of actuality of password
     *
     * @param ServicePasswordRequest $request
     * @return JsonResponse
     */
    public static function isActualPassword(ServicePasswordRequest $request): JsonResponse
    {
        ServiceAccess::validate();
        $data = $request->validated();
        $user = User::find($data['user_id']);

        if (!$user) return response()->json(['message' => 'Not found user by id'], 403);

        if ($user->LDAP) LDAP::init($user);

        if ($user->password != $data['password']) return response()->json(['isValid' => false]);

        return response()->json([
            'isValid' => true
        ]);

    }

    public static function invalid(): JsonResponse
    {
        return response()->json(['message' => 'Invalid login or password'], 401);
    }

    public static function not_active(): JsonResponse
    {
        return response()->json(['message' => 'Unreachable service', 'solution' => 'User is not active'], 403);
    }
}
