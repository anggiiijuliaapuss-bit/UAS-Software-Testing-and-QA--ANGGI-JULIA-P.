@extends('layouts.app')
@section('title', 'Edit Peminjaman')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-pen me-2" style="color:#7c3aed;"></i>
                Edit Transaksi Peminjaman
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Anggota <span class="text-danger">*</span></label>
                        <select name="anggota_id" class="form-select" required>
                            @foreach ($anggota as $a)
                                <option value="{{ $a->id }}" @selected($peminjaman->anggota_id==$a->id)>
                                    {{ $a->nama }} ({{ $a->kode_anggota }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" class="form-select" required>
                            @foreach ($buku as $b)
                                <option value="{{ $b->id }}" @selected($peminjaman->buku_id==$b->id)>
                                    {{ $b->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_pinjam" class="form-control"
                                   value="{{ $peminjaman->tgl_pinjam->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Batas Kembali <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kembali" class="form-control"
                                   value="{{ $peminjaman->tgl_kembali->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui
                        </button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
