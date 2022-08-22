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
     * @param string $resource
     * @param $model
     * @param bool $dynamic
     * @return void
     */
    public static function notify(string $resource, $model, bool $dynamic = true): void
    {
        $notifier = static::getNotifier($resource);
        new $notifier($resource, $model, $dynamic);
    }

    public static function getNotifier(string $serviceable): string
    {
        $data_service = (string) Str::of($serviceable)->before('DataResource')->afterLast('\\');
        return "App\\Custom\\Service\\Notify\\{$data_service}ServiceNotifier";
    }
}
