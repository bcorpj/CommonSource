<?php

namespace App\Custom\Login;

use App\Custom\Login\Intention\ICommonAuth;
use App\Custom\Login\Intention\Save;
use App\Custom\Login\Intention\TokenProvider;
use App\Custom\Service\Intentions\Services;
use App\Custom\Service\Serviceable\UserDataService;
use App\Custom\Service\Temp;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use ReflectionException;

class CommonAuth implements ICommonAuth
{
    public static User $user;

    public static function init(AuthRequest $request): JsonResponse
    {
        if ( !self::getUser($request) )
            return self::invalid();

        if ( !User::is_active(self::$user) )
            return self::not_active();

        if ( self::$user->LDAP )
            LDAP::init(self::$user);

        return self::validate($request);
    }

    public static function getUser(AuthRequest $request): User
    {
        return self::$user = User::where('login', $request->login)->first();
    }

    /**
     * @throws ReflectionException
     */
    public static function validate(AuthRequest $request): JsonResponse
    {
        if ( !TokenProvider::attempt($request->password, self::$user->password) )
            return self::invalid();

        Services::notify(UserDataService::class, User::find(5));

        return response()->json(
            Save::in( self::$user )
        );
    }

    public static function invalid(): JsonResponse
    {
        return response()->json(['message' => 'Invalid login or password']);
    }

    public static function not_active(): JsonResponse
    {
        return response()->json(['message' => 'Unreachable service', 'solution' => 'User is not active']);
    }
}
