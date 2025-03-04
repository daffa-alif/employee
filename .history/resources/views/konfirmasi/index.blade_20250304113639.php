@extends('layouts.app')

@section('title', 'Konfirmasi Nilai')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Konfirmasi Nilai</h2>

    <table class="min-w-full border bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Nilai</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilais as $nilai)
            <tr class="border">
                <td class="px-4 py-2">{{ $nilai->id }}</td>
                <td class="px-4 py-2">{{ $nilai->nama_lengkap }}</td>
                <td class="px-4 py-2">{{ $nilai->nilai }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded {{ $nilai->status === 'accepted' ? 'bg-green-500' : ($nilai->status === 'rejected' ? 'bg-red-500' : 'bg-gray-500') }} text-white">
                        {{ ucfirst($nilai->status) }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    @if ($nilai->status === 'pending')
                        <form action="{{ route('konfirmasi.accept', $nilai->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Accept</button>
                        </form>
                        <form action="{{ route('konfirmasi.reject', $nilai->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection