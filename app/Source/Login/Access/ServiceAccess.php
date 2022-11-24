<?php

namespace App\Source\Login\Access;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceAccess
{
    public static function check(): bool
    {
        $appKey = app(Request::class)->header('Service-Key');
        return (bool) Service::query()->where('key', $appKey)->get()->count();
    }

    public static function validate(): void
    {
        if (!self::check()) response()->json(['message' => 'Not valid service key'], 403)->throwResponse();
    }
}
