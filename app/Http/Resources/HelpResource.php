<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HelpResource extends JsonResource
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
            'agency'      => $this->agency,
            'logo'   => $this->logo,
            'phone'     => $this->phone,
            'whatsapp'=> $this?->whatsapp,

        ];
    }
}
