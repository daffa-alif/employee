@php
    $role = auth()->user()->role ?? 'guest'; // Ambil role user atau default ke 'guest'
@endphp

<div class="flex min-h-screen bg-gray-100">
    @if ($role === 'admin' || $role === 'employee')
        <!-- Sidebar untuk Admin & Employee -->
        <aside class="bg-white w-64 min-h-screen p-4 shadow-md hidden md:block">
            <h2 class="text-lg font-bold mb-4">Dashboard</h2>
            <nav class="space-y-2">
                @if ($role === 'admin')
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                        Manajemen User
                    </a>
                    <a href="{{ route('nilais.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                        Manajemen Nilai
                    </a>
                @endif

                @if ($role === 'employee')
                    <a href="{{ route('berkas.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                        Profil Saya
                    </a>
                @endif
            </nav>
        </aside>
    @endif

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
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
</div>

<!-- Mobile Sidebar -->
<div id="mobileSidebar" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <aside class="bg-white w-64 min-h-screen p-4 absolute left-0">
        <button onclick="toggleSidebar()" class="absolute top-4 right-4">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h2 class="text-lg font-bold mb-4">Dashboard</h2>

        @if ($role === 'admin')
            <a href="{{ route('users.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Manajemen User</a>
            <a href="{{ route('nilais.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Nilai</a>
        @endif

        @if ($role === 'employee')
            <a href="{{ route('berkas.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Profil Saya</a>
        @endif
    </aside>
</div>

<!-- Script -->
<script>
    function toggleSidebar() {
        document.getElementById('mobileSidebar').classList.toggle('hidden');
    }
</script>
