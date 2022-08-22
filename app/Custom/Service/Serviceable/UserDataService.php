<?php

namespace App\Custom\Service\Serviceable;

use App\Custom\Service\Intentions\Serviceable;
use App\Custom\Service\Resources\UserDataResource;

class UserDataService implements Serviceable
{
    /**
     * @return string
     */
    public function resource(): string
    {
        return UserDataResource::class;
    }
}
