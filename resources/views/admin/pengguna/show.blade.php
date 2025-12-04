@extends('admin.layout')

@section('title', 'Detail Pengguna')
@section('header', 'Detail Pengguna')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-4"><i class="bi bi-person-vcard me-2"></i>Detail Pengguna</h5>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium">Nama Lengkap</label>
            <input type="text" class="form-control" value="{{ $pengguna->nama }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium">NIP</label>
            <input type="text" class="form-control" value="{{ $pengguna->nip }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium">Kompetensi</label>
            <input type="text" class="form-control" value="{{ $pengguna->kompetensi }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium">Divisi</label>
            <input type="text" class="form-control" value="{{ $pengguna->divisi }}" readonly>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label class="form-label fw-medium">Email</label>
            <input type="text" class="form-control" value="{{ $pengguna->email }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium">No HP</label>
            <input type="text" class="form-control" value="{{ $pengguna->no_hp }}" readonly>
        </div>
    </div>
    <hr class="my-4">

<h5 class="fw-semibold mb-3"><i class="bi bi-bell me-2"></i>Riwayat Notifikasi</h5>

<div class="card card-custom p-3">
    @if($pengguna->notifikasi->count() == 0)
        <p class="text-muted fst-italic">Belum ada notifikasi untuk pengguna ini.</p>
    @else
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Tanggal Kirim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengguna->notifikasi as $n)
                    <tr>
                        <td>{{ $n->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($n->tanggal_kirim)->format('d M Y') }}</td>
                        <td>
                            @if($n->status_kirim == 'sukses')
                                <span class="badge bg-success">Sukses</span>
                            @elseif($n->status_kirim == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('pengguna.edit', $pengguna->id_pengguna) }}" class="btn btn-warning text-white">
            <i class="bi bi-pencil-square"></i> Edit
        </a>
        <form action="{{ route('pengguna.destroy', $pengguna->id_pengguna) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
    </div>
</div>
@endsection
