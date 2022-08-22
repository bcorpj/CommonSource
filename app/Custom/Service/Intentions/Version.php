<?php

namespace App\Custom\Service\Intentions;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class Version
{
    public static function toDirectory(float $version): string
    {
        return Str::replace('.', '_', (string) $version);
    }

    public static function getResource(Service $service, Serviceable $serviceable): string
    {
        $resource = class_basename($serviceable->resource());
        $version = static::toDirectory($service->version);
        return "App\\Http\\Resources\\$service->name\\V$version\\$resource";
    }
}
