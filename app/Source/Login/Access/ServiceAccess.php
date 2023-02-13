<?php

namespace App\Source\Login\Access;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceAccess
{

    /**
     * Check Service key
     * @return bool
     */
    public static function check(): bool
    {
        $request = app(Request::class);
        $appKey = $request->header('Service-Key');
        $appName = $request->header('Service-Name');
        return (bool) Service::query()->where('key', $appKey)->where('name', $appName)->get()->count();
    }

    /**
     * Service authenticate
     * @return void
     */
    public static function validate(): void
    {
        if (!self::check()) response()->json(['message' => 'Not valid service key'], 403)->throwResponse();
    }
}
