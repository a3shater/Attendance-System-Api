<?php

namespace App\Http\Resources;

use App\Http\Resources\Area as AreaResource;
use App\Http\Resources\Attendance as AttendanceResource;
use App\Http\Resources\Holiday as HolidayResource;
use App\Http\Resources\Shift as ShiftResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'role' => $this->role,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'areas' => AreaResource::collection($this->areas),
            'attendances' => AttendanceResource::collection($this->attendances),
            'holidays' => HolidayResource::collection($this->holidays),
            'shifts' => ShiftResource::collection($this->shifts),
        ];
    }
}
