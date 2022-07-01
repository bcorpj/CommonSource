<?php

namespace App\Custom\Login\Anil;

use App\Models\User;

class Save
{

    public static function in(User $user): array
    {
        $provider = new TokenProvider($user);

        return [
            'token' => $provider->token,
            'info' => $provider->user
        ];
    }
}
