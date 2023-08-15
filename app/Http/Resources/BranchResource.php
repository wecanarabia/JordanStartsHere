<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'lat' => $this->lat,
            'long' => $this->long,
            'location' => $this->location,
            'area_id' => $this->area?->id,
            'area_name' => $this->area?->name,
            'city_id' => $this->area?->city?->id,
            'city_name' => $this->area?->city?->name,
            'partner_id' => $this?->partner?->id,
            'partner_name' => $this?->partner?->name,
            'category' => $this?->partner?->subcategories?->first()?->category?->name ?? null,
            'category_image' => $this?->partner?->subcategories?->first()?->category?->image ?? null,



        ];
    }
}
