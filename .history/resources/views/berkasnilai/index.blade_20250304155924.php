@extends('layouts.app')

@section('content')

@if ($berkas && $berkas->nilai)
<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-center mb-4">Rapor Nilai</h2>

    <!-- Wrap everything inside exportContent -->
    <div id="exportContent">
        <!-- Informasi Siswa -->
        <div class="mb-6 text-center">
            <p class="text-lg"><strong>Nama:</strong> {{ $berkas->nama_lengkap }}</p>
            <p class="text-lg"><strong>Alamat:</strong> {{ $berkas->alamat }}</p>
            <p class="text-lg"><strong>NIK:</strong> {{ $berkas->NIK }}</p>
            <p class="text-lg"><strong>Email:</strong> {{ $berkas->email }}</p>
            <hr class="my-4">
        </div>

        <!-- Tabel Nilai -->
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
    </div> <!-- End of exportContent -->

    <!-- Tombol Export PDF -->
    <button id="exportPDF" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded mx-auto block">
        Export PDF
    </button>
</div>

@else
<p class="text-red-600 text-center">Data nilai tidak ditemukan.</p>
@endif

@endsection

<!-- Script untuk Export PDF -->
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.getElementById("exportPDF").addEventListener("click", function () {
    let element = document.getElementById("exportContent");

    html2pdf().from(element).set({
        margin: 10,
        filename: 'rapor-nilai.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    }).save();
});
</script>
@endsection
