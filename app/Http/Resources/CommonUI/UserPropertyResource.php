<?php

namespace App\Http\Resources\CommonUI;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'position' => new PositionResource($this->position),
            'department' => new DepartmentResource($this->department),
            'profile_image' => $this->profile_image
        ];
    }
}
