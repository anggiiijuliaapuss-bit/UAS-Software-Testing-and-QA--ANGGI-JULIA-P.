@extends('layouts.app')
@section('title', 'Edit Anggota')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-pen me-2" style="color:#7c3aed;"></i>
                Edit Data Anggota
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('anggota.update', $anggota) }}">
                    @csrf @method('PUT')
                    @include('anggota._form')
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui
                        </button>
                        <a href="{{ route('anggota.index') }}" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
