@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body">
        <div class="d-flex gap-3 mb-3">
            <img src="{{ $buku->cover_url }}" style="width:100px;height:130px;object-fit:cover;border-radius:6px;">
            <div>
                <h5>{{ $buku->judul }}</h5>
                <p class="text-muted mb-1">{{ $buku->kode_buku }}</p>
                <p class="mb-1"><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                <p class="mb-1"><strong>Penerbit:</strong> {{ $buku->penerbit }} ({{ $buku->tahun }})</p>
                <p class="mb-1"><strong>Stok:</strong> {{ $buku->stok }}</p>
            </div>
        </div>
        <a href="{{ route('buku.kode', $buku) }}" class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-qrcode me-1"></i>QR & Barcode</a>
        <a href="{{ route('buku.edit', $buku) }}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen me-1"></i>Edit</a>
        <a href="{{ route('buku.index') }}" class="btn btn-light btn-sm">Kembali</a>
    </div>
</div>
@endsection
