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
         * It will send JsonResource to service
         */
//        $fullRoute = URL::to('/') . '/api' . '/common/notify';
        $fullRoute = $this->getUrl($route);
//        dd($fullRoute);
        $resourceName = Str::of($this->resource::class)->afterLast('\\');
        $data = Http::withBody($this->resource->toJson(), 'application/json')
            ->withHeaders(['Resource' => (string) $resourceName, 'User-Id' => $this->service->service_for['external_user_id'] ?? null])
            ->post($fullRoute)
            ->json();

        return [$this->service, $data];
    }

    protected function getUrl(?string $route): string
    {
        return URL::to('/') . '/api' . $this->routes() [$route ?: 'notify'];
        return $this->service->url . '/api' . $this->routes() [$route ?: 'notify'];
    }

    abstract protected function routes (): array;



}
