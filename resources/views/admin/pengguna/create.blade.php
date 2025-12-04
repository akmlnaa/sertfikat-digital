@extends('admin.layout')

@section('title', 'Tambah Pengguna')
@section('header', 'Tambah Pengguna')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-4"><i class="bi bi-person-plus me-2"></i>Tambah Pengguna Baru</h5>

    <form action="{{ route('pengguna.store') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label fw-medium">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">NIP</label>
            <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">Kompetensi</label>
            <input type="text" name="kompetensi" class="form-control" placeholder="Masukkan kompetensi" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">Divisi</label>
            <input type="text" name="divisi" class="form-control" placeholder="Masukkan divisi" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan nomor HP" required>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
