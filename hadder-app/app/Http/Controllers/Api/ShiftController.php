<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

use App\Http\Resources\Shift as ShiftResource;


class ShiftController extends Controller
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
        $this->authorize('viewAny', Shift::class);

        $shift = ShiftResource::collection(Shift::all());
        return $shift->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Shift::class);

        $shift = new ShiftResource(Shift::create($request->all()));
        $shift->users()->attach($request->user_id);
        return $shift->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idShift = Shift::findOrFail($id);
        $this->authorize('view', $idShift);

        $shift = new ShiftResource(Shift::findOrFail($id));
        return $shift->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idShift = shift::findOrFail($id);
        $this->authorize('update', $idShift);

        $shift = new ShiftResource(Shift::findOrFail($id));
        $shift->update($request->all());

        $shift->users()->toggle($request->user_id);

        return $shift->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idShift = shift::findOrFail($id);
        $this->authorize('delete', $idShift);

        $shift = Shift::findOrFail($id);
        $shift->users()->detach($shift->users);
        $shift->delete();
        return response()->json(200);
    }
}
