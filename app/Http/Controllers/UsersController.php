<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Http\Resources\UsersCollection;
use App\Http\Resources\UsersResources;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class UsersController extends Controller
{
    /**
     * @return UsersCollection
     */
    public function index(): UsersCollection
    {
        return new UsersCollection(User::all());
    }

    /**
     * @param UsersRequest $request
     * @return UsersResources
     */
    public function store(UsersRequest $request): UsersResources
    {
        $data = $request->data();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);


        return new UsersResources($user);
    }

    public function update(UsersRequest $request, $id)
    {
        $data = $request->data();
        $user = User::findOrFail($id);

        if ($request->input('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->updated_at = Carbon::now();
        $user->update($data);

        return new UsersResources($user);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => ' User delete'], 204);
    }
}