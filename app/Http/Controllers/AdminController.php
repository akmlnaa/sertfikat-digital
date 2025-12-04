<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id_admin);
            Session::put('admin_nama', $admin->nama);
            return redirect('/dashboard');
        } else {
            return back()->with('error', 'Email atau password salah!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function dashboard()
{
    if (!Session::has('admin_id')) {
        return redirect('/login');
    }

    // Import model
    $totalPengguna = \App\Models\Pengguna::count();
    $totalSertifikat = \App\Models\Sertifikat::count();
    $totalNotifikasi = \App\Models\Notifikasi::count();

    // Sertifikat kadaluarsa
    $sertifikatKadaluarsa = \App\Models\Sertifikat::where('tgl_kadaluarsa', '<', now())->count();

    $grafikKompetensi = DB::table('sertifikat')
    ->join('pengguna', 'sertifikat.id_pengguna', '=', 'pengguna.id_pengguna')
    ->select('pengguna.kompetensi', DB::raw('COUNT(*) as total'))
    ->groupBy('pengguna.kompetensi')
    ->get();


    // Notifikasi terbaru
    $notifikasiTerbaru = \App\Models\Notifikasi::orderBy('tanggal_kirim', 'DESC')
        ->limit(5)
        ->get();

    return view('admin.dashboard', [
        'nama_admin' => Session::get('admin_nama'),
        'totalPengguna' => $totalPengguna,
        'totalSertifikat' => $totalSertifikat,
        'totalNotifikasi' => $totalNotifikasi,
        'sertifikatKadaluarsa' => $sertifikatKadaluarsa,
        'grafikKompetensi' => $grafikKompetensi,
        'notifikasiTerbaru' => $notifikasiTerbaru,
    ]);
}

}
