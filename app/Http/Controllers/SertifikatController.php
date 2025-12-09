<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Sertifikat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $sertifikats = Sertifikat::with('pengguna')->get(); // eager load relasi
    return view('admin.sertifikat.index', compact('sertifikats'));
}


  public function create()
{
    $penggunas = Pengguna::all(); // ambil semua pengguna
    return view('admin.sertifikat.create', compact('penggunas'));
}


    // ✅ Simpan Data Sertifikat
    public function store(Request $request)
    {
        $request->validate([
            'id_pengguna' => 'required',
            'nomor_sertifikat' => 'required',
            'sertifikasi' => 'required',
            'tgl_terbit' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('sertifikat', $fileName, 'public');
            $data['foto'] = $filePath;
        }

        Sertifikat::create($data);

        return redirect()->route('sertifikat.index')
                         ->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
public function show(Sertifikat $sertifikat)
{
    $sertifikat->load('pengguna'); // load relasi juga
    return view('admin.sertifikat.show', compact('sertifikat'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $sertifikat = Sertifikat::findOrFail($id);
    $penggunas = Pengguna::all();
    return view('admin.sertifikat.edit', compact('sertifikat', 'penggunas'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'id_pengguna' => 'required|exists:pengguna,id_pengguna',
        'nomor_sertifikat' => 'required',
        'sertifikasi' => 'required',
        'tgl_terbit' => 'required|date',
        'tgl_kadaluarsa' => 'required|date|after_or_equal:tgl_terbit',
        'status' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $sertifikat = Sertifikat::findOrFail($id);
    $data = $request->all();

    // Handle foto upload
    if ($request->hasFile('foto')) {
        // Delete old foto if exists
        if ($sertifikat->foto && Storage::disk('public')->exists($sertifikat->foto)) {
            Storage::disk('public')->delete($sertifikat->foto);
        }

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('sertifikat', $fileName, 'public');
        $data['foto'] = $filePath;
    }

    $sertifikat->update($data);

    return redirect()->route('sertifikat.index')->with('success', 'Data sertifikat berhasil diperbarui!');
}

public function destroy($id)
{
    $sertifikat = Sertifikat::findOrFail($id);

    // Delete foto if exists
    if ($sertifikat->foto && Storage::disk('public')->exists($sertifikat->foto)) {
        Storage::disk('public')->delete($sertifikat->foto);
    }

    $sertifikat->delete();

    return redirect()->route('sertifikat.index')->with('success', 'Sertifikat berhasil dihapus.');
}

}
