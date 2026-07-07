<div class="mb-3">
    <label class="form-label">Kode Buku <span class="text-danger">*</span></label>
    <input type="text" name="kode_buku" class="form-control @error('kode_buku') is-invalid @enderror"
           value="{{ old('kode_buku', $buku->kode_buku ?? '') }}" placeholder="Contoh: BK001" required>
    @error('kode_buku')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
           value="{{ old('judul', $buku->judul ?? '') }}" placeholder="Judul lengkap buku" required>
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control"
               value="{{ old('penulis', $buku->penulis ?? '') }}" placeholder="Nama penulis">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control"
               value="{{ old('penerbit', $buku->penerbit ?? '') }}" placeholder="Nama penerbit">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun" class="form-control"
               value="{{ old('tahun', $buku->tahun ?? '') }}" placeholder="Contoh: 2023">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stok <span class="text-danger">*</span></label>
        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
               value="{{ old('stok', $buku->stok ?? 0) }}" min="0" required>
        @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mb-4">
    <label class="form-label">Cover Buku</label>
    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
    <div class="form-text">Format: JPG, PNG, WEBP. Maksimal 2MB.</div>
    @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if (!empty($buku) && $buku->cover)
        <div class="mt-2">
            <img src="{{ $buku->cover_url }}" style="width:70px;height:90px;object-fit:cover;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.12);">
            <div class="form-text mt-1">Cover saat ini. Upload baru untuk mengganti.</div>
        </div>
    @endif
</div>
