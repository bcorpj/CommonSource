<?php

namespace App\Custom\Login\Intention;

use App\Http\Resources\CommonUI\Login\LoginResource;
use App\Models\User;

class Save
{

    public static function in(User $user): array
    {
        $provider = new TokenProvider($user);

        return [
            'token' => $provider->token,
            'info' => new LoginResource($user)
        ];
    }
}
