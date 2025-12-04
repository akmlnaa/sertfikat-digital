@extends('admin.layout')

@section('title', 'Data Notifikasi')
@section('header', 'Data Notifikasi')

@section('content')
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold"><i class="bi bi-bell me-2"></i>Daftar Notifikasi</h5>
        <a href="{{ route('notifikasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Notifikasi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Sertifikat</th>
                <th>Status Kirim</th>
                <th>Tanggal Kirim</th>
                <th style="width:120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($notifikasi as $n)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $n->judul }}</td>
                    <td>{{ $n->sertifikat->sertifikasi ?? '—' }}</td>
                    <td>
                        <span class="badge 
                            @if($n->status_kirim == 'Terkirim') bg-success
                            @elseif($n->status_kirim == 'Menunggu') bg-warning text-dark
                            @else bg-danger @endif">
                            {{ $n->status_kirim }}
                        </span>
                    </td>
                    <td>{{ $n->tanggal_kirim }}</td>
                    <td>
                        <form action="{{ route('notifikasi.destroy', $n->id_notifikasi) }}"
                              method="POST" onsubmit="return confirm('Hapus notifikasi ini?')">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data notifikasi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
