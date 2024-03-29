<?php

namespace App\Source\Service\Intentions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;
use Str;

class Service
{
    /**
     * It is the main point to init and execute synchronizing with all the children services to notify changes
     *
     * When something changed in our model, we should notify services which use this resource.
     * We can call function Service::notify(App\Source\Service\Resources\NameResource::object, App\Model\Name::object, optional: Boolean dynamic(true))
     *
     * Classes in folder `App\Source\Service\Resources` should be empty. Third argument by default is true.
     * And it means that system will notify services by Version and its own Resource.
     *
     * If third argument is false we notify to all Services same Resource located in folder `App\Source\Service\Resources\`
     *
     * It Finds Notifier handler by input Models.
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


    /**
     * It is the main point to init and execute synchronizing with all the children services when something produced/created in model
     *
     * After something is created we should call this function to notify to children services bout what is produced in our Database
     *
     * First argument take the list of services where should produce data
     *
     * The Last two arguments is same with Service::notify
     *
     * @param Collection $service
     * @param Model $model
     * @param bool $dynamic
     * @return array
     */
    public static function produce(Collection $service, Model $model, bool $dynamic = true): array
    {
        $serviceable = static::getServiceableClass($model, 'create');
        $resource = self::getResourceClass($model);
        return $produceToService = ( new $serviceable($resource, $model, $dynamic, $service) )->send();
    }

    /**
     * Function to get full-path of Serviceable class
     * First argument forwards to getServiceableName() function
     *
     * @param $proxy
     * @param string|null $action
     * @return string
     */
    public static function getServiceableClass($proxy, ?string $action = null): string
    {
        $serviceable = static::getServiceableName($proxy);
        $action = Str::ucfirst($action);
        if (!$action)
            return "App\\Source\\Service\\Services\\{$serviceable}Services";

        return "App\\Source\\Service\\Services\\{$action}\\{$serviceable}Services";
    }

    /**
     * Return the name of Serviceable extended class by type
     *
     * @param $proxy
     * @return string
     */
    public static function getServiceableName($proxy): string
    {
        if (is_string($proxy))
            return Str::of($proxy)->before('ServiceResource')->afterLast('\\');
        else if ($proxy instanceof Model)
            return Str::of($proxy::class)->afterLast('\\')->before('Service');

        response()->json(['message' => 'Error in App\Source\Service\Intentions\Service::getServiceableName. Proxy type not found'], 404)->throwResponse();
    }

    /**
     * Return full-path of resource class by Model object
     *
     * @param Model $model
     * @return string
     */
    public static function getResourceClass(Model $model): string
    {
        $serviceableName = static::getServiceableName($model);
        return "App\\Source\\Service\\Resources\\{$serviceableName}ServiceResource";
    }

    /**
     * Return action type by Serviceable extended classname
     * Action types bound to folders in `App/Source/Service/Services`
     * By default classes in folder `App/Source/Service/Services` using to notifying action
     * Folder names located in `App/Source/Service/Services` means action type
     * For example `Create` or smt else
     *
     * @param string $serviceName
     * @return Stringable
     */
    public static function getActionType (string $serviceName): Stringable
    {
        return Str::of($serviceName)->after('\Services')->beforeLast('\\')->after('\\')->lower();
    }

}
