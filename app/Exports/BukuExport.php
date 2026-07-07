<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Buku::orderBy('judul')->get();
    }

    public function headings(): array
    {
        return ['Kode Buku', 'Judul', 'Penulis', 'Penerbit', 'Tahun', 'Stok'];
    }

    public function map($buku): array
    {
        return [
            $buku->kode_buku,
            $buku->judul,
            $buku->penulis,
            $buku->penerbit,
            $buku->tahun,
            $buku->stok,
        ];
    }
}
