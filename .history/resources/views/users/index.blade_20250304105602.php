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
<!-- Modal -->
<div id="createModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-3">Tambah User</h2>
        <form id="createUserForm">
            @csrf
            <input type="text" id="name" placeholder="Nama" class="border p-2 w-full mb-2 rounded">
            <input type="email" id="email" placeholder="Email" class="border p-2 w-full mb-2 rounded">
            <input type="password" id="password" placeholder="Password" class="border p-2 w-full mb-2 rounded">
            
            <!-- Role Input (Visible only to Superadmin) -->
            <div id="roleInput" class="hidden">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="border p-2 w-full mb-2 rounded">
                    <option value="superadmin">Superadmin</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Check if the logged-in user is a superadmin
    const loggedInUserRole = '{{ auth()->user()->role }}'; // Fetch the logged-in user's role from the backend

    // Show the role input field only if the logged-in user is a superadmin
    if (loggedInUserRole === 'superadmin') {
        document.getElementById('roleInput').classList.remove('hidden');
    }

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    // CREATE User
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loader
        document.getElementById('loader').classList.remove('hidden');

        let formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            _token: '{{ csrf_token() }}'
        };

        // Add role to formData only if the logged-in user is a superadmin
        if (loggedInUserRole === 'superadmin') {
            formData.role = document.getElementById('role').value;
        } else {
            formData.role = 'employee'; // Default role for non-superadmin users
        }

        fetch('{{ route('users.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            // Hide loader
            document.getElementById('loader').classList.add('hidden');

            let newUser = `
                <tr id="user_${data.user.id}" class="border">
                    <td class="px-4 py-2">${data.user.name}</td>
                    <td class="px-4 py-2">${data.user.email}</td>
                    <td class="px-4 py-2">${data.user.role.charAt(0).toUpperCase() + data.user.role.slice(1)}</td>
                    <td class="px-4 py-2">
                        <button onclick="editUser(${data.user.id})" class="text-yellow-500">Edit</button>
                        <button onclick="deleteUser(${data.user.id})" class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            `;
            document.getElementById('userTable').innerHTML += newUser;
            closeCreateModal();
        })
        .catch(error => {
            // Hide loader in case of error
            document.getElementById('loader').classList.add('hidden');
            console.error('Error:', error);
        });
    });

    // DELETE User
    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
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
    }
</script>

<!-- Loader -->
<div id="loader" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-center">Loading...</p>
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
        
        // Show loader
        document.getElementById('loader').classList.remove('hidden');

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
            // Hide loader
            document.getElementById('loader').classList.add('hidden');

            let newUser = `
                <tr id="user_${data.user.id}" class="border">
                    <td class="px-4 py-2">${data.user.name}</td>
                    <td class="px-4 py-2">${data.user.email}</td>
                    <td class="px-4 py-2">${data.user.role.charAt(0).toUpperCase() + data.user.role.slice(1)}</td>
                    <td class="px-4 py-2">
                        <button onclick="editUser(${data.user.id})" class="text-yellow-500">Edit</button>
                        <button onclick="deleteUser(${data.user.id})" class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            `;
            document.getElementById('userTable').innerHTML += newUser;
            closeCreateModal();
        })
        .catch(error => {
            // Hide loader in case of error
            document.getElementById('loader').classList.add('hidden');
            console.error('Error:', error);
        });
    });

    // DELETE User
    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
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
    }
</script>
@endsection