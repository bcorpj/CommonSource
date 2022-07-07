<?php

namespace App\Custom\Login;

use App\Custom\Login\Anil\ICommonAuth;
use App\Custom\Login\Anil\Save;
use App\Custom\Login\Anil\TokenProvider;
use App\Custom\Response\ShortResponse;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Faker\Provider\kk_KZ\Address;
use Illuminate\Http\JsonResponse;

class CommonAuth implements ICommonAuth
{
    public static ?User $user = null;

    public static function init(AuthRequest $request): JsonResponse
    {
        if ( !self::getUser($request) )
            return ShortResponse::json(['Invalid login or password']);

        if ( $request->login != self::$user->login )
            return ShortResponse::json(['Invalid login or password']);

        if ( self::$user->LDAP )
            LDAP::init(self::$user);

        return self::validate($request);
    }

    public static function getUser(AuthRequest $request): ?User
    {
        return self::$user = User::where('login', $request->login)->first();
    }

    public static function validate(AuthRequest $request): JsonResponse
    {
        if ( !TokenProvider::attempt($request->password, self::$user->password) )
            return ShortResponse::json(['Invalid login or password']);

        return ShortResponse::json(
            Save::in( self::$user )
        );
    }
}
