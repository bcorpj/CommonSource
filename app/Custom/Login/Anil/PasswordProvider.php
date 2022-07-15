<?php

namespace App\Custom\Login\Anil;

use App\Models\User;
use Illuminate\Support\Str;

class PasswordProvider
{
    public static function random (): string
    {
        return TokenProvider::hash( Str::random(16) );
    }

    public static function add (array $data): array
    {
        $data['password'] = self::random();
        return $data;
    }
}
