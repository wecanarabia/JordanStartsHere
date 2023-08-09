<?php

namespace App\Http\Resources;

use Auth;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Resources\BranchResource;
use App\Http\Resources\WorkdayResource;
use App\Http\Resources\PortraitImageResource;
use App\Http\Resources\LandscapeImageResource;
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

        $fav = false;
        if(Auth::user()){
            dd('auth');
        $favorite = Favorite::where('user_id',Auth::user()->id)->where('partner_id',$this->id)->first();
            if($favorite){
                $fav = true ;
            }
        }

        return [

            'id' => $this->id,
            'is_favorite'=>$fav,
            'name' => $this->name,
            'logo'=> $this->logo,
            'description' => $this->description,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'video_url' => $this->video_url,
            'file' => $this->file,
            'price_rate' => $this->price_rate,
            'start_price' => $this->start_price,
            'rating'=>(double)$this?->reviews?->avg('points'),
            'category' => $this?->subcategories?->first()?->category?->name ?? null,
            'category_image' => $this?->subcategories?->first()?->category?->image ?? null,
            'branches' => BranchResource::collection($this?->branches),
            'portrait_images' => PortraitImageResource::collection($this?->portraits),
            'landscape_images' => LandscapeImageResource::collection($this?->landscapes),
            'workdays' => WorkdayResource::collection($this?->workdays),
            'reviews' => ReviewResource::collection($this?->reviews),
        ];
    }
}
