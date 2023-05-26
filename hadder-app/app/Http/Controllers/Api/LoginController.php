<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;


class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('my.auth.one');
    }

    public function login(Request $request)
    {
        $user = Auth::user();

        $user->tokens()->delete();

        $token = $user->createToken('auth_token', ['*'], now()->addMinutes(1440));
        // return $user->tokens;
        return response()->json([
            'data' =>
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'role' => $user->role,
                'phone_number' => $user->phone_number,
                'address' => $user->address,
            ],
            'access_token' => $token->plainTextToken,
        ]);
    }
}
