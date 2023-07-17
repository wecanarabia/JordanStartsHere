<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[

            'id'=>$this->id,
            'content'=>$this->content,
            'points'=>$this->points,
            'status'=>$this->status,
            'user'=>new UserResource($this->user),
            'partner_id'=>$this->partner?->id,
            // 'partner'=>new PartnerResource($this->partner)

        ];
    }
}
