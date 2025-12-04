@extends('admin.layout')

@section('title', 'Edit Pengguna')
@section('header', 'Edit Pengguna')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Data Pengguna</h5>

    <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label class="form-label fw-medium">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ $pengguna->nama }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ $pengguna->nip }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">Kompetensi</label>
            <input type="text" name="kompetensi" class="form-control" value="{{ $pengguna->kompetensi }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">Divisi</label>
            <input type="text" name="divisi" class="form-control" value="{{ $pengguna->divisi }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pengguna->no_hp }}" required>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
