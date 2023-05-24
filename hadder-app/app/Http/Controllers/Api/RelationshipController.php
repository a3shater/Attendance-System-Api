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
            $attrs['Shift Name'] = $ourShifts->name;
            $attrs['Shift Start'] = $ourShifts->start_period;
            $attrs['Shift Period'] = $ourShifts->period;
            $attrs['Grace Period'] = $ourShifts->grace_period;
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
            $attrs['Holiday Name'] = $ourHolidays->name;
            $attrs['Holiday Date'] = $ourHolidays->holiday_date;
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
            $attrs['Attendance Time'] = $ourAttendances->attendance_time;
            $attrs['Attendance State'] = $ourAttendances->attendance_state;
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
            $attrs['Area Name'] = $ourAreas->name;
            $attrs['Latitude'] = $ourAreas->latitude;
            $attrs['Longitude'] = $ourAreas->longitude;
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
            $attrs['Full Name'] = $ourUsers->name;
            $attrs['Email'] = $ourUsers->email;
            $attrs['Image Path'] = $ourUsers->image;
            $attrs['User Role'] = $ourUsers->role;
            $attrs['Phone Number'] = $ourUsers->phone_number;
            $attrs['Address'] = $ourUsers->address;
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
            $attrs['Full Name'] = $ourUsers->name;
            $attrs['Email'] = $ourUsers->email;
            $attrs['Image Path'] = $ourUsers->image;
            $attrs['User Role'] = $ourUsers->role;
            $attrs['Phone Number'] = $ourUsers->phone_number;
            $attrs['Address'] = $ourUsers->address;
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
            $attrs['Full Name'] = $ourUsers->name;
            $attrs['Email'] = $ourUsers->email;
            $attrs['Image Path'] = $ourUsers->image;
            $attrs['User Role'] = $ourUsers->role;
            $attrs['Phone Number'] = $ourUsers->phone_number;
            $attrs['Address'] = $ourUsers->address;
            $users[] = $attrs;
        }
        return response()->json(['data' => $users], 200);
    }
}
