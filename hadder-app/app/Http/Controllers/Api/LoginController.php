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
            'data' => //new UserResource(Auth::user())
            [
                'Full Name' => $user->name,
                'Email' => $user->email,
                'Image Path' => $user->image,
                'User Role' => $user->role,
                'Phone Number' => $user->phone_number,
                'Address' => $user->address,
            ],
            'access_token' => $token->plainTextToken,
        ]);
    }
}
