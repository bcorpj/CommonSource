<?php

namespace App\Custom\Service\Serviceable;

use App\Custom\Service\Intentions\Serviceable;
use App\Http\Resources\Support\V0_1\UserDataResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDataService implements Serviceable
{
    /**
     * @param User $model
     * @return JsonResource
     */
    public function resource(Model $model): JsonResource
    {
        return new UserDataResource($model);
    }
}
