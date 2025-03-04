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
</head>
<body>
    <div>
        <!-- Sidebar Admin -->
        <aside>
            <h2>Admin Menu</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('users.index') }}">Manajemen User</a></li>
                    <li><a href="{{ route('nilais.index') }}">Manajemen Nilai</a></li>
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
