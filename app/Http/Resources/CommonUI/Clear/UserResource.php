<?php

namespace App\Http\Resources\CommonUI\Clear;

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
            'ldap' => $this->LDAP,
            'is_admin' => (bool) $this->admin
        ];
    }
}
