<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash};
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => ['required', Rule::in(['employee', 'user', 'admin'])],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json(['message' => 'User berhasil ditambahkan!', 'user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['employee', 'user', 'admin'])],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return response()->json(['message' => 'User berhasil diperbarui!', 'user' => $user]);
    }

    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json(['message' => 'User berhasil dihapus']);
}

}
