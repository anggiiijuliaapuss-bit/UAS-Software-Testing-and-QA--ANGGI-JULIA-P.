@extends('layouts.app')
@section('title', 'Edit Buku')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-pen me-2" style="color:#7c3aed;"></i>
                Edit Data Buku
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('buku.update', $buku) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('buku._form')
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui
                        </button>
                        <a href="{{ route('buku.index') }}" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
