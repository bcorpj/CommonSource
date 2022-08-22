<?php

namespace App\Custom\Service\Serviceable;

use App\Custom\Service\Intentions\Serviceable;
use App\Custom\Service\Resources\DataResource;

class DataService implements Serviceable
{
    /**
     * @inheritDoc
     */
    public function resource(): string
    {
        return DataResource::class;
    }
}
