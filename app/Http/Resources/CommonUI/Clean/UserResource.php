<?php

namespace App\Http\Resources\CommonUI\Clean;

use App\Custom\Additional\Relations;
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
            'is_admin' => (bool) $this->admin,
            'is_active' => (bool) Relations::has($this->property, 'is_active')
        ];
    }
}
