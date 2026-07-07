<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali' => 'date',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class);
    }

    public function isTerlambat(): bool
    {
        return $this->status === 'Dipinjam' && $this->tgl_kembali->isPast();
    }
}
