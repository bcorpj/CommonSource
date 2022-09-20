<?php

namespace App\Source\Service\Services;

use App\Source\Service\Intentions\Serviceable;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserServices extends Serviceable
{
    /**
     * @param User $model
     * @return Collection
     */
    protected function list($model): Collection
    {
        return $model->services()->get();
    }
}
