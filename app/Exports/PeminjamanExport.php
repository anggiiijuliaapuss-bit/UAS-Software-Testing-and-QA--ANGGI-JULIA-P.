<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        private ?string $dari = null,
        private ?string $sampai = null
    ) {}

    public function collection()
    {
        return Peminjaman::with(['anggota', 'buku', 'pengembalian'])
            ->when($this->dari, fn ($q) => $q->whereDate('tgl_pinjam', '>=', $this->dari))
            ->when($this->sampai, fn ($q) => $q->whereDate('tgl_pinjam', '<=', $this->sampai))
            ->orderByDesc('tgl_pinjam')
            ->get();
    }

    public function headings(): array
    {
        return ['Anggota', 'Buku', 'Tgl Pinjam', 'Tgl Kembali (Rencana)', 'Status', 'Tgl Kembali Aktual', 'Denda'];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->anggota->nama,
            $peminjaman->buku->judul,
            $peminjaman->tgl_pinjam->format('d-m-Y'),
            $peminjaman->tgl_kembali->format('d-m-Y'),
            $peminjaman->status,
            optional(optional($peminjaman->pengembalian)->tgl_kembali_aktual)->format('d-m-Y'),
            $peminjaman->pengembalian->denda ?? '-',
        ];
    }
}
