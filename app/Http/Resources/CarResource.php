<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'mileage' => $this->mileage,
            'condition' => $this->condition,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'car_images' => CarImageResource::collection($this->whenLoaded('carImages')),
            'vin_code' => $this->vin
        ];
    }
}
