<?php

namespace App\Http\Resources\CommonUI;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'fullname' => $this->fullname,
            'login' => $this->login,
            'position' =>  $this->property->position->name,
            'services' => ServiceResource::collection($this->services),
            'department' => new DepartmentResource ( $this->property->department ),
            'access' => new AccessResource( $this->access ),
            'is_admin' => (bool) $this->admin
        ];
    }
}
