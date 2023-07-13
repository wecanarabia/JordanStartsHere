<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerSubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'=>$this->id,
            // 'user'=>$this->user->id,
            // 'advertisement'=>$this->advertisement->id,
            'partner'=>new PartnerResource($this->partner),
            'subcategory'=>new SubcategoryResource($this->subcategory)
        ]

        ;
    }
}
