<?php

namespace App\Custom\Service\Intentions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

interface Serviceable
{
    /**
     * Should return JsonResource by given model
     * @param Model $model
     * @return JsonResource
     */
    public function resource(Model $model): JsonResource;
}
