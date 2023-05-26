<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Holiday;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function userShifts($id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('view', $idUser);

        $user = $idUser->shifts;
        $attrs = array();
        $shifts = array();
        foreach ($user as $ourShifts) {
            $attrs['id'] = $ourShifts->id;
            $attrs['name'] = $ourShifts->name;
            $attrs['start_period'] = $ourShifts->start_period;
            $attrs['period'] = $ourShifts->period;
            $attrs['grace_period'] = $ourShifts->grace_period;
            $shifts[] = $attrs;
        }
        return response()->json(['data' => $shifts], 200);
    }

    public function userHolidays($id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('view', $idUser);

        $user = $idUser->holidays;
        $attrs = array();
        $holidays = array();
        foreach ($user as $ourHolidays) {
            $attrs['id'] = $ourHolidays->id;
            $attrs['name'] = $ourHolidays->name;
            $attrs['holiday_date'] = $ourHolidays->holiday_date;
            $holidays[] = $attrs;
        }
        return response()->json(['data' => $holidays], 200);
    }

    public function userAttendances($id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('view', $idUser);

        $user = $idUser->attendances;
        $attrs = array();
        $attendances = array();
        foreach ($user as $ourAttendances) {
            $attrs['id'] = $ourAttendances->id;
            $attrs['attendance_time'] = $ourAttendances->attendance_time;
            $attrs['attendance_state'] = $ourAttendances->attendance_state;
            $attendances[] = $attrs;
        }
        return response()->json(['data' => $attendances], 200);
    }

    public function userAreas($id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('view', $idUser);

        $user = $idUser->areas;
        $attrs = array();
        $areas = array();
        foreach ($user as $ourAreas) {
            $attrs['id'] = $ourAreas->id;
            $attrs['name'] = $ourAreas->name;
            $attrs['latitude'] = $ourAreas->latitude;
            $attrs['longitude'] = $ourAreas->longitude;
            $attrs['company'] = $ourAreas->company->name;
            $areas[] = $attrs;
        }
        return response()->json(['data' => $areas], 200);
    }


    public function shiftUsers($id)
    {
        $idShift = Shift::findOrFail($id);
        $this->authorize('view', $idShift);

        $shift = $idShift->users;
        $attrs = array();
        $users = array();
        foreach ($shift as $ourUsers) {
            $attrs['id'] = $ourUsers->id;
            $attrs['name'] = $ourUsers->name;
            $attrs['email'] = $ourUsers->email;
            $attrs['image'] = $ourUsers->image;
            $attrs['role'] = $ourUsers->role;
            $attrs['phone_number'] = $ourUsers->phone_number;
            $attrs['address'] = $ourUsers->address;
            $users[] = $attrs;
        }
        return response()->json(['data' => $users], 200);
    }

    public function holidayUsers($id)
    {
        $idHoliday = Holiday::findOrFail($id);
        $this->authorize('view', $idHoliday);

        $holiday = $idHoliday->users;
        $attrs = array();
        $users = array();
        foreach ($holiday as $ourUsers) {
            $attrs['id'] = $ourUsers->id;
            $attrs['name'] = $ourUsers->name;
            $attrs['email'] = $ourUsers->email;
            $attrs['image'] = $ourUsers->image;
            $attrs['role'] = $ourUsers->role;
            $attrs['phone_number'] = $ourUsers->phone_number;
            $attrs['address'] = $ourUsers->address;
            $users[] = $attrs;
        }
        return response()->json(['data' => $users], 200);
    }

    public function areaUsers($id)
    {
        $idArea = Area::findOrFail($id);
        $this->authorize('view', $idArea);

        $area = $idArea->users;
        $attrs = array();
        $users = array();
        foreach ($area as $ourUsers) {
            $attrs['id'] = $ourUsers->id;
            $attrs['name'] = $ourUsers->name;
            $attrs['email'] = $ourUsers->email;
            $attrs['image'] = $ourUsers->image;
            $attrs['role'] = $ourUsers->role;
            $attrs['phone_number'] = $ourUsers->phone_number;
            $attrs['address'] = $ourUsers->address;
            $users[] = $attrs;
        }
        return response()->json(['data' => $users], 200);
    }
}
