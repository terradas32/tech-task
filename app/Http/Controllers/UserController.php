<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // Handle selfie upload
        if ($request->hasFile('selfie')) {
            $data['selfie'] = $request->file('selfie')->store('selfies', 'public');
        }

        $user = User::create($data);

        return response()->json($user, 201);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Handle selfie replacement
        if ($request->hasFile('selfie')) {
            // Optionally delete old file
            if ($user->selfie) {
                Storage::disk('public')->delete($user->selfie);
            }

            $data['selfie'] = $request->file('selfie')->store('selfies', 'public');
        }

        $user->update($data);

        return response()->json($user, 200);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->selfie) {
            Storage::disk('public')->delete($user->selfie);
        }

        $user->delete();

        return response()->json(null, 204);
    }
}
