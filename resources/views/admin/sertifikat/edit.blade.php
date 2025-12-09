@extends('admin.layout')

@section('title', 'Edit Sertifikat')
@section('header', 'Edit Sertifikat')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-3"><i class="bi bi-pencil-square me-2"></i>Edit Sertifikat</h5>

    <form action="{{ route('sertifikat.update', $sertifikat->id_sertifikat) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Pengguna</label>
            <select name="id_pengguna" class="form-select" required>
                @foreach($penggunas as $p)
                    <option value="{{ $p->id_pengguna }}" 
                        {{ $sertifikat->id_pengguna == $p->id_pengguna ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Sertifikat</label>
            <input type="text" name="nomor_sertifikat" class="form-control"
                   value="{{ $sertifikat->nomor_sertifikat }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sertifikasi</label>
            <input type="text" name="sertifikasi" class="form-control"
                   value="{{ $sertifikat->sertifikasi }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Terbit</label>
                <input type="date" name="tgl_terbit" class="form-control"
                       value="{{ $sertifikat->tgl_terbit }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" name="tgl_kadaluarsa" class="form-control"
                       value="{{ $sertifikat->tgl_kadaluarsa }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif" {{ $sertifikat->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="kadaluarsa" {{ $sertifikat->status == 'kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                <option value="dalam proses" {{ $sertifikat->status == 'dalam proses' ? 'selected' : '' }}>Dalam Proses</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Sertifikat</label>
            @if($sertifikat->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $sertifikat->foto) }}"
                         alt="Foto Sertifikat"
                         class="img-thumbnail"
                         style="max-width: 200px; max-height: 200px;">
                    <p class="text-muted small mt-1">Foto saat ini</p>
                </div>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg">
            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-warning text-white">
                <i class="bi bi-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
