<?php

namespace App\Custom\Service\Serviceable;

use App\Custom\Service\Intentions\Serviceable;
use App\Custom\Service\Resources\DepartmentDataResource;

class DepartmentDataService implements Serviceable
{
    /**
     * @inheritDoc
     */
    public function resource(): string
    {
        return DepartmentDataResource::class;
    }
}
