<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'kompetensi' => 'required',
        'divisi' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $data = $request->all();

    // Handle foto upload
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('pengguna', $fileName, 'public');
        $data['foto'] = $filePath;
    }

    \App\Models\Pengguna::create($data);

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
        'kompetensi' => 'required',
        'divisi' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $pengguna = \App\Models\Pengguna::findOrFail($id);
    $data = $request->all();

    // Handle foto upload
    if ($request->hasFile('foto')) {
        // Delete old foto if exists
        if ($pengguna->foto && Storage::disk('public')->exists($pengguna->foto)) {
            Storage::disk('public')->delete($pengguna->foto);
        }

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('pengguna', $fileName, 'public');
        $data['foto'] = $filePath;
    }

    $pengguna->update($data);

    return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
}


    public function destroy($id)
{
    $pengguna = \App\Models\Pengguna::findOrFail($id);

    // Delete foto if exists
    if ($pengguna->foto && Storage::disk('public')->exists($pengguna->foto)) {
        Storage::disk('public')->delete($pengguna->foto);
    }

    $pengguna->delete();

    return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus!');
}

}
