<?php

namespace App\Custom\Login\Anil;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken as Token;

class TokenProvider
{
    public string $token;
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->clear();
        $this->create();
    }

    public function clear()
    {
        Token::where('tokenable_id', [$this->user->id])->delete();
    }

    public function create()
    {
        $this->token = $this->user->createToken('example', ['role-admins'])
            ->plainTextToken;
    }

    public static function attempt(string $not_hashed, string $hashed): bool
    {
        return hash('sha256', $not_hashed) == $hashed;
    }
}
