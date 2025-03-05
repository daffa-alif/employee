@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Manajemen Nilai</h1>

    <!-- Form Create -->
    <form id="createNilaiForm" class="bg-white p-4 rounded shadow-md mb-4 relative">
        <select name="id_berkas" id="id_berkas" class="border p-2 rounded w-full mb-2" required>
            <option value="">Pilih Berkas</option>
            @foreach(App\Models\BerkasEmployee::all() as $berkas)
                <option value="{{ $berkas->id }}">{{ $berkas->nama_lengkap }}</option>
            @endforeach
        </select>
        <input type="time" name="average_sertime" class="border p-2 rounded w-full mb-2" required placeholder="Average Service Time">
        <input type="time" name="average_waittime" class="border p-2 rounded w-full mb-2" required placeholder="Average Wait Time">
        <input type="time" name="" class="border p-2 rounded w-full mb-2" required placeholder="Average Wait Time">
        <input type="number" name="average_supel" class="border p-2 rounded w-full mb-2" required placeholder="Average Supel">
        <input type="number" name="ceklis_pelayanan" class="border p-2 rounded w-full mb-2" required placeholder="Ceklis Pelayanan">
        
        <!-- Tombol submit -->
        <button type="submit" id="submitBtn" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Tambah</button>

        <!-- Loader (Hidden by default) -->
        <div id="loader" class="hidden absolute inset-0 flex items-center justify-center bg-gray-200 bg-opacity-50">
            <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-blue-600"></div>
        </div>
    </form>

    <!-- Tabel Data -->
    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Berkas</th>
                <th class="px-4 py-2">Service Time</th>
                <th class="px-4 py-2">Wait Time</th>
                <th class="px-4 py-2">Supel</th>
                <th class="px-4 py-2">Pelayanan</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody id="nilaiTableBody">
            @foreach($nilais as $nilai)
                <tr id="nilaiRow-{{ $nilai->id }}">
                    <td class="border px-4 py-2">{{ $nilai->berkasEmployee->nama_lengkap }}</td>
                    <td class="border px-4 py-2">{{ $nilai->average_sertime }}</td>
                    <td class="border px-4 py-2">{{ $nilai->average_waittime }}</td>
                    <td class="border px-4 py-2">{{ $nilai->average_supel }}</td>
                    <td class="border px-4 py-2">{{ $nilai->ceklis_pelayanan }}</td>
                    <td class="border px-4 py-2">{{ $nilai->status }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('nilais.edit', $nilai->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <button onclick="deleteNilai({{ $nilai->id }})" class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.getElementById('createNilaiForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Tampilkan loader dan nonaktifkan tombol
    document.getElementById('loader').classList.remove('hidden');
    document.getElementById('submitBtn').disabled = true;

    let formData = new FormData(this);
    fetch("{{ route('nilais.store') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    }).then(response => response.json())
    .then(data => {
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    })
    .finally(() => {
        // Sembunyikan loader setelah selesai
        document.getElementById('loader').classList.add('hidden');
        document.getElementById('submitBtn').disabled = false;
    });
});

function deleteNilai(id) {
    fetch(`/nilais/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    }).then(response => response.json())
    .then(data => document.getElementById(`nilaiRow-${id}`).remove());
}
</script>
@endsection
