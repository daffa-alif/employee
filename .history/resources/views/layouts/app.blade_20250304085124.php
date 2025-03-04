<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="text-lg font-bold">Manajemen User</a>
            <div>
                <a href="{{ route('users.index') }}" class="px-3 py-2 bg-white text-blue-600 rounded hover:bg-gray-200">Users</a>
                <a href="#" class="px-3 py-2 bg-white text-blue-600 rounded hover:bg-gray-200">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 p-4 mt-6 text-center">
        <p>&copy; 2025 Manajemen User. All rights reserved.</p>
    </footer>
</body>
</html>
