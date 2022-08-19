<?php

namespace App\Custom\Service\Intentions;

use App\Custom\Service\Notify\ServicesNotifier;
use App\Custom\Service\Notify\UserServicesNotifier;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use ReflectionException;

class Services
{
    /**
     * Method for finding Notifier handler by input Models.
     * @param string $serviceable
     * @param Model $model
     * @return void
     * @throws ReflectionException
     */
    public static function notify(string $serviceable, Model $model): void
    {
        if ($model instanceof User){
            new UserServicesNotifier($serviceable, $model);
        } elseif ($model instanceof Service) {
            new ServicesNotifier($serviceable, $model);
        }
    }
}
