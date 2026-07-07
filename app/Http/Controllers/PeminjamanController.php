<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');
        $status = $request->get('status');

        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('anggota', fn ($q) => $q->where('nama', 'like', "%{$keyword}%"))
                    ->orWhereHas('buku', fn ($q) => $q->where('judul', 'like', "%{$keyword}%"));
            })
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByDesc('tgl_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjaman', 'keyword', 'status'));
    }

    public function create()
    {
        $anggota = Anggota::orderBy('nama')->get();
        $buku = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'buku_id' => ['required', 'exists:buku,id'],
            'tgl_pinjam' => ['required', 'date'],
            'tgl_kembali' => ['required', 'date', 'after_or_equal:tgl_pinjam'],
        ]);

        $buku = Buku::findOrFail($validated['buku_id']);

        if ($buku->stok < 1) {
            return back()->withInput()->with('error', 'Stok buku "'.$buku->judul.'" habis, tidak dapat dipinjam.');
        }

        DB::transaction(function () use ($validated, $buku) {
            Peminjaman::create([
                ...$validated,
                'status' => 'Dipinjam',
            ]);

            $buku->decrement('stok');
        });

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman berhasil disimpan.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $anggota = Anggota::orderBy('nama')->get();
        $buku = Buku::orderBy('judul')->get();

        return view('peminjaman.edit', compact('peminjaman', 'anggota', 'buku'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'buku_id' => ['required', 'exists:buku,id'],
            'tgl_pinjam' => ['required', 'date'],
            'tgl_kembali' => ['required', 'date', 'after_or_equal:tgl_pinjam'],
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status === 'Dipinjam') {
                $peminjaman->buku->increment('stok');
            }
            $peminjaman->delete();
        });

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }
}
