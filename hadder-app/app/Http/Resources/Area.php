<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Area extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'The Company' => $this->company->name,
            'Area Name' => $this->name,
            'Latitude' => $this->latitude,
            'Longitude' => $this->longitude
        ];
    }
}
