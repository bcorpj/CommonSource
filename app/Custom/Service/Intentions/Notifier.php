<?php

namespace App\Custom\Service\Intentions;

use App\Custom\Service\Type\SendType;
use App\Http\Resources\Contract\V0_1\DataResource;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use ReflectionClass;
use ReflectionException;
use Str;

abstract class Notifier
{
    private Collection $services;
    private Serviceable $serviceable;
    private bool $dynamic;
    private $model;

    public function __construct (string $serviceable, $model, bool $dynamic)
    {
        $this->serviceable = new $serviceable;
        $this->model = $model;
        $this->dynamic = $dynamic;
        $this->services = $this->list($model);
        $this->send();
    }

    public function send (): void
    {
        $res = [];
        foreach ($this->services as $service)
        {
            $resource = $this->dynamic ? Version::getResource($service, $this->serviceable) : $this->serviceable;
            if (class_exists($resource))
                $res[] = (new SendType($service, new $resource($this->model)
                          ))->sync();
        }
        response()->json($res)->throwResponse();

    }

    /**
     * Should return list of services
     * @param Model $model
     * @return Collection path to services by model
     */
    abstract protected function list (Model $model): Collection;
}
