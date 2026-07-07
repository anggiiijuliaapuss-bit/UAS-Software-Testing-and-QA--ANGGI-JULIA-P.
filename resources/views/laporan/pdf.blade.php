<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { margin-bottom: 0; }
        .sub { color: #555; margin-top: 2px; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan {{ ucfirst($jenis) }} - SI Perpustakaan</h2>
    <div class="sub">
        Dicetak: {{ now()->format('d-m-Y H:i') }}
        @if ($jenis === 'peminjaman' && ($dari || $sampai))
            | Periode: {{ $dari ?: '...' }} s/d {{ $sampai ?: '...' }}
        @endif
    </div>

    @if ($jenis === 'buku')
        <table>
            <thead><tr><th>Kode</th><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th><th>Stok</th></tr></thead>
            <tbody>
                @foreach ($data as $b)
                    <tr><td>{{ $b->kode_buku }}</td><td>{{ $b->judul }}</td><td>{{ $b->penulis }}</td><td>{{ $b->penerbit }}</td><td>{{ $b->tahun }}</td><td>{{ $b->stok }}</td></tr>
                @endforeach
            </tbody>
        </table>
    @elseif ($jenis === 'anggota')
        <table>
            <thead><tr><th>Kode</th><th>Nama</th><th>No HP</th><th>Email</th><th>Tgl Daftar</th></tr></thead>
            <tbody>
                @foreach ($data as $a)
                    <tr><td>{{ $a->kode_anggota }}</td><td>{{ $a->nama }}</td><td>{{ $a->no_hp }}</td><td>{{ $a->email }}</td><td>{{ optional($a->tgl_daftar)->format('d-m-Y') }}</td></tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table>
            <thead><tr><th>Anggota</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Denda</th></tr></thead>
            <tbody>
                @foreach ($data as $p)
                    <tr>
                        <td>{{ $p->anggota->nama }}</td>
                        <td>{{ $p->buku->judul }}</td>
                        <td>{{ $p->tgl_pinjam->format('d-m-Y') }}</td>
                        <td>{{ $p->tgl_kembali->format('d-m-Y') }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->pengembalian ? 'Rp '.number_format($p->pengembalian->denda,0,',','.') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
