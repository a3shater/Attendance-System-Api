<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Shift extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Shift Name' => $this->name,
            'Shift Start' => $this->start_period,
            'Shift Period' => $this->period,
            'Grace Period' => $this->grace_period
        ];
    }
}
