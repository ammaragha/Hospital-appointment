<?php

namespace App\Http\Resources\Reservation;

use App\Http\Resources\Speciality\SpecialityResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'speciality' => new SpecialityResource($this->sepciality),
            'time' => $this->time,
            'date' => $this->date,
            'status' => $this->status
        ];
    }
}
