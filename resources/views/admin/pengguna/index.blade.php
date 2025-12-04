{{-- resources/views/admin/pengguna/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Daftar Pengguna')
@section('header', 'Manajemen Pengguna')

@section('content')
<div class="card card-custom p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold mb-0"><i class="bi bi-people me-2"></i>Daftar Pengguna</h5>
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($penggunas->isEmpty())
        <div class="alert alert-warning">Belum ada pengguna terdaftar.</div>
    @else
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:50px">#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Kompetensi</th>
                    <th>Divisi</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th style="width:160px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penggunas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->kompetensi }}</td>
                    <td>{{ $item->divisi }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp ?? '-' }}</td>
                    <td class="text-center">
                        {{-- Detail --}}
                        <a href="{{ route('pengguna.show', ['pengguna' => $item->id_pengguna]) }}"
                           class="btn btn-sm btn-outline-info" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('pengguna.edit', ['pengguna' => $item->id_pengguna]) }}"
                           class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        {{-- Hapus (modal trigger) --}}
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal{{ $item->id_pengguna }}" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                {{-- Modal Konfirmasi Hapus --}}
                <div class="modal fade" id="hapusModal{{ $item->id_pengguna }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center py-4">
                                <i class="bi bi-exclamation-triangle text-danger display-5"></i>
                                <h5 class="mt-3 mb-2">Hapus Pengguna Ini?</h5>
                                <p class="text-muted small">Data akan dihapus secara permanen.</p>
                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('pengguna.destroy', ['pengguna' => $item->id_pengguna]) }}"
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
