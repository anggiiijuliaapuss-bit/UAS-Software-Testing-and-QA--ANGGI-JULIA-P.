@extends('layouts.app')
@section('title', 'Data Buku')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h6 class="mb-0" style="color:#6d28d9;font-weight:600;">{{ $buku->total() }} buku ditemukan</h6>
    </div>
    <div class="d-flex gap-2">
        <form method="GET" class="d-flex gap-2">
            <div class="input-group" style="width:280px;">
                <span class="input-group-text" style="background:#f5f3ff;border-color:#ddd6fe;color:#7c3aed;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="{{ $keyword }}" class="form-control"
                       placeholder="Cari judul, penulis, kode..." style="border-left:none;">
            </div>
            <button class="btn btn-outline-secondary">Cari</button>
        </form>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Buku
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Kode</th>
                    <th>Judul & Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($buku as $b)
                    <tr>
                        <td><img src="{{ $b->cover_url }}" class="cover-thumb" alt="cover"></td>
                        <td>
                            <span style="background:#ede9fe;color:#6d28d9;padding:3px 8px;border-radius:6px;font-size:.75rem;font-weight:600;">
                                {{ $b->kode_buku }}
                            </span>
                        </td>
                        <td>
                            <div style="font-weight:600;color:#1e1b4b;font-size:.875rem;">{{ $b->judul }}</div>
                            <div style="font-size:.78rem;color:#9ca3af;">{{ $b->penulis }}</div>
                        </td>
                        <td style="font-size:.875rem;">{{ $b->penerbit }}</td>
                        <td style="font-size:.875rem;">{{ $b->tahun }}</td>
                        <td>
                            @if ($b->stok <= 0)
                                <span class="badge" style="background:#fef2f2;color:#ef4444;border-radius:8px;padding:5px 10px;">Habis</span>
                            @elseif ($b->stok <= 2)
                                <span class="badge" style="background:#fffbeb;color:#d97706;border-radius:8px;padding:5px 10px;">{{ $b->stok }}</span>
                            @else
                                <span class="badge" style="background:#f0fdf4;color:#16a34a;border-radius:8px;padding:5px 10px;">{{ $b->stok }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('buku.kode', $b) }}" class="btn btn-sm btn-outline-secondary" title="QR & Barcode">
                                    <i class="fa-solid fa-qrcode"></i>
                                </a>
                                <a href="{{ route('buku.edit', $b) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $b) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus buku ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5" style="color:#9ca3af;">
                            <i class="fa-solid fa-book fa-2x mb-2 d-block" style="color:#ddd6fe;"></i>
                            Belum ada data buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $buku->links() }}</div>
</div>
@endsection
