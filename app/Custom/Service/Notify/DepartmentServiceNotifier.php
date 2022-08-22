<?php

namespace App\Custom\Service\Notify;

use App\Custom\Service\Intentions\Notifier;
use App\Http\Resources\Contract\V0_1\DataResource;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class DepartmentServiceNotifier extends Notifier
{
    /**
     * Return path to services by model
     * @param Service $model
     * @return Collection
     */
    protected function list($model): Collection
    {
        return Service::find(2)->get();
    }
}
