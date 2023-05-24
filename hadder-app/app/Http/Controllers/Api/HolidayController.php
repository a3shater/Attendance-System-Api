<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Resources\Holiday as HolidayResource;


class HolidayController extends Controller
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
        $this->authorize('viewAny', Holiday::class);

        $holiday = HolidayResource::collection(Holiday::all());
        return $holiday->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Holiday::class);

        $holiday = new HolidayResource(Holiday::create($request->except(['user_id'])));
        $holiday->users()->attach($request->user_id);
        return $holiday->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idHoliday = Holiday::findOrFail($id);
        $this->authorize('view', $idHoliday);

        $holiday = new HolidayResource(Holiday::findOrFail($id));
        return $holiday->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idHoliday = Holiday::findOrFail($id);
        $this->authorize('update', $idHoliday);

        $holiday = new HolidayResource(Holiday::findOrFail($id));
        $holiday->update($request->except(['user_id']));

        $holiday->users()->syncWithoutDetaching($request->user_id);

        return $holiday->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idHoliday = Holiday::findOrFail($id);
        $this->authorize('delete', $idHoliday);

        $holiday = Holiday::findOrFail($id);
        $holiday->users()->detach($holiday->users);
        $holiday->delete();
        return response()->json(200);
    }
}
