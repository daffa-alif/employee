@extends('layouts.app')

@section('title', 'Tambah Data Berkas')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Berkas</h2>

    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required class="w-full p-2 border rounded mb-2">
        <input type="text" name="NIK" placeholder="NIK" required class="w-full p-2 border rounded mb-2">
        <input type="email" name="email" placeholder="Email" required class="w-full p-2 border rounded mb-2">
        <input type="file" name="foto_user" required class="w-full p-2 border rounded mb-2">
        <textarea name="alamat" placeholder="Alamat" required class="w-full p-2 border rounded mb-2"></textarea>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800">Simpan</button>
    </form>
</div>
@endsection
