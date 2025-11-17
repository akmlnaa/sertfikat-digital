<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::with('sertifikat')->get();
        return view('admin.notifikasi.index', compact('notifikasi'));
    }

    public function create()
    {
        $sertifikat = Sertifikat::all();
        return view('admin.notifikasi.create', compact('sertifikat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sertifikat' => 'required',
            'judul' => 'required',
            'isi_pesan' => 'required',
            'status_kirim' => 'required',
            'tanggal_kirim' => 'required|date',
        ]);

        Notifikasi::create($request->all());
        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();
        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil dihapus');
    }
}
