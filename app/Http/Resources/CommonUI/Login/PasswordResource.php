<?php

namespace App\Http\Resources\CommonUI\Login;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PasswordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) /** @var User $request */
    {
        return [
            'password' => $request->password
        ];
    }
}
