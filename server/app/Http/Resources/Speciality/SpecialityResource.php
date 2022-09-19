<?php

namespace App\Http\Resources\Speciality;

use App\Http\Resources\Doctor\DoctorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecialityResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'doctors'=> DoctorResource::collection($this->doctors),
        ];
    }
}
