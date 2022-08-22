<?php

namespace App\Http\Resources\Support\V0_1;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentDataResource extends JsonResource
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
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'id' => $this->id,
        ];
    }
}
