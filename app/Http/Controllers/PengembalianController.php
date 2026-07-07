<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    /** Denda per hari keterlambatan (Rupiah) */
    const DENDA_PER_HARI = 1000;

    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $pengembalian = Pengembalian::with(['peminjaman.anggota', 'peminjaman.buku'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('peminjaman.anggota', fn ($q) => $q->where('nama', 'like', "%{$keyword}%"))
                    ->orWhereHas('peminjaman.buku', fn ($q) => $q->where('judul', 'like', "%{$keyword}%"));
            })
            ->orderByDesc('tgl_kembali_aktual')
            ->paginate(10)
            ->withQueryString();

        return view('pengembalian.index', compact('pengembalian', 'keyword'));
    }

    public function create()
    {
        $peminjamanAktif = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'Dipinjam')
            ->orderBy('tgl_kembali')
            ->get();

        return view('pengembalian.create', compact('peminjamanAktif'));
    }

    public function hitungDenda(Peminjaman $peminjaman, ?string $tglAktual = null): float
    {
        $tglAktual = $tglAktual ? \Carbon\Carbon::parse($tglAktual) : now();
        $telat = $tglAktual->diffInDays($peminjaman->tgl_kembali, false) * -1;

        return $telat > 0 ? $telat * self::DENDA_PER_HARI : 0;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peminjaman_id' => ['required', 'exists:peminjaman,id'],
            'tgl_kembali_aktual' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $peminjaman = Peminjaman::findOrFail($validated['peminjaman_id']);

        if ($peminjaman->status !== 'Dipinjam') {
            return back()->withInput()->with('error', 'Peminjaman ini sudah dikembalikan sebelumnya.');
        }

        $denda = $this->hitungDenda($peminjaman, $validated['tgl_kembali_aktual']);

        DB::transaction(function () use ($validated, $peminjaman, $denda) {
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tgl_kembali_aktual' => $validated['tgl_kembali_aktual'],
                'denda' => $denda,
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            $peminjaman->update(['status' => 'Dikembalikan']);
            $peminjaman->buku->increment('stok');
        });

        $pesan = 'Pengembalian berhasil dicatat.';
        if ($denda > 0) {
            $pesan .= ' Denda keterlambatan: Rp '.number_format($denda, 0, ',', '.').'.';
        }

        return redirect()->route('pengembalian.index')->with('success', $pesan);
    }

    public function destroy(Pengembalian $pengembalian)
    {
        DB::transaction(function () use ($pengembalian) {
            $peminjaman = $pengembalian->peminjaman;
            $peminjaman->update(['status' => 'Dipinjam']);
            $peminjaman->buku->decrement('stok');
            $pengembalian->delete();
        });

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
