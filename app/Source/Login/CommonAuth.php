<?php

namespace App\Source\Login;

use App\Models\Department;
use App\Source\Login\Access\TokenProvider;
use App\Source\Login\Intention\ICommonAuth;
use App\Source\Login\Intention\Save;
use App\Source\Service\Intentions\Service;
use App\Source\Service\Resources\DepartmentServiceResource;
use App\Source\Service\Resources\UserServiceResource;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

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

//        dd( Service::produce(\App\Models\Service::all(), User::first()) );
        return response()->json( Service::notify(UserServiceResource::class, User::find(5)) );
//        Service::notify(DepartmentServiceResource::class, Department::find(1));
//        response()->json(Http::get('http://commonsource/api/free')->json())->throwResponse();

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
