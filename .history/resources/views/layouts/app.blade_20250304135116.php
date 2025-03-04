@php
    $role = auth()->user()->role ?? 'guest'; // Ambil role user atau default ke 'guest'
@endphp

@if ($role === 'admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Admin -->
        <aside class="w-64 bg-gray-800 text-white p-5">
            <h2 class="text-xl font-bold mb-4">Admin Menu</h2>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Manajemen User</a>
                    </li>
                    <li>
                        <a href="{{ route('nilais.index') }}" class="block px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Manajemen Nilai</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4">
                <h1 class="text-xl font-semibold">Welcome, Admin</h1>
            </nav>
            
            <!-- Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>



@elseif ($role === 'superadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Panel</title>
</head>
<body>
    <div>
        <!-- Sidebar Superadmin -->
        <aside>
            <h2>Superadmin Menu</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('users.index') }}">Manajemen Semua Data</a></li>
                    <li><a href="{{ route('konfirmasi.index') }}">Konfirmasi Nilai Employee</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>

@elseif ($role === 'employee')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
</head>
<body>
    <div>
        <!-- Navbar Employee -->
        <header>
            <h2>Employee Dashboard</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('berkas.index') }}">Profil Saya</a></li>
                </ul>
            </nav>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>

@else
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Page</title>
</head>
<body>
    <h1>Welcome, Guest</h1>
    <p>You do not have access to this page.</p>
</body>
</html>
@endif
