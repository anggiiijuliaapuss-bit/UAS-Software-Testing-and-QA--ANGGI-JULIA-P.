<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $anggota = [
            ['kode_anggota' => 'AG001', 'nama' => 'Budi Santoso', 'alamat' => 'Jl. Merdeka No. 1', 'no_hp' => '081234567001', 'email' => 'budi@sekolah.sch.id', 'tgl_daftar' => '2025-07-01'],
            ['kode_anggota' => 'AG002', 'nama' => 'Siti Aminah', 'alamat' => 'Jl. Kenanga No. 5', 'no_hp' => '081234567002', 'email' => 'siti@sekolah.sch.id', 'tgl_daftar' => '2025-07-02'],
            ['kode_anggota' => 'AG003', 'nama' => 'Andi Wijaya', 'alamat' => 'Jl. Melati No. 3', 'no_hp' => '081234567003', 'email' => 'andi@sekolah.sch.id', 'tgl_daftar' => '2025-08-10'],
        ];

        foreach ($anggota as $a) {
            Anggota::updateOrCreate(['kode_anggota' => $a['kode_anggota']], $a);
        }
    }
}
