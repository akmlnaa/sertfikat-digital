@extends('admin.layout')

@section('title', 'Tambah Sertifikat')
@section('header', 'Tambah Sertifikat Baru')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2"></i>Tambah Sertifikat</h5>

    <form action="{{ route('sertifikat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Pengguna</label>
            <select name="id_pengguna" class="form-select" required>
                <option value="" disabled selected>Pilih Pengguna</option>
                @foreach($penggunas as $p)
                    <option value="{{ $p->id_pengguna }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Sertifikat</label>
            <input type="text" name="nomor_sertifikat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Sertifikat</label>
            <input type="text" name="nama_sertifikat" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Terbit</label>
                <input type="date" name="tgl_terbit" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" name="tgl_kadaluarsa" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif">Aktif</option>
                <option value="kadaluarsa">Kadaluarsa</option>
                <option value="dalam proses">Dalam Proses</option>
            </select>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Batal
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
