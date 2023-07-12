<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [

            'id' => $this->id,
            'name' => $this->name,
            'logo'=> $this->logo,
            'description' => $this->description,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'video_url' => $this->video_url,
            'file' => $this->file,
            'price_rate' => $this->price_rate,
            'start_price' => $this->start_price,
            'branches' => BranchResource::collection($this->branches),


        ];
    }
}
