@extends('layouts.app')
@section('title', 'Proses Pengembalian')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-right-to-bracket me-2" style="color:#7c3aed;"></i>
                Form Proses Pengembalian Buku
            </div>
            <div class="card-body p-4">
                <div class="alert alert-warning mb-4" style="font-size:.84rem;">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Denda keterlambatan dihitung otomatis sebesar <strong>Rp 1.000/hari</strong>.
                </div>
                <form method="POST" action="{{ route('pengembalian.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Transaksi Peminjaman <span class="text-danger">*</span></label>
                        <select name="peminjaman_id" class="form-select" required>
                            <option value="">-- Pilih Peminjaman Aktif --</option>
                            @forelse ($peminjamanAktif as $p)
                                <option value="{{ $p->id }}" @selected(old('peminjaman_id')==$p->id)>
                                    {{ $p->anggota->nama }} — {{ $p->buku->judul }}
                                    (batas: {{ $p->tgl_kembali->format('d M Y') }})
                                    @if($p->isTerlambat()) ⚠️ TERLAMBAT @endif
                                </option>
                            @empty
                                <option disabled>Tidak ada peminjaman aktif</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali Aktual <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_kembali_aktual" class="form-control"
                               value="{{ old('tgl_kembali_aktual', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2"
                                  placeholder="Catatan kondisi buku, dll.">{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                        </button>
                        <a href="{{ route('pengembalian.index') }}" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
