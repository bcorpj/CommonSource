<?php

namespace App\Source\Login\Intention;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

interface ICommonAuth
{
    static function init(AuthRequest $request): JsonResponse;
    static function getUser(AuthRequest $request): ?User;
    static function validate(AuthRequest $request): JsonResponse;
}
