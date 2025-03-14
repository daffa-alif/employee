<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Auth};
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
{
    $authUser = Auth::user();

    // Jika role adalah employee, tampilkan 404
    if ($authUser->role == 'employee') {
        abort(404);
    }

    // Jika role adalah admin, tampilkan semua user KECUALI admin lain & superadmin
    if ($authUser->role == 'admin') {
        $users = User::whereNotIn('role', ['admin', 'superadmin'])->get();
    } 
    // Jika superadmin, tampilkan semua user
    else {
        $users = User::all();
    }

    return view('users.index', compact('users'));
}

public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'sometimes|in:superadmin,admin,employee', // Optional, only if provided
    ]);

    // Set default role to 'employee' if the logged-in user is not a superadmin
    if (auth()->user()->role !== 'superadmin') {
        $validated['role'] = 'employee';
    }

    // Create the user
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'], // Role is set based on the logic above
    ]);

    return response()->json(['user' => $user]);
}

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'sometimes|in:superadmin,admin,employee', // Optional, only if provided
    ]);

    // Update the user's name and email
    $user->name = $validated['name'];
    $user->email = $validated['email'];

    // Update the role only if the logged-in user is a superadmin
    if (auth()->user()->role === 'superadmin' && isset($validated['role'])) {
        $user->role = $validated['role'];
    }

    // Save the changes
    $user->save();

    return response()->json(['user' => $user]);
}

    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json(['message' => 'User berhasil dihapus']);
}

}
