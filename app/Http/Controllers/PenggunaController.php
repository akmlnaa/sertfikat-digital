<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    // 🔹 Tampilkan semua pengguna
    public function index()
    {
        $penggunas = Pengguna::all();
        return view('admin.pengguna.index', compact('penggunas'));
    }

    public function create()
{
    return view('admin.pengguna.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'nip' => 'required',
        'jabatan' => 'required',
        'divisi' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',
    ]);

    \App\Models\Pengguna::create($request->all());

    return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
}


    
    public function show($id)
    {
        $pengguna = Pengguna::with(['sertifikat', 'notifikasi'])->findOrFail($id);
        return view('admin.pengguna.show', compact('pengguna'));
    }

    public function edit($id)
{
    $pengguna = \App\Models\Pengguna::findOrFail($id);
    return view('admin.pengguna.edit', compact('pengguna'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'nip' => 'required',
        'jabatan' => 'required',
        'divisi' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',
    ]);

    $pengguna = \App\Models\Pengguna::findOrFail($id);
    $pengguna->update($request->all());

    return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
}


    public function destroy($id)
{
    $pengguna = \App\Models\Pengguna::findOrFail($id);
    $pengguna->delete();

    return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus!');
}

}
