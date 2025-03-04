@if ($role = 'admin')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@heroicons/vue@1.0.6/dist/heroicons.min.js"></script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="bg-white w-64 min-h-screen p-4 shadow-lg">
        <h2 class="text-lg font-bold mb-4">Admin Dashboard</h2>
        <nav>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Users
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                Bus
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Kehas
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4 text-white flex justify-between">
            <span class="text-lg font-bold">Welcome, Admin</span>
            <a href="#" class="px-3 py-2 bg-white text-blue-600 rounded hover:bg-gray-200">Logout</a>
        </nav>

        <!-- Content -->
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Kursi Bus</h1>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Bus</th>
                        <th class="py-2">Kehas</th>
                        <th class="py-2">Nomor Kursi</th>
                        <th class="py-2">Status Kursi</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">BAD</td>
                        <td class="border px-4 py-2">blinds</td>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">booked</td>
                        <td class="border px-4 py-2">
                            <button class="text-blue-600 hover:text-blue-800">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>    
@elseif($role == 'superadmin')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@heroicons/vue@1.0.6/dist/heroicons.min.js"></script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="bg-white w-64 min-h-screen p-4 shadow-lg">
        <h2 class="text-lg font-bold mb-4">Super Admin Dashboard</h2>
        <nav>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Users
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                Bus
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Kehas
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 rounded">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4 text-white flex justify-between">
            <span class="text-lg font-bold">Welcome, Super Admin</span>
            <a href="#" class="px-3 py-2 bg-white text-blue-600 rounded hover:bg-gray-200">Logout</a>
        </nav>

        <!-- Content -->
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Kursi Bus</h1>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Bus</th>
                        <th class="py-2">Kehas</th>
                        <th class="py-2">Nomor Kursi</th>
                        <th class="py-2">Status Kursi</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">BAD</td>
                        <td class="border px-4 py-2">blinds</td>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">booked</td>
                        <td class="border px-4 py-2">
                            <button class="text-blue-600 hover:text-blue-800">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
@else
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@heroicons/vue@1.0.6/dist/heroicons.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between">
        <span class="text-lg font-bold">Welcome, User</span>
        <a href="#" class="px-3 py-2 bg-white text-blue-600 rounded hover:bg-gray-200">Logout</a>
    </nav>

    <!-- Content -->
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Kursi Bus</h1>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Bus</th>
                    <th class="py-2">Kehas</th>
                    <th class="py-2">Nomor Kursi</th>
                    <th class="py-2">Status Kursi</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">BAD</td>
                    <td class="border px-4 py-2">blinds</td>
                    <td class="border px-4 py-2">1</td>
                    <td class="border px-4 py-2">booked</td>
                    <td class="border px-4 py-2">
                        <button class="text-blue-600 hover:text-blue-800">Edit</button>
                        <button class="text-red-600 hover:text-red-800">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
@endif