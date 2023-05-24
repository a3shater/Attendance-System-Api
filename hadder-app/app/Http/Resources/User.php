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
            'Full Name' => $this->name,
            'Email' => $this->email,
            'Image Path' => $this->image,
            'User Role' => $this->role,
            'Phone Number' => $this->phone_number,
            'Address' => $this->address,
            'Area' => AreaResource::collection($this->areas),
            'Attendance' => AttendanceResource::collection($this->attendances),
            'Holidays' => HolidayResource::collection($this->holidays),
            'Shifts' => ShiftResource::collection($this->shifts),
        ];
    }
}
