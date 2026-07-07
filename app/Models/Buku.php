<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'cover',
    ];

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function scopeCari($query, $keyword)
    {
        if (! $keyword) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
                ->orWhere('kode_buku', 'like', "%{$keyword}%")
                ->orWhere('penulis', 'like', "%{$keyword}%")
                ->orWhere('penerbit', 'like', "%{$keyword}%");
        });
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->cover
            ? asset('storage/'.$this->cover)
            : asset('images/no-cover.png');
    }

    public function isStokHabis(): bool
    {
        return $this->stok <= 0;
    }
}
