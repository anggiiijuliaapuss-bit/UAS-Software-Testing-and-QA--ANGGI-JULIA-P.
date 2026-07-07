@extends('layouts.app')
@section('title', 'Data Anggota')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h6 class="mb-0" style="color:#6d28d9;font-weight:600;">{{ $anggota->total() }} anggota terdaftar</h6>
    </div>
    <div class="d-flex gap-2">
        <form method="GET" class="d-flex gap-2">
            <div class="input-group" style="width:280px;">
                <span class="input-group-text" style="background:#f5f3ff;border-color:#ddd6fe;color:#7c3aed;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="{{ $keyword }}" class="form-control"
                       placeholder="Cari nama, kode, email..." style="border-left:none;">
            </div>
            <button class="btn btn-outline-secondary">Cari</button>
        </form>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus me-1"></i> Tambah Anggota
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Anggota</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Tgl Daftar</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota as $a)
                    <tr>
                        <td>
                            <span style="background:#ede9fe;color:#6d28d9;padding:3px 8px;border-radius:6px;font-size:.75rem;font-weight:600;">
                                {{ $a->kode_anggota }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:32px;height:32px;background:linear-gradient(135deg,#6d28d9,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.8rem;flex-shrink:0;">
                                    {{ strtoupper(substr($a->nama,0,1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;color:#1e1b4b;font-size:.875rem;">{{ $a->nama }}</div>
                                    <div style="font-size:.75rem;color:#9ca3af;">{{ $a->alamat }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:.875rem;">{{ $a->no_hp ?: '-' }}</td>
                        <td style="font-size:.875rem;">{{ $a->email ?: '-' }}</td>
                        <td style="font-size:.875rem;">{{ optional($a->tgl_daftar)->format('d M Y') }}</td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('anggota.edit', $a) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('anggota.destroy', $a) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus anggota ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color:#9ca3af;">
                            <i class="fa-solid fa-users fa-2x mb-2 d-block" style="color:#ddd6fe;"></i>
                            Belum ada data anggota.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $anggota->links() }}</div>
</div>
@endsection
