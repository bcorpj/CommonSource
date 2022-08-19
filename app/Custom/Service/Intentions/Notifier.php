<?php

namespace App\Custom\Service\Intentions;

use App\Custom\Service\Type\SendType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use ReflectionClass;
use ReflectionException;

abstract class Notifier
{
    private Collection $services;

    private string $serviceable;

    private Model $model;

    /**
     * @throws ReflectionException
     */
    public function __construct (string $serviceable, Model $model)
    {
        $this->serviceable = $serviceable;
        $this->model = $model;
        $this->services = $this->list($model);
        $this->send();
    }

    /**
     * @throws ReflectionException
     */
    public function send (): void
    {
//        $se = new ReflectionClass($this->serviceable);
//        dd($se->getShortName());
        foreach ($this->services as $service)
        {
            (new SendType($service, (new $this->serviceable)->resource($this->model)
                          ))->sync();
        }
    }

    /**
     * Should return list of services
     * @param Model $model
     * @return Collection path to services by model
     */
    abstract protected function list (Model $model): Collection;
}
