<?php

namespace App\Custom\Login\Anil;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken as Token;

class TokenProvider
{
    public string $token;
    public User $user;
    public static string $hash_type = 'sha256';

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->clear();
        $this->create($user);
    }

    public function clear()
    {
        Token::where('tokenable_id', [$this->user->id])->delete();
    }

    public function create(User $user)
    {
        if ($user->is_admin)
            $permission = 'common-admin';
        else
            $permission = 'common-user';

        $this->token = $this->user->createToken(env('APP_NAME'), [$permission])
            ->plainTextToken;
    }

    public static function attempt(string $not_hashed, string $hashed): bool
    {
        return hash(self::$hash_type, $not_hashed) == $hashed;
    }

    public static function hash(string $not_hashed)
    {
        return hash(self::$hash_type, $not_hashed);
    }

}
