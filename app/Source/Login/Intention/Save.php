<?php

namespace App\Source\Login\Intention;

use App\Http\Resources\CommonUI\Login\LoginResource;
use App\Models\Service;
use App\Models\User;
use App\Source\Login\Access\TokenProvider;
use Request;
use Str;
use URL;

class Save
{

    public static function in(User $user): array
    {
        $token = (new TokenProvider($user))->token;

        $requestService = Str::ucfirst( Request::get('service') ); /* Get service name to give access and capitalize first letter */
        $service = Service::query()->where('name', $requestService); /* Get service model */

        /* If request has get property `service` */
        if ($service->count())
        {
            return [
                'token' => $token,
                'redirect' => URL::to('/access/login?service=' . $requestService),
                'info' => new LoginResource($user)
            ];
        }

        return [
            'token' => $token,
            'info' => new LoginResource($user)
        ];
    }
}
