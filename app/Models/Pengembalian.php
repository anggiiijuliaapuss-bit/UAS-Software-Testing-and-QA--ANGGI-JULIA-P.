<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tgl_kembali_aktual',
        'denda',
        'keterangan',
    ];

    protected $casts = [
        'tgl_kembali_aktual' => 'date',
        'denda' => 'decimal:2',
    ];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
