<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title'=> $this->title,
            'description'=> $this->description,
            // 'number_of_views'=> $this->number_of_views,
            'image'=> $this->image,
            'created_at'=> $this->created_at,
            'section_id'=> $this->section?->id,
            'section_name'=> $this->section?->name,
        ];
    }
}
