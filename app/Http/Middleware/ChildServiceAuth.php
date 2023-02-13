<?php

namespace App\Http\Middleware;

use App\Models\Service;
use Closure;
use Illuminate\Http\Request;

class ChildServiceAuth
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
        $serviceName = $request->header('service-name');
        $serviceKey = $request->header('service-key');

        $service = Service::findByName($serviceName);

        if (!Service::assertKey($serviceKey, $service))
            return response()->json(['message' => 'Service key is wrong'], 401);

        return $next($request);
    }
}
