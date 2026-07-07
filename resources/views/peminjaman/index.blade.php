@extends('layouts.app')
@section('title', 'Transaksi Peminjaman')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h6 class="mb-0" style="color:#6d28d9;font-weight:600;">{{ $peminjaman->total() }} transaksi</h6>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <form method="GET" class="d-flex gap-2">
            <div class="input-group" style="width:240px;">
                <span class="input-group-text" style="background:#f5f3ff;border-color:#ddd6fe;color:#7c3aed;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="{{ $keyword }}" class="form-control"
                       placeholder="Cari anggota / buku..." style="border-left:none;">
            </div>
            <select name="status" class="form-select" style="width:140px;">
                <option value="">Semua</option>
                <option value="Dipinjam" @selected($status==='Dipinjam')>Dipinjam</option>
                <option value="Dikembalikan" @selected($status==='Dikembalikan')>Dikembalikan</option>
            </select>
            <button class="btn btn-outline-secondary">Filter</button>
        </form>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Peminjaman
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjaman as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:28px;height:28px;background:linear-gradient(135deg,#6d28d9,#8b5cf6);border-radius:7px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.75rem;flex-shrink:0;">
                                    {{ strtoupper(substr($p->anggota->nama,0,1)) }}
                                </div>
                                <span style="font-size:.875rem;font-weight:500;color:#1e1b4b;">{{ $p->anggota->nama }}</span>
                            </div>
                        </td>
                        <td style="font-size:.875rem;color:#374151;">{{ $p->buku->judul }}</td>
                        <td style="font-size:.875rem;">{{ $p->tgl_pinjam->format('d M Y') }}</td>
                        <td style="font-size:.875rem;">
                            {{ $p->tgl_kembali->format('d M Y') }}
                            @if($p->isTerlambat())
                                <br><span style="font-size:.72rem;color:#ef4444;font-weight:600;">
                                    +{{ now()->diffInDays($p->tgl_kembali) }} hari
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($p->status === 'Dikembalikan')
                                <span class="badge" style="background:#f0fdf4;color:#16a34a;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-circle-check me-1"></i>Dikembalikan
                                </span>
                            @elseif($p->isTerlambat())
                                <span class="badge" style="background:#fef2f2;color:#ef4444;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-clock me-1"></i>Terlambat
                                </span>
                            @else
                                <span class="badge" style="background:#fffbeb;color:#d97706;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-book-open me-1"></i>Dipinjam
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('peminjaman.edit', $p) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('peminjaman.destroy', $p) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color:#9ca3af;">
                            <i class="fa-solid fa-right-from-bracket fa-2x mb-2 d-block" style="color:#ddd6fe;"></i>
                            Belum ada transaksi peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $peminjaman->links() }}</div>
</div>
@endsection
