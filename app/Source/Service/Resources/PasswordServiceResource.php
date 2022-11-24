<?php

namespace App\Source\Service\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PasswordServiceResource extends JsonResource
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
            'password' => $this->password
        ];
    }
}
