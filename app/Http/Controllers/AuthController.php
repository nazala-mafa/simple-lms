<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->input();

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('Auth Token')->plainTextToken;
            return response()->json(['message' => 'Login successful.', 'data' => $token], 200);
        }

        return response()->json(['message' => 'Invalid login credentials.'], 401);
    }

    public function login_with_id(User $user)
    {
        Auth::login($user);
        return redirect()->to('/')->with('message', "Login as $user->name successfully");
    }
}