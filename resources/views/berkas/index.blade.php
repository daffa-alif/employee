@extends('layouts.app')

@section('title', 'Data Berkas')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Data Berkas</h2>

    <p><strong>Nama:</strong> {{ $berkas->nama_lengkap }}</p>
    <p><strong>NIK:</strong> {{ $berkas->NIK }}</p>
    <p><strong>Email:</strong> {{ $berkas->email }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ ucfirst($berkas->jenis_kelamin) }}</p>
    <p><strong>Alamat:</strong> {{ $berkas->alamat }}</p>
    <img src="{{ asset('storage/' . $berkas->foto_user) }}" class="w-32 h-32 rounded mt-4">

    <div class="mt-6">
        <a href="{{ route('berkas.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-800">Edit</a>
    </div>
</div>
@endsection
