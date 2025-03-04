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

    @extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Pengguna</h2>

    <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah User</button>

    <table class="min-w-full mt-4 border bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody id="userTable">
            @foreach ($users as $user)
            <tr id="user_{{ $user->id }}" class="border">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-800">
                        Edit
                    </a>
                    <button onclick="deleteUser({{ $user->id }})" class="text-red-500 ml-2">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="createModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-3">Tambah User</h2>
        <form id="createUserForm">
            @csrf
            <input type="text" id="name" placeholder="Nama" class="border p-2 w-full mb-2 rounded">
            <input type="email" id="email" placeholder="Email" class="border p-2 w-full mb-2 rounded">
            <input type="password" id="password" placeholder="Password" class="border p-2 w-full mb-2 rounded">
            
            <div class="flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    // CREATE User
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            _token: '{{ csrf_token() }}'
        };

        fetch('{{ route('users.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            let newUser = `
                <tr id="user_${data.user.id}" class="border">
                    <td class="px-4 py-2">${data.user.name}</td>
                    <td class="px-4 py-2">${data.user.email}</td>
                    <td class="px-4 py-2">${data.user.role.charAt(0).toUpperCase() + data.user.role.slice(1)}</td>
                    <td class="px-4 py-2">
                        <a href="/users/${data.user.id}/edit" class="text-blue-500">Edit</a>
                        <button onclick="deleteUser(${data.user.id})" class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            `;
            document.getElementById('userTable').innerHTML += newUser;
            closeCreateModal();
        });
    });

    // DELETE User
    function deleteUser(id) {
        fetch(`/users/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal menghapus user');
            }
            return response.json();
        })
        .then(() => {
            document.getElementById(`user_${id}`).remove();
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
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
