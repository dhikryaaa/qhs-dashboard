<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function userData(Request $request)
    {
        return response()->json($request->user());
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'no_induk' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('no_induk', $data['no_induk'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'No Induk atau Password Salah'
            ], 401);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login Berhasil',
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout Berhasil'
        ]);
    }
}
