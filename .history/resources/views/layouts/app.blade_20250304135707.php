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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Bubble Nav -->
        <aside class="fixed left-4 top-1/2 transform -translate-y-1/2 bg-blue-900 text-white p-4 rounded-full shadow-lg flex flex-col space-y-4">
            <a href="{{ route('users.index') }}" class="flex items-center justify-center w-12 h-12 bg-blue-700 rounded-full hover:bg-blue-600">
                <i class="fas fa-users"></i>
            </a>
            <a href="{{ route('nilais.index') }}" class="flex items-center justify-center w-12 h-12 bg-blue-700 rounded-full hover:bg-blue-600">
                <i class="fas fa-clipboard-list"></i>
            </a>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold">Welcome, Admin</h1>
            </nav>
            
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
