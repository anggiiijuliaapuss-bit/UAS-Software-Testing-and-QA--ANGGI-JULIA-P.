<div class="mb-3">
    <label class="form-label">Kode Anggota <span class="text-danger">*</span></label>
    <input type="text" name="kode_anggota" class="form-control <?php $__errorArgs = ['kode_anggota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('kode_anggota', $anggota->kode_anggota ?? '')); ?>" placeholder="Contoh: AG001" required>
    <?php $__errorArgs = ['kode_anggota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-3">
    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" name="nama" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('nama', $anggota->nama ?? '')); ?>" placeholder="Nama lengkap anggota" required>
    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" rows="2"
              placeholder="Alamat lengkap"><?php echo e(old('alamat', $anggota->alamat ?? '')); ?></textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control"
               value="<?php echo e(old('no_hp', $anggota->no_hp ?? '')); ?>" placeholder="08xxxxxxxxxx">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
               value="<?php echo e(old('email', $anggota->email ?? '')); ?>" placeholder="email@contoh.com">
    </div>
</div>
<div class="mb-4">
    <label class="form-label">Tanggal Daftar</label>
    <input type="date" name="tgl_daftar" class="form-control"
           value="<?php echo e(old('tgl_daftar', optional($anggota->tgl_daftar ?? null)->format('Y-m-d') ?? now()->format('Y-m-d'))); ?>">
</div>
<?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/anggota/_form.blade.php ENDPATH**/ ?>