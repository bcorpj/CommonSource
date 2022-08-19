<?php

namespace App\Custom\Service\Type;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class SendType
{
    private Service $service;
    private JsonResource $resource;

    /**
     * @param Service $service
     * @param JsonResource $resource
     */
    public function __construct(Service $service, JsonResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    public function sync(): void
    {
        response()->json($this->service)->throwResponse();
    }


}
