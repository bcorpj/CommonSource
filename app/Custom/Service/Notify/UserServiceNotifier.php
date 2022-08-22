<?php

namespace App\Custom\Service\Notify;

use App\Custom\Service\Intentions\Notifier;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserServiceNotifier extends Notifier
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
