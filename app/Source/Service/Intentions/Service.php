<?php

namespace App\Source\Service\Intentions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;
use Str;

class Service
{
    /**
     * Function for finding Notifier handler by input Models.
     * @param string $resource
     * @param $model
     * @param bool $dynamic
     * @return array
     */
    public static function notify(string $resource, $model, bool $dynamic = true): array
    {
        $serviceable = static::getServiceableClass($resource);
        return $notifyToService = ( new $serviceable($resource, $model, $dynamic) )->send();
    }

    public static function produce(Collection $service, Model $model, bool $dynamic = true): array
    {
        $serviceable = static::getServiceableClass($model, 'Create');
        $resource = self::getResourceClass($model);
        return $produceToService = ( new $serviceable($resource, $model, $dynamic, $service) )->send();
    }

    public static function getServiceableClass($proxy, ?string $action = null): string
    {
        $serviceable = static::getServiceableName($proxy);
        if (!$action)
            return "App\\Source\\Service\\Services\\{$serviceable}Services";

        return "App\\Source\\Service\\Services\\{$action}\\{$serviceable}Services";
    }

    public static function getServiceableName($proxy): string
    {
        if (is_string($proxy))
            return Str::of($proxy)->before('ServiceResource')->afterLast('\\');
        else if ($proxy instanceof Model)
            return Str::of($proxy::class)->afterLast('\\')->before('Service');

        response()->json(['message' => 'Error in App\Source\Service\Intentions\Service::getServiceableName. Proxy type not found'], 404)->throwResponse();
    }

    public static function getResourceClass(Model $model): string
    {
        $serviceableName = static::getServiceableName($model);
        return "App\\Source\\Service\\Resources\\{$serviceableName}ServiceResource";
    }

    public static function getActionType (string $serviceName): Stringable
    {
        return Str::of($serviceName)->after('\Services')->beforeLast('\\')->after('\\')->lower();
    }

}
