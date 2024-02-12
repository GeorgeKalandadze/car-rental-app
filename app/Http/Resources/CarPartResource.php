<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarPartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'part_id' => $this->id,
            'part_name' => $this->name,
            'part_condition' => $this->condition,
            'brand' => $this->brand,
            'model' => $this->model,
            'user' => $this->user,
            'part_images' => CarImageResource::collection($this->whenLoaded('images')),
            'category' => $this->category,
        ];
    }
}
