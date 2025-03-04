<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BerkasEmployee;

class BerkasEmployeeController extends Controller
{
    // Tampilkan data berkas jika ada, jika tidak arahkan ke form create
    public function index()
    {
        // Ambil data berkas berdasarkan user yang login
        $berkas = BerkasEmployee::where('id_user', Auth::id())->first();

        // Jika belum ada data, redirect ke halaman create
        if (!$berkas) {
            return redirect()->route('berkas.create');
        }

        // Jika ada data, redirect ke halaman show
        return redirect()->route('berkas.show', $berkas->id);
    }

    public function show($id)
    {
        $berkas = BerkasEmployee::findOrFail($id);

        // Pastikan hanya pemilik data yang bisa melihatnya
        if ($berkas->id_user !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('berkas.show', compact('berkas'));
    }


    // Form Create hanya ditampilkan jika belum ada data
    public function create()
    {
        $berkas = BerkasEmployee::where('id_user', Auth::id())->first();
        if ($berkas) {
            return redirect()->route('berkas.index');
        }
        return view('berkas.create');
    }

    // Simpan data pertama kali
    public function store(Request $request)
{
    // Cek apakah user sudah memiliki data
    $existingBerkas = BerkasEmployee::where('id_user', Auth::id())->first();
    if ($existingBerkas) {
        return redirect()->route('berkas.show', $existingBerkas->id);
    }

    // Validasi input
    $data = $request->validate([
        'nama_lengkap' => 'required|string',
        'foto_user' => 'required|image|max:2048',
        'NIK' => 'required|string|unique:berkas_employees,NIK',
        'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        'email' => 'required|email|unique:berkas_employees,email',
        'alamat' => 'required|string',
    ]);

    // Upload foto
    if ($request->hasFile('foto_user')) {
        $data['foto_user'] = $request->file('foto_user')->store('uploads', 'public');
    }

    // Tambahkan ID user
    $data['id_user'] = Auth::id();

    // Simpan data
    $berkas = BerkasEmployee::create($data);

    // Redirect langsung ke halaman show
    return redirect()->route('berkas.show', $berkas->id)->with('success', 'Data Berhasil Ditambahkan');
}


    // Form Edit
    public function edit()
    {
        $berkas = BerkasEmployee::where('id_user', Auth::id())->first();
        if (!$berkas) {
            return redirect()->route('berkas.create');
        }
        return view('berkas.edit', compact('berkas'));
    }

    // Update Data
    public function update(Request $request)
    {
        $berkas = BerkasEmployee::where('id_user', Auth::id())->first();
        if (!$berkas) {
            return redirect()->route('berkas.create');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'foto_user' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'NIK' => 'required|string|max:16|unique:berkas_employees,NIK,' . $berkas->id,
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'email' => 'required|email|unique:berkas_employees,email,' . $berkas->id,
            'alamat' => 'required|string|max:500',
        ]);

        if ($request->hasFile('foto_user')) {
            $fotoPath = $request->file('foto_user')->store('uploads', 'public');
            $berkas->foto_user = $fotoPath;
        }

        $berkas->update([
            'nama_lengkap' => $request->nama_lengkap,
            'NIK' => $request->NIK,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('berkas.index')->with('success', 'Data berhasil diperbarui.');
    }
}
