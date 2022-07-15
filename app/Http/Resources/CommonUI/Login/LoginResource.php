<?php

namespace App\Http\Resources\CommonUI\Login;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'is_admin' => (bool) $this->admin,
            'LDAP' => $this->LDAP
        ];
    }
}
