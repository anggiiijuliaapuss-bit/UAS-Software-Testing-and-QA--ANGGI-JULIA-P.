<div class="mb-3">
    <label class="form-label">Kode Anggota <span class="text-danger">*</span></label>
    <input type="text" name="kode_anggota" class="form-control @error('kode_anggota') is-invalid @enderror"
           value="{{ old('kode_anggota', $anggota->kode_anggota ?? '') }}" placeholder="Contoh: AG001" required>
    @error('kode_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $anggota->nama ?? '') }}" placeholder="Nama lengkap anggota" required>
    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" rows="2"
              placeholder="Alamat lengkap">{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control"
               value="{{ old('no_hp', $anggota->no_hp ?? '') }}" placeholder="08xxxxxxxxxx">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $anggota->email ?? '') }}" placeholder="email@contoh.com">
    </div>
</div>
<div class="mb-4">
    <label class="form-label">Tanggal Daftar</label>
    <input type="date" name="tgl_daftar" class="form-control"
           value="{{ old('tgl_daftar', optional($anggota->tgl_daftar ?? null)->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
</div>
