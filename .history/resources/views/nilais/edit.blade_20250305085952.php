@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Edit Nilai</h1>

    <form action="{{ route('nilais.update', $nilai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="time" name="average_sertime" value="{{ $nilai->average_sertime }}" required>
        <input type="time" name="average_waittime" value="{{ $nilai->average_waittime }}" required>
        <input type="number" name="average_supel" value="{{ $nilai->average_supel }}" required>
        <input type="number" name="ceklis_pelayanan" value="{{ $nilai->ceklis_pelayanan }}" required>
        <input type="text" name="uji_pemahaman" required placeholder="uji pemahaman" value="{{ $nilai->ceklis_pelayanan }}" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
