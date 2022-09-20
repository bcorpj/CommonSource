<?php

namespace App\Source\Service\Sync;

use App\Source\Service\Intentions\Sync;

class ServiceSync extends Sync
{
    /**
     * @return array
     */
    protected function routes(): array
    {
        return [
            'create' => '/common/produce'
        ];
    }
}
