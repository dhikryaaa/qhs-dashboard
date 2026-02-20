<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileAuthController extends Controller
{
    public function userData(Request $request)
    {
        return response()->json($request->user());
    }

    public function mobileLogin(Request $request)
    {
        $request->validate([
            'no_induk' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('no_induk', 'password'))) {
            return response()->json([
                'message' => 'No Induk atau Password Salah'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Berhasil',
            'access_token' => $token,
            'user' => $user
        ]);
    }

    public function mobileLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Berhasil'
        ]);
    }
}
