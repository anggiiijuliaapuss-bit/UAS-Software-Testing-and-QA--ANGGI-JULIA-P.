<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $buku = [
            ['kode_buku' => 'BK001', 'judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'tahun' => 2005, 'stok' => 5],
            ['kode_buku' => 'BK002', 'judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'penerbit' => 'Hasta Mitra', 'tahun' => 1980, 'stok' => 3],
            ['kode_buku' => 'BK003', 'judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'penerbit' => 'Gramedia', 'tahun' => 2009, 'stok' => 0],
            ['kode_buku' => 'BK004', 'judul' => 'Belajar Laravel 11', 'penulis' => 'Tim Penulis', 'penerbit' => 'Penerbit IT', 'tahun' => 2025, 'stok' => 7],
            ['kode_buku' => 'BK005', 'judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'penerbit' => 'Kompas', 'tahun' => 2018, 'stok' => 4],
        ];

        foreach ($buku as $b) {
            Buku::updateOrCreate(['kode_buku' => $b['kode_buku']], $b);
        }
    }
}
