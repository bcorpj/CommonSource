<?php

namespace App\Http\Resources\Support\V0_1;

use App\Http\Resources\CommonUI\User\AccessResource;
use App\Http\Resources\CommonUI\User\DepartmentResource;
use App\Http\Resources\CommonUI\User\PositionResource;
use App\Http\Resources\CommonUI\User\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDataResource extends JsonResource
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
            'fullname' => $this->fullname,
            'login' => $this->login,
            'email' => $this->email,
//            'ldap' => $this->LDAP,
            'position' =>  new PositionResource($this->property->position),
//            'services' => ServiceResource::collection($this->services),
            'department' => new DepartmentResource ( $this->property->department ),
            'access' => new AccessResource( $this->access ),
            'is_admin' => (bool) $this->admin
        ];
    }
}
