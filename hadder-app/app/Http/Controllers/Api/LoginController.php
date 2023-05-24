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
        $token = Auth::user()->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => new UserResource(Auth::user()),
            'access_token' => $token,
        ]);
    }
}
