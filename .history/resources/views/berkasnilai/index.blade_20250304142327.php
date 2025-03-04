@extends('layouts.app')

@section('content')
       
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
@endsection