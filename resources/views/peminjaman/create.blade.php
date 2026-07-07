@extends('layouts.app')
@section('title', 'Tambah Peminjaman')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-right-from-bracket me-2" style="color:#7c3aed;"></i>
                Form Transaksi Peminjaman
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('peminjaman.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Anggota <span class="text-danger">*</span></label>
                        <select name="anggota_id" class="form-select" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($anggota as $a)
                                <option value="{{ $a->id }}" @selected(old('anggota_id')==$a->id)>
                                    {{ $a->nama }} ({{ $a->kode_anggota }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" class="form-select" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach ($buku as $b)
                                <option value="{{ $b->id }}" @selected(old('buku_id')==$b->id)>
                                    {{ $b->judul }} — stok: {{ $b->stok }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Hanya menampilkan buku dengan stok tersedia.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_pinjam" class="form-control"
                                   value="{{ old('tgl_pinjam', now()->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Batas Kembali <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kembali" class="form-control"
                                   value="{{ old('tgl_kembali', now()->addDays(7)->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                        </button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
