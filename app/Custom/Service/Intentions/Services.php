<?php

namespace App\Custom\Service\Intentions;

use App\Custom\Service\Notify\ServiceNotifier;
use App\Custom\Service\Notify\UserServiceNotifier;
use App\Http\Resources\CommonUI\User\ServiceResource;
use App\Models\Service;
use App\Models\User;
use Str;

class Services
{
    /**
     * Function for finding Notifier handler by input Models.
     * @param string $serviceable
     * @param $model
     * @return void
     */
    public static function notify(string $serviceable, $model, bool $dynamic = true): void
    {
        $notifier = static::getNotifier($serviceable);
        new $notifier($serviceable, $model, $dynamic);
    }

    public static function getNotifier(string $serviceable): string
    {
        $data_service = (string) Str::of($serviceable)->before('DataService')->afterLast('\\');
        return "App\\Custom\\Service\\Notify\\{$data_service}ServiceNotifier";
    }
}
