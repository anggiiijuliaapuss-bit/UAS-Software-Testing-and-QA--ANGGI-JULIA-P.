<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Exports\BukuExport;
use App\Exports\PeminjamanExport;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->get('jenis', 'peminjaman');
        $dari = $request->get('dari');
        $sampai = $request->get('sampai');

        $data = $this->ambilData($jenis, $dari, $sampai);

        return view('laporan.index', compact('jenis', 'dari', 'sampai', 'data'));
    }

    public function exportPdf(Request $request)
    {
        $jenis = $request->get('jenis', 'peminjaman');
        $dari = $request->get('dari');
        $sampai = $request->get('sampai');

        $data = $this->ambilData($jenis, $dari, $sampai);

        $pdf = Pdf::loadView('laporan.pdf', compact('jenis', 'dari', 'sampai', 'data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-'.$jenis.'-'.now()->format('Ymd_His').'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $jenis = $request->get('jenis', 'peminjaman');
        $dari = $request->get('dari');
        $sampai = $request->get('sampai');

        $fileName = 'laporan-'.$jenis.'-'.now()->format('Ymd_His').'.xlsx';

        return match ($jenis) {
            'buku' => Excel::download(new BukuExport, $fileName),
            'anggota' => Excel::download(new AnggotaExport, $fileName),
            default => Excel::download(new PeminjamanExport($dari, $sampai), $fileName),
        };
    }

    private function ambilData(string $jenis, ?string $dari, ?string $sampai)
    {
        return match ($jenis) {
            'buku' => Buku::orderBy('judul')->get(),
            'anggota' => Anggota::orderBy('nama')->get(),
            default => Peminjaman::with(['anggota', 'buku', 'pengembalian'])
                ->when($dari, fn ($q) => $q->whereDate('tgl_pinjam', '>=', $dari))
                ->when($sampai, fn ($q) => $q->whereDate('tgl_pinjam', '<=', $sampai))
                ->orderByDesc('tgl_pinjam')
                ->get(),
        };
    }
}
