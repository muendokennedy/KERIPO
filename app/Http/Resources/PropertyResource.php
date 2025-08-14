<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class PropertyResource extends JsonResource
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
            'propertyId' => $this->propertyId,
            'category' => $this->category,
            'ownersName' => $this->ownersName,
            'location' => $this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'propertyValuation' => Number::currency($this->propertyValuation, in: 'KES'),
            'acquisitionStatus' => $this->acquisitionStatus,
            'images' => $this->images,
            'primaryImagePath' => $this->primary_image_path,
            'order' => $this->order
        ];
    }
}
