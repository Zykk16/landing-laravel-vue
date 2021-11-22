<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    public function store(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'require|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        $user->fill($validated);

        $user->password = bcrypt($validated->password);
        $user->save();

        return response()->json($user->fresh());
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->is_admin = User::inactive;
        $user->save();

        return response()->json(['message' => 'Пользователь деактивирован']);
    }
}