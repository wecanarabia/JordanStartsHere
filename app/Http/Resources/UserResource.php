<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'        => $this->id,
            'name'      => $this->name,
            'last_name'   => $this->last_name,
            'active'      => $this->active,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'profile_image_id'=> $this?->profile?->id,
            'profile_image_id'=> $this?->profile?->image,

        ];
    }
}
