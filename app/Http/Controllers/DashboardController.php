<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::sum('stok') + Peminjaman::where('status', 'Dipinjam')->count();
        // Jumlah judul buku (total record) & total eksemplar tersedia
        $totalJudulBuku = Buku::count();
        $jumlahAnggota = Anggota::count();
        $jumlahDipinjam = Peminjaman::where('status', 'Dipinjam')->count();
        $jumlahTersedia = Buku::sum('stok');

        $bukuHabis = Buku::where('stok', '<=', 0)->orderBy('judul')->get();

        $peminjamanTerlambat = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'Dipinjam')
            ->where('tgl_kembali', '<', now()->toDateString())
            ->orderBy('tgl_kembali')
            ->get();

        // Data grafik: peminjaman per bulan (6 bulan terakhir)
        $peminjamanPerBulan = Peminjaman::select(
                DB::raw("DATE_FORMAT(tgl_pinjam, '%Y-%m') as bulan"),
                DB::raw('count(*) as total')
            )
            ->where('tgl_pinjam', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i)->format('Y-m');
            $chartLabels[] = now()->subMonths($i)->translatedFormat('M Y');
            $found = $peminjamanPerBulan->firstWhere('bulan', $bulan);
            $chartData[] = $found ? $found->total : 0;
        }

        // Top 5 buku terpopuler (paling banyak dipinjam)
        $bukuTerpopuler = Buku::withCount('peminjaman')
            ->orderByDesc('peminjaman_count')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalJudulBuku',
            'jumlahAnggota',
            'jumlahDipinjam',
            'jumlahTersedia',
            'bukuHabis',
            'peminjamanTerlambat',
            'chartLabels',
            'chartData',
            'bukuTerpopuler'
        ));
    }
}
