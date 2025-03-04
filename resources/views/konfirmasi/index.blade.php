@extends('layouts.app')

@section('title', 'Konfirmasi Nilai')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Konfirmasi Nilai</h2>

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
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 rounded {{ $nilai->status === 'accepted' ? 'bg-green-500' : ($nilai->status === 'rejected' ? 'bg-red-500' : 'bg-gray-500') }} text-white">
                            {{ ucfirst($nilai->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        @if ($nilai->status === 'pending')
                            <form action="{{ route('konfirmasi.accept', $nilai->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Accept</button>
                            </form>
                            <form action="{{ route('konfirmasi.reject', $nilai->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Reject</button>
                            </form>
                        @else
                            <span class="text-gray-500">No action</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection