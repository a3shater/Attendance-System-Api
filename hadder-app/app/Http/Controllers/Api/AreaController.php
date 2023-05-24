<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Resources\Area as AreaResource;


class AreaController extends Controller
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
        $this->authorize('viewAny', Area::class);

        $area = AreaResource::collection(Area::all());
        return $area->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Area::class);

        $area = new AreaResource(Area::create($request->except(['user_id'])));
        $area->users()->attach($request->user_id);
        return $area->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idArea = Area::findOrFail($id);
        $this->authorize('view', $idArea);

        $area = new AreaResource(Area::findOrFail($id));
        return $area->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idArea = Area::findOrFail($id);
        $this->authorize('update', $idArea);

        $area = new AreaResource(Area::findOrFail($id));
        $area->update($request->except(['user_id']));

        $area->users()->syncWithoutDetaching($request->user_id);

        return $area->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idArea = Area::findOrFail($id);
        $this->authorize('delete', $idArea);

        $area = Area::findOrFail($id);
        $area->users()->detach($area->users);
        $area->delete();
        return response()->json(200);
    }
}
