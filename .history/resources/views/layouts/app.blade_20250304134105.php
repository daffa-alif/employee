<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@heroicons/vue@1.0.6/dist/heroicons.min.js"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    @if ($role === 'admin' || $role === 'employee')
        
    @endif
    <aside class="bg-white-800 text-white w-64 min-h-screen p-4 hidden md:block">
        <h2 class="text-lg font-bold mb-4">Dashboard</h2>
        
        @php
            $role = auth()->user()->role ?? 'guest'; // Cek role user
        @endphp

        <!-- Section for Admin -->
        @if ($role === 'admin')
        <section id="admin-section" class="bg-white shadow-lg rounded-lg p-4 w-64">
            <nav class="space-y-2">
                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                    </svg>
                    users
                </a>
                <a href="{{ route('nilais.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                    </svg>
                    Nilai
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Pengaturan
                </a>
            </nav>
        </section>
        
        @endif

        <!-- Section for SuperAdmin -->
        @if ($role === 'superadmin')
        <section id="superadmin-section">
            <nav>
                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                    </svg>
                    Manajemen Semua Data
                </a>
                <a href="{{ route('konfirmasi.index') }}" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                    </svg>
                    Konfirmasi Nilai Employee
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Pengaturan Server
                </a>
            </nav>
        </section>
        @endif

        <!-- Section for Employee -->


        
    </aside>

    @if($role === 'admin' || $role === 'superadmin')
    <!-- Admin & Superadmin Layout -->
    <div class="flex-1 flex flex-col min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4 text-white flex justify-between items-center shadow-md">
            <button class="md:hidden" onclick="toggleSidebar()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <span class="text-lg font-bold">Manajemen User</span>
            <a href="{{ route('logout') }}" class="px-4 py-2 bg-white text-blue-600 rounded-md hover:bg-gray-300 transition duration-200">Logout</a>
        </nav>

        <!-- Content -->
        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 p-4 text-center mt-auto shadow-inner">
            <p class="text-gray-700">&copy; 2025 Manajemen User. All rights reserved.</p>
        </footer>
    </div>
@else
    <!-- User Biasa Layout -->
    <div class="flex flex-col min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4 text-white flex justify-between items-center shadow-md">
            <span class="text-lg font-bold">Manajemen User</span>
            <a href="{{ route('logout') }}" class="px-4 py-2 bg-white text-blue-600 rounded-md hover:bg-gray-300 transition duration-200">Logout</a>
        </nav>

        <!-- Content langsung di bawah navbar -->
        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 p-4 text-center mt-auto shadow-inner">
            <p class="text-gray-700">&copy; 2025 Manajemen User. All rights reserved.</p>
        </footer>
    </div>
@endif

    

    <!-- Mobile Sidebar (Hidden) -->
    <div id="mobileSidebar" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <aside class="bg-blue-800 text-white w-64 min-h-screen p-4 absolute left-0">
            <button onclick="toggleSidebar()" class="absolute top-4 right-4">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-lg font-bold mb-4">Dashboard</h2>

            <!-- Mobile Section for Admin -->
            @if ($role === 'admin')
            <section id="mobile-admin-section" class="bg-white shadow-lg rounded-lg p-4 w-64">
                <nav class="space-y-2">
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                        Manajemen User
                    </a>
                </nav>
            </section>
            
            @endif

            <!-- Mobile Section for SuperAdmin -->
            @if ($role === 'superadmin')
            <section id="mobile-superadmin-section">
                <nav>
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                        Manajemen Semua Data
                    </a>
                </nav>
            </section>
            @endif

            <!-- Mobile Section for Employee -->
            @if ($role === 'employee')
            <section id="mobile-employee-section">
                <nav>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                        Profil Saya
                    </a>
                </nav>
            </section>
            @endif
        </aside>
    </div>

    <!-- Script -->
    <script>
        function toggleSidebar() {
            document.getElementById('mobileSidebar').classList.toggle('hidden');
        }
    </script>
</body>
</html>