<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function logout()
    {
        Auth::user()->token()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Logout successful',
        ]);
    }
}
