<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'alamat',
        'no_hp',
        'email',
        'tgl_daftar',
    ];

    protected $casts = [
        'tgl_daftar' => 'date',
    ];

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function peminjamanAktif(): HasMany
    {
        return $this->hasMany(Peminjaman::class)->where('status', 'Dipinjam');
    }
}
