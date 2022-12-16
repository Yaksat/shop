<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Color\ColorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductMinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image_url' => $this->imageUrl,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'count' => $this->count,
            'is_published' => $this->is_published,
            'category' => new ColorResource($this->category),
            'colors' => ColorResource::collection($this->colors),
        ];
    }
}
