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
@extends('layouts.app')

@section('content')

@if ($berkas && $berkas->nilai)
<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-center mb-4">Rapor Nilai</h2>

    <!-- Informasi Siswa -->
    <div class="mb-6 text-center">
        <p class="text-lg"><strong>Nama:</strong> {{ $berkas->nama_lengkap }}</p>
        <p class="text-lg"><strong>Alamat:</strong> {{ $berkas->alamat }}</p>
        <p class="text-lg"><strong>NIK:</strong> {{ $berkas->NIK }}</p>
        <p class="text-lg"><strong>Email:</strong> {{ $berkas->email }}</p>
        <hr class="my-4">
    </div>

    <!-- Tabel Nilai -->
    <div id="exportContent">
        <table class="w-3/4 mx-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 p-2">Mata Pelajaran</th>
                    <th class="border border-gray-300 p-2">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-2">Average Sertime</td>
                    <td class="border border-gray-300 p-2 text-center">{{ $berkas->nilai->average_sertime }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Average Waittime</td>
                    <td class="border border-gray-300 p-2 text-center">{{ $berkas->nilai->average_waittime }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Average Supel</td>
                    <td class="border border-gray-300 p-2 text-center">{{ $berkas->nilai->average_supel }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">Ceklis Pelayanan</td>
                    <td class="border border-gray-300 p-2 text-center">{{ $berkas->nilai->ceklis_pelayanan }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Status -->
        <div class="mt-4 text-center">
            <p class="text-lg font-semibold">Status: 
                <span class="px-3 py-1 rounded-lg 
                    {{ $berkas->nilai->status === 'confirmed' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                    {{ ucfirst($berkas->nilai->status) }}
                </span>
            </p>
        </div>
    </div>

    <!-- Tombol Export PDF -->
    <button id="exportPDF" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded mx-auto block">
        Export PDF
    </button>
</div>

@else
<p class="text-red-600 text-center">Data nilai tidak ditemukan.</p>
@endif

<!-- CDN + Script (Place before </body>) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.getElementById("exportPDF").addEventListener("click", function () {
    let element = document.getElementById("exportContent");

    html2pdf().from(element).save("rapor-nilai.pdf");
});
</script>

@endsection


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
