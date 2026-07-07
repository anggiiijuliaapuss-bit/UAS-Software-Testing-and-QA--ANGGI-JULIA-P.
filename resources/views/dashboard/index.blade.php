@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @if ($bukuHabis->count() > 0)
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-start" role="alert">
            <i class="fa-solid fa-triangle-exclamation fa-lg me-2 mt-1 text-warning"></i>
            <div>
                <strong>Notifikasi Stok Habis!</strong>
                Ada {{ $bukuHabis->count() }} judul buku dengan stok habis:
                <strong>{{ $bukuHabis->pluck('judul')->implode(', ') }}</strong>.
                Segera lakukan restock.
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg,#6d28d9,#7c3aed);">
                <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                <div class="stat-label">Total Judul Buku</div>
                <div class="stat-value">{{ $totalJudulBuku }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg,#0891b2,#06b6d4);">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-label">Jumlah Anggota</div>
                <div class="stat-value">{{ $jumlahAnggota }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg,#ea580c,#f97316);">
                <div class="stat-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                <div class="stat-label">Buku Dipinjam</div>
                <div class="stat-value">{{ $jumlahDipinjam }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg,#16a34a,#22c55e);">
                <div class="stat-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div class="stat-label">Stok Tersedia</div>
                <div class="stat-value">{{ $jumlahTersedia }}</div>
            </div>
        </div>
    </div>

    {{-- CHART + TOP BUKU --}}
    <div class="row g-3 mb-3">
        <div class="col-md-7">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fa-solid fa-chart-line text-purple" style="color:#7c3aed;"></i>
                    Grafik Peminjaman 6 Bulan Terakhir
                </div>
                <div class="card-body">
                    <canvas id="chartPeminjaman" height="130"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fa-solid fa-fire" style="color:#ea580c;"></i>
                    Buku Terpopuler
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($bukuTerpopuler as $i => $b)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3" style="font-size:.875rem;">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill"
                                      style="background:#ede9fe;color:#6d28d9;width:24px;height:24px;display:flex;align-items:center;justify-content:center;font-size:.7rem;">
                                    {{ $i + 1 }}
                                </span>
                                <span>{{ $b->judul }}</span>
                            </div>
                            <span class="badge" style="background:#6d28d9;border-radius:8px;">{{ $b->peminjaman_count }}x</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted" style="font-size:.875rem;">Belum ada data peminjaman.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- TERLAMBAT --}}
    <div class="card">
        <div class="card-header d-flex align-items-center gap-2">
            <i class="fa-solid fa-clock" style="color:#ef4444;"></i>
            Peminjaman Terlambat
            @if($peminjamanTerlambat->count() > 0)
                <span class="badge ms-1" style="background:#fef2f2;color:#ef4444;border-radius:8px;">
                    {{ $peminjamanTerlambat->count() }} item
                </span>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Keterlambatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamanTerlambat as $p)
                        <tr>
                            <td>{{ $p->anggota->nama }}</td>
                            <td>{{ $p->buku->judul }}</td>
                            <td>{{ $p->tgl_pinjam->format('d M Y') }}</td>
                            <td>{{ $p->tgl_kembali->format('d M Y') }}</td>
                            <td>
                                <span class="badge" style="background:#fef2f2;color:#ef4444;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-clock me-1"></i>
                                    {{ now()->diffInDays($p->tgl_kembali) }} hari
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4" style="color:#6d28d9;font-size:.875rem;">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                Tidak ada keterlambatan. Semua buku tepat waktu!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('chartPeminjaman');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Peminjaman',
            data: @json($chartData),
            borderColor: '#7c3aed',
            backgroundColor: 'rgba(124,58,237,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#7c3aed',
            pointRadius: 5,
            pointHoverRadius: 7,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1, color: '#9ca3af', font: { size: 11 } },
                grid: { color: '#f3f4f6' }
            },
            x: {
                ticks: { color: '#9ca3af', font: { size: 11 } },
                grid: { display: false }
            }
        }
    }
});
</script>
@endpush
