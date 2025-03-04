<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center p-6">
        <h1 class="text-2xl font-bold mb-4">Nilai Saya</h1>
        
        @if ($berkas && $berkas->nilai)
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
                <p class="text-lg"><strong>Nama:</strong> {{ $berkas->nama_lengkap }}</p>
                <p class="text-lg"><strong>Email:</strong> {{ $berkas->email }}</p>
                <hr class="my-4">

                <h2 class="text-xl font-semibold mb-2">Nilai</h2>
                <ul class="space-y-2">
                    <li><strong>Average Sertime:</strong> {{ $berkas->nilai->average_sertime }}</li>
                    <li><strong>Average Waittime:</strong> {{ $berkas->nilai->average_waittime }}</li>
                    <li><strong>Average Supel:</strong> {{ $berkas->nilai->average_supel }}</li>
                    <li><strong>Ceklis Pelayanan:</strong> {{ $berkas->nilai->ceklis_pelayanan }}</li>
                    <li><strong>Status:</strong> {{ ucfirst($berkas->nilai->status) }}</li>
                </ul>
            </div>
        @else
            <p class="text-red-600">Data nilai tidak ditemukan.</p>
        @endif
    </div>
</body>
</html>
