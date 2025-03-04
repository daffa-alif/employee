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
        <select name="status">
            <option value="pending" {{ $nilai->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $nilai->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="rejected" {{ $nilai->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>

        <button type="submit">Update</button>
    </form>
</div>
@endsection
