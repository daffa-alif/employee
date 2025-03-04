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
        <!-- Sidebar -->
        <aside class="fixed left-4 top-4 bottom-4 bg-white text-gray-800 p-6 w-64 rounded-2xl shadow-lg flex flex-col space-y-4">
            <h2 class="text-xl font-bold">Admin</h2>
            <nav class="space-y-2">
                <a href="{{ route('users.index') }}" class="flex items-center space-x-3 p-3 w-full rounded-lg hover:bg-gray-200">
                    <i class="fas fa-users"></i> <span>Manajemen User</span>
                </a>
                <a href="{{ route('nilais.index') }}" class="flex items-center space-x-3 p-3 w-full rounded-lg hover:bg-gray-200">
                    <i class="fas fa-clipboard-list"></i> <span>Manajemen Nilai</span>
                </a>
            </nav>
            <hr class="border-gray-300">
            <a href="{{route('logout')}}" class="flex items-center space-x-3 p-3 w-full rounded-lg text-red-600 hover:bg-gray-200">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4 flex justify-between items-center rounded-b-lg mx-6 mt-4">
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="fixed left-4 top-4 bottom-4 bg-white text-gray-800 p-6 w-64 rounded-2xl shadow-lg flex flex-col space-y-4">
            <h2 class="text-xl font-bold">Superadmin</h2>
            <nav class="space-y-2">
                <a href="{{ route('users.index') }}" class="flex items-center space-x-3 p-3 w-full rounded-lg hover:bg-gray-200">
                    <i class="fas fa-database"></i> <span>Manajemen Semua Data</span>
                </a>
                <a href="{{ route('konfirmasi.index') }}" class="flex items-center space-x-3 p-3 w-full rounded-lg hover:bg-gray-200">
                    <i class="fas fa-check-circle"></i> <span>Konfirmasi Nilai Employee</span>
                </a>
            </nav>
            <hr class="border-gray-300">
            <a href="{{route('logout')}}" class="flex items-center space-x-3 p-3 w-full rounded-lg text-red-600 hover:bg-gray-200">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4 flex justify-between items-center rounded-b-lg mx-6 mt-4">
                <h1 class="text-lg font-semibold">Welcome, Superadmin</h1>
            </nav>
            
            <main class="p-6">
                @yield('content')
            </main>
        </div>
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex flex-col h-screen">
        <!-- Navbar Employee -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center rounded-b-lg mx-6 mt-4">
            <h2 class="text-lg font-semibold">Employee Dashboard</h2>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('berkas.index') }}" class="text-gray-800 hover:text-gray-500">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('berkasnilai.index') }}" class="text-gray-800 hover:text-gray-500">
                            <i class="fas fa-file-alt"></i> Berkas Nilai
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="p-6 flex-1">
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
