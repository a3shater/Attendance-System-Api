<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
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
        $this->authorize('viewAny', User::class);

        $user = UserResource::collection(User::all());
        return $user->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $data = $request->except(['shift_id', 'holiday_id', 'area_id']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('users');
        }
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user = new UserResource(User::create($data));

        $user->shifts()->attach($request->shift_id);
        $user->areas()->attach($request->area_id);
        $user->holidays()->attach($request->holiday_id);

        return $user->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('view', $idUser);

        $user = new UserResource(User::findOrFail($id));
        return $user->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('update', $idUser);

        $data = $request->except(['shift_id', 'holiday_id', 'area_id']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('users');
        }
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user = new UserResource(User::findOrFail($id));

        $user->update($data);

        $user->shifts()->syncWithoutDetaching($request->shift_id);

        // $areasId=$user->areas->pluck('id');
        $user->areas()->syncWithoutDetaching($request->area_id); //

        $user->holidays()->syncWithoutDetaching($request->holiday_id);

        return $user->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idUser = User::findOrFail($id);
        $this->authorize('delete', $idUser);

        $user = User::findOrFail($id);
        $user->shifts()->detach($user->shifts);
        $user->areas()->detach($user->areas);
        $user->holidays()->detach($user->holidays);
        $user->delete();
        return response()->json(204);
    }
}
