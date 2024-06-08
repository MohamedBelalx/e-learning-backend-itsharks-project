<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function all()
    {
        return response()->json(User::all());
    }

    // Create new user // 

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'role' => 'required|string|max:50',
        'phone' => 'nullable|string|max:50',
        'location' => 'nullable|string|max:255',
        'is_active' => 'required|boolean',
        'password' => 'required|string|min:8'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'phone' => $request->phone,
        'location' => $request->location,
        'is_active' => $request->is_active,
        'email_verified_at' => now(), // Automatically verify email for simplicity in this example
        'password' => bcrypt($request->password), // Hash the password
        'remember_token' => Str::random(10), // Generate a remember token
    ]);

    return response()->json([
        'message' => 'User created successfully',
        'data' => $user
    ], 201);
}

    // Review User // 

    public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user);
}

    // Update an existance User // 

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,' . $id,
        'role' => 'string|max:50',
        'phone' => 'nullable|string|max:50',
        'location' => 'nullable|string|max:255',
        'is_active' => 'boolean',
        'password' => 'nullable|string|min:8'
    ]);

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->update($request->except(['password']) + [
        'password' => $request->password ? bcrypt($request->password) : $user->password,
    ]);

    return response()->json([
        'message' => 'User updated successfully',
        'data' => $user
    ]);
}

    // Delete an existance user // 

    public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}


}
