@extends('layouts.app')

@section('title', 'QR Code & Barcode Buku')

@section('content')
<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body text-center">
        <h5>{{ $buku->judul }}</h5>
        <p class="text-muted">{{ $buku->kode_buku }}</p>

        <div class="mb-4">
            <h6 class="text-muted">QR Code</h6>
            {!! QrCode::size(180)->generate($buku->kode_buku) !!}
        </div>

        <div class="mb-3">
            <h6 class="text-muted">Barcode</h6>
            {!! DNS1D::getBarcodeHTML($buku->kode_buku, 'C128', 1.6, 60) !!}
        </div>

        <a href="{{ route('buku.index') }}" class="btn btn-light"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
    </div>
</div>
@endsection
