<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Sertifikat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'nama_sertifikat' => 'required',
            'tgl_terbit' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
            'status' => 'required'
        ]);

        Sertifikat::create($request->all());

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
        'nama_sertifikat' => 'required',
        'tgl_terbit' => 'required|date',
        'tgl_kadaluarsa' => 'required|date|after_or_equal:tgl_terbit',
        'status' => 'required'
    ]);

    $sertifikat = Sertifikat::findOrFail($id);
    $sertifikat->update($request->all());

    return redirect()->route('sertifikat.index')->with('success', 'Data sertifikat berhasil diperbarui!');
}

public function destroy($id)
{
    $sertifikat = Sertifikat::findOrFail($id);
    $sertifikat->delete();

    return redirect()->route('sertifikat.index')->with('success', 'Sertifikat berhasil dihapus.');
}

}
