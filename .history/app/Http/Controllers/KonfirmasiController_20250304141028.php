<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    // Display all Nilai records for confirmation
    public function index()
    {
        $nilais = Nilai::all(); // Fetch all Nilai records
        return view('konfirmasi.index', compact('nilais'));
    }

    // Accept a Nilai record
    public function accept(Nilai $nilai)
    {
        $nilai->update(['status' => 'confirmed']); // Update status to 'accepted'
        return redirect()->route('konfirmasi.index')->with('success', 'Nilai accepted successfully.');
    }

    // Reject a Nilai record
    public function reject(Nilai $nilai)
    {
        $nilai->update(['status' => 'rejected']); // Update status to 'rejected'
        return redirect()->route('konfirmasi.index')->with('success', 'Nilai rejected successfully.');
    }
}