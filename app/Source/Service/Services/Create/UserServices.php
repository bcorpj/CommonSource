<?php

namespace App\Source\Service\Services\Create;

use App\Source\Service\Intentions\Serviceable;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserServices extends Serviceable
{
    /**
     * @param User $model
     * @return Collection
     */
    protected function list($model): Collection
    {
        return $model->get();
    }
}
