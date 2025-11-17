@extends('admin.layout')

@section('title', 'Tambah Notifikasi')
@section('header', 'Tambah Notifikasi')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2"></i>Tambah Notifikasi</h5>

    <form action="{{ route('notifikasi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Sertifikat</label>
            <select name="id_sertifikat" class="form-select" required>
                <option value="">-- Pilih Sertifikat --</option>
                @foreach ($sertifikat as $s)
                    <option value="{{ $s->id_sertifikat }}">{{ $s->nama_sertifikat }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Isi Pesan</label>
            <textarea name="isi_pesan" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Status Kirim</label>
            <select name="status_kirim" class="form-select" required>
                <option value="Terkirim">Terkirim</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Gagal">Gagal</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" class="form-control" required>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('notifikasi.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
        </div>

    </form>
</div>
@endsection
