<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Company Name' => $this->name,
            'Address' => $this->address,
            'Phone Number' => $this->phone_number,
            'Email' => $this->email,
            'Logo' => $this->image
        ];
    }
}
