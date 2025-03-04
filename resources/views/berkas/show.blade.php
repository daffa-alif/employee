@extends('layouts.app')

@section('title', 'Detail Berkas')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Detail Berkas</h2>

    <p><strong>Nama:</strong> {{ $berkas->nama_lengkap }}</p>
    <p><strong>NIK:</strong> {{ $berkas->NIK }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ ucfirst($berkas->jenis_kelamin) }}</p>
    <p><strong>Email:</strong> {{ $berkas->email }}</p>
    <p><strong>Alamat:</strong> {{ $berkas->alamat }}</p>

    <div class="mt-4">
        <a href="{{ route('berkas.edit', $berkas->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700">Edit</a>
    </div>
</div>
@endsection
