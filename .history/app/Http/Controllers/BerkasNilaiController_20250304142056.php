<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasEmployee;
use Illuminate\Support\Facades\Auth;

class BerkasNilaiController extends Controller
{
    public function index()
    {
        // Ambil data berdasarkan user yang sedang login
        $berkas = BerkasEmployee::where('id_user', Auth::id())->with('nilai')->first();

        return view('berkasnilai.index', compact('berkas'));
    }
}
