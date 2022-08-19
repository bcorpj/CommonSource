<?php

namespace App\Custom\Service\Notify;

use App\Custom\Service\Intentions\Notifier;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class ServicesNotifier extends Notifier
{
    /**
     * Return path to services by model
     * @param Service $model
     * @return array
     */
    protected function list(Model $model): array
    {
        return $model->toArray();
    }
}
