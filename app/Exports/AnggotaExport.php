<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Anggota::orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['Kode Anggota', 'Nama', 'Alamat', 'No HP', 'Email', 'Tanggal Daftar'];
    }

    public function map($anggota): array
    {
        return [
            $anggota->kode_anggota,
            $anggota->nama,
            $anggota->alamat,
            $anggota->no_hp,
            $anggota->email,
            optional($anggota->tgl_daftar)->format('d-m-Y'),
        ];
    }
}
