<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

use App\Http\Resources\Attendance as AttendanceResource;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Attendance::class);

        $attendance = AttendanceResource::collection(Attendance::all());
        return $attendance->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attendance = new AttendanceResource(Attendance::create($request->all()));

        return $attendance->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idAttendance = Attendance::findOrFail($id);
        $this->authorize('view', $idAttendance);

        $attendance = new AttendanceResource(Attendance::findOrFail($id));
        return $attendance->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idAttendance = Attendance::findOrFail($id);
        $this->authorize('update', $idAttendance);

        $attendance = new AttendanceResource(Attendance::findOrFail($id));
        $attendance->update($request->all());
        return $attendance->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idAttendance = Attendance::findOrFail($id);
        $this->authorize('delete', $idAttendance);

        Attendance::findOrFail($id)->delete();
        return response()->json(200);
    }
}
