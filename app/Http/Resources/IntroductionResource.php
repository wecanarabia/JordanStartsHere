<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntroductionResource extends JsonResource
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
            'title_one'=>$this->title_one,
            'title_two'=>$this->title_two,
            'image_number'=>$this->image_number,
            'body'=>$this->body,
        ];
    }
}
