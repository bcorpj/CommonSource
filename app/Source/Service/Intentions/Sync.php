<?php

namespace App\Source\Service\Intentions;

use App\Models\Service;
use Http;
use Illuminate\Http\Resources\Json\JsonResource;
use Str;
use URL;

abstract class Sync
{
    protected Service $service;
    protected JsonResource $resource;

    /**
     * @param Service $service
     * @param JsonResource $resource
     */
    public function __construct(Service $service, JsonResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    public function sync(?string $route): array
    {
        /*
         * Will send JsonResource to service
         */
        $route = $this->routes() [$route] ?? '/common/notify';
//        $fullRoute = URL::to('/') . '/api' . $route;
        $fullRoute = $this->service->url . '/api' . $route;
        $resourceName = Str::of($this->resource::class)->afterLast('\\');
        $data = Http::withBody($this->resource->toJson(), 'application/json')
            ->withHeaders(['Resource' => (string) $resourceName, 'User-Id' => $this->service->service_for['external_user_id'] ?? null])
            ->post($fullRoute)
            ->json();

        return [$this->service, $data];
    }

    abstract protected function routes (): array;

}
