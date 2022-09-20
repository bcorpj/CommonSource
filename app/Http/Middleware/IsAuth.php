<?php

namespace App\Http\Middleware;

use App\Models\Service;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Str;

class IsAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = PersonalAccessToken::findToken( /* Cut only token */ Str::after($request->header('authorization'), ' ') );
        $service = (bool) Service::query()->where('name', $request->get('service'))->count();

        if ($user and $service) /* If user is authenticated in [CS] and request login to service go to the next middleware */
            return $next($request);

        if ($service) /* if there is request to the other service but user is not authenticated return to LoginService component */
            return response()->json([
                'component' => 'LoginService',
                'service' => $request->get('service')
            ], 401);

        return response()->json([  /* return to login page if there is founded nothing */
            'component' => 'Login'
        ], 404);
    }
}
