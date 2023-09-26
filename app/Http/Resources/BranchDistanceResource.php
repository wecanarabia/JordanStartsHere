<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchDistanceResource extends JsonResource
{

    // public function __construct($resource, $distance = null)
    // {
    //     $this->distance = $distance;

    //     parent::__construct($resource);
    // }


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
            // 'distance' => $this->when(isset($this->distance), $this->distance),
            'area_id' => $this->area?->id,
            'area_name' => $this->area?->name,
            'city_id' => $this->area?->city?->id,
            'city_name' => $this->area?->city?->name,
            // 'partner_id' => $this?->partner?->id,
            // 'partner_name' => $this?->partner?->name,
            'partner'=>new PartnerDistResource($this->partner),
            // 'partner_id' => $this?->partner?->id,
            // 'partner_name' => $this?->partner?->name,
            // 'partner_logo'=> $this?->partner?->logo,
            // 'partner_description' => $this?->partner?->description,
            // 'partner_phone' => $this?->partner?->phone,
            // 'partner_whatsapp' => $this?->partner?->whatsapp,
            // 'partner_video_url' => $this?->partner?->video_url,
            // 'partner_file' => $this?->partner?->file,
            // 'partner_price_rate' => $this?->partner?->price_rate,
            // 'partner_start_price' => $this?->partner?->start_price,
            // 'partner_rating'=>(double)$this?->partner?->reviews?->avg('points'),
            // 'partner_category' => $this?->partner?->subcategories?->first()?->category?->name ?? null,
            // 'partner_category_image' => $this?->partner?->subcategories?->first()?->category?->image ?? null,
            // 'partner_branches' => BranchResource::collection($this?->partner?->branches),
            // 'partner_portrait_images' => PortraitImageResource::collection($this?->partner?->portraits),
            // 'partner_landscape_images' => LandscapeImageResource::collection($this?->partner?->landscapes),
            // 'partner_workdays' => WorkdayResource::collection($this?->partner?->workdays),
            // 'partner_reviews' => ReviewResource::collection($this?->partner?->reviews),



        ];
    }
}
