@extends('admin.layout')

@section('title', 'Detail Sertifikat')
@section('header', 'Detail Sertifikat')

@section('content')
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-3"><i class="bi bi-info-circle me-2"></i>Detail Sertifikat</h5>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-borderless">
                <tr>
                    <th style="width:200px;">Nomor Sertifikat</th>
                    <td>{{ $sertifikat->nomor_sertifikat }}</td>
                </tr>
                <tr>
                    <th>Sertifikasi</th>
                    <td>{{ $sertifikat->sertifikasi }}</td>
                </tr>
                <tr>
                    <th>Nama Pengguna</th>
                    <td>{{ $sertifikat->pengguna->nama ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Terbit</th>
                    <td>{{ \Carbon\Carbon::parse($sertifikat->tgl_terbit)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kadaluarsa</th>
                    <td>{{ \Carbon\Carbon::parse($sertifikat->tgl_kadaluarsa)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($sertifikat->status == 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @elseif($sertifikat->status == 'kadaluarsa')
                            <span class="badge bg-danger">Kadaluarsa</span>
                        @else
                            <span class="badge bg-secondary text-capitalize">{{ $sertifikat->status }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Pas Foto Pengguna -->
        <div class="col-md-4 text-center">
            @if($sertifikat->pengguna && $sertifikat->pengguna->foto)
                <div class="mb-2">
                    <p class="fw-semibold mb-2">Pas Foto</p>
                    <img src="{{ asset('storage/' . $sertifikat->pengguna->foto) }}"
                         alt="Pas Foto {{ $sertifikat->pengguna->nama }}"
                         class="img-thumbnail shadow-sm"
                         style="max-width: 200px; max-height: 250px; object-fit: cover;">
                </div>
            @else
                <div class="text-muted">
                    <i class="bi bi-person-circle" style="font-size: 100px;"></i>
                    <p class="small">Pas foto tidak tersedia</p>
                </div>
            @endif
        </div>
    </div>

    @if($sertifikat->foto)
    <div class="mt-4">
        <h5 class="fw-semibold mb-3"><i class="bi bi-image me-2"></i>Foto Sertifikat</h5>
        <div class="text-center">
            <img src="{{ asset('storage/' . $sertifikat->foto) }}"
                 alt="Foto Sertifikat"
                 class="img-fluid rounded shadow"
                 style="max-width: 600px; max-height: 600px;">
        </div>
    </div>
    @endif

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('sertifikat.edit', $sertifikat->id_sertifikat) }}" class="btn btn-warning text-white">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>
</div>
@endsection
