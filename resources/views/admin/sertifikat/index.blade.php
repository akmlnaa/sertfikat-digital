{{-- resources/views/admin/sertifikat/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Kelola Sertifikat')
@section('header', 'Manajemen Sertifikat')

@section('content')
<div class="card card-custom p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold mb-0"><i class="bi bi-award me-2"></i>Daftar Sertifikat</h5>
        <a href="{{ route('sertifikat.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Sertifikat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($sertifikats->isEmpty())
        <div class="alert alert-warning">Belum ada sertifikat terdaftar.</div>
    @else
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:50px">#</th>
                    <th>Nomor Sertifikat</th>
                    <th>Sertifikasi</th>
                    <th>Nama Pengguna</th>
                    <th>Tanggal Terbit</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Status</th>
                    <th style="width:160px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sertifikats as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nomor_sertifikat }}</td>
                    <td>{{ $item->sertifikasi }}</td>
                    <td>{{ $item->pengguna->nama ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_terbit)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_kadaluarsa)->format('d M Y') }}</td>
                    <td>
                        @if($item->status == 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @elseif($item->status == 'kadaluarsa')
                            <span class="badge bg-danger">Kadaluarsa</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{-- Detail --}}
                        <a href="{{ route('sertifikat.show', ['sertifikat' => $item->id_sertifikat]) }}"
                           class="btn btn-sm btn-outline-info" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('sertifikat.edit', ['sertifikat' => $item->id_sertifikat]) }}"
                           class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        {{-- Hapus (modal trigger) --}}
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal{{ $item->id_sertifikat }}" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                {{-- Modal Konfirmasi Hapus --}}
                <div class="modal fade" id="hapusModal{{ $item->id_sertifikat }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center py-4">
                                <i class="bi bi-exclamation-triangle text-danger display-5"></i>
                                <h5 class="mt-3 mb-2">Hapus Sertifikat Ini?</h5>
                                <p class="text-muted small">Data sertifikat akan dihapus secara permanen.</p>
                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('sertifikat.destroy', ['sertifikat' => $item->id_sertifikat]) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
