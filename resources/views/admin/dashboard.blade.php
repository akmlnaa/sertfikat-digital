@extends('admin.layout')

@section('title', 'Dashboard | Monitoring Sertifikasi Digital')
@section('header', 'Dashboard Admin')

@section('content')

{{-- ALERT WELCOME --}}
<div class="alert alert-info">
    Selamat datang di sistem Monitoring Sertifikasi Digital! 🎉
</div>


{{-- ====================== --}}
{{-- 3 KARTU MENU NAVIGASI --}}
{{-- ====================== --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body text-center">
                <h5 class="card-title">👥 Pengguna</h5>
                <p class="text-muted">Kelola data pengguna sistem</p>
                <a href="{{ route('pengguna.index') }}" class="btn btn-primary">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body text-center">
                <h5 class="card-title">🎓 Sertifikat</h5>
                <p class="text-muted">Atur data dan status sertifikasi</p>
                <a href="{{ route('sertifikat.index') }}" class="btn btn-success">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body text-center">
                <h5 class="card-title">🔔 Notifikasi</h5>
                <p class="text-muted">Kirim pemberitahuan terbaru</p>
                <a href="{{ route('notifikasi.index') }}" class="btn btn-warning text-white">Kelola</a>
            </div>
        </div>
    </div>
</div>



{{-- ================================================= --}}
{{-- STATISTIK RINGKAS (TOTAL PENGGUNA, SERTIFIKAT DLL) --}}
{{-- ================================================= --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card card-custom p-3 shadow-sm border-0">
            <h6 class="fw-semibold text-muted">Total Pengguna</h6>
            <h3 class="fw-bold">{{ $totalPengguna }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-custom p-3 shadow-sm border-0">
            <h6 class="fw-semibold text-muted">Total Sertifikat</h6>
            <h3 class="fw-bold">{{ $totalSertifikat }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-custom p-3 shadow-sm border-0">
            <h6 class="fw-semibold text-muted">Total Notifikasi</h6>
            <h3 class="fw-bold">{{ $totalNotifikasi }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-custom p-3 shadow-sm border-0">
            <h6 class="fw-semibold text-muted">Sertifikat Kadaluarsa</h6>
            <h3 class="fw-bold text-danger">{{ $sertifikatKadaluarsa }}</h3>
        </div>
    </div>

</div>



{{-- ====================== --}}
{{-- CHART SERTIFIKAT PER KOMPETENSI --}}
{{-- ====================== --}}
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold mb-0">
            <i class="bi bi-graph-up-arrow me-2 text-primary"></i>
            Sertifikasi per Kompetensi
        </h5>
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
            Statistik
        </span>
    </div>
    <canvas id="chartKompetensi" height="120"></canvas>
</div>







{{-- ====================== --}}
{{-- NOTIFIKASI TERBARU --}}
{{-- ====================== --}}
<div class="card card-custom p-4">
    <h5 class="fw-semibold mb-3"><i class="bi bi-bell me-2"></i>Notifikasi Terbaru</h5>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Sertifikat</th>
                <th>Tanggal Kirim</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($notifikasiTerbaru as $n)
                <tr>
                    <td>{{ $n->judul }}</td>
                    <td>{{ $n->sertifikat->sertifikasi ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($n->tanggal_kirim)->format('d M Y') }}</td>
                    <td>
                        @if($n->status_kirim == 'berhasil')
                            <span class="badge bg-success">Berhasil</span>
                        @elseif($n->status_kirim == 'gagal')
                            <span class="badge bg-danger">Gagal</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($n->status_kirim) }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada notifikasi terbaru</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection




{{-- ======================================== --}}
{{--  SCRIPT: CHARTJS --}}
{{-- ======================================== --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartKompetensi');

const labels = @json($grafikKompetensi->pluck('kompetensi'));
const dataValues = @json($grafikKompetensi->pluck('total'));

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Sertifikat',
            data: dataValues,
            backgroundColor: '#4f46e5', // biru modern
            borderRadius: 12,
            barThickness: 40
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            tooltip: {
                backgroundColor: '#111827',
                titleFont: { size: 14 },
                bodyFont: { size: 13 },
                padding: 12,
                cornerRadius: 8
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 12
                    }
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e5e7eb'
                },
                ticks: {
                    font: {
                        size: 12
                    }
                }
            }
        }
    }
});
</script>
@endsection





