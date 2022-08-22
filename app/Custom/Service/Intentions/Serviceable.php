<?php

namespace App\Custom\Service\Intentions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

interface Serviceable
{
    /**
     * Should return JsonResource by given model
     * @return string
     */
    public function resource(): string;
}
