<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\BerkasEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with('berkasEmployee')->get();
        return view('nilais.index', compact('nilais'));
    }

   

    public function edit(Nilai $nilai)
    {
        return view('nilais.edit', compact('nilai'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'id_berkas' => 'required|exists:berkas_employees,id',
        'average_sertime' => 'required',
        'average_waittime' => 'required',
        'average_waittime' => 'required',
        'average_supel' => 'required|numeric',
        'ceklis_pelayanan' => 'required|numeric',
    ]);

    $data['status'] = 'pending'; // Status default "pending"
    
    $nilai = Nilai::create($data);
    return response()->json(['message' => 'Nilai berhasil ditambahkan!', 'nilai' => $nilai]);
}

public function update(Request $request, Nilai $nilai)
{
    $data = $request->validate([
        'average_sertime' => 'required',
        'average_waittime' => 'required',
        'average_supel' => 'required|numeric',
        'ceklis_pelayanan' => 'required|numeric',
    ]);

    // Jangan update status (biarkan hanya superadmin yang bisa mengubahnya)
    $nilai->update($data);
    return response()->json(['message' => 'Nilai berhasil diperbarui!', 'nilai' => $nilai]);
}


    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return response()->json(['message' => 'Nilai berhasil dihapus!']);
    }
}
