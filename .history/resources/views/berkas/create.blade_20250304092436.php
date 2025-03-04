@extends('layouts.app')

@section('title', 'Tambah Data Berkas')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Berkas</h2>

    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Lengkap -->
        <label class="block mb-2 font-semibold">Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required 
               class="w-full p-2 border rounded mb-4">

        <!-- Foto User -->
        <label class="block mb-2 font-semibold">Foto User:</label>
        <input type="file" name="foto_user" accept="image/*" required 
               class="w-full p-2 border rounded mb-4">

        <!-- NIK -->
        <label class="block mb-2 font-semibold">NIK:</label>
        <input type="text" name="NIK" placeholder="Masukkan NIK" required 
               class="w-full p-2 border rounded mb-4">

        <!-- Jenis Kelamin -->
        <label class="block mb-2 font-semibold">Jenis Kelamin:</label>
        <select name="jenis_kelamin" required class="w-full p-2 border rounded mb-4">
            <option value="laki-laki">Laki-Laki</option>
            <option value="perempuan">Perempuan</option>
        </select>

        <!-- Email -->
        <label class="block mb-2 font-semibold">Email:</label>
        <input type="email" name="email" placeholder="Masukkan Email" required 
               class="w-full p-2 border rounded mb-4">

        <!-- Alamat -->
        <label class="block mb-2 font-semibold">Alamat:</label>
        <textarea name="alamat" placeholder="Masukkan Alamat" required 
                  class="w-full p-2 border rounded mb-4"></textarea>

        <!-- Tombol Submit -->
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800">Simpan</button>
    </form>
</div>
@endsection
