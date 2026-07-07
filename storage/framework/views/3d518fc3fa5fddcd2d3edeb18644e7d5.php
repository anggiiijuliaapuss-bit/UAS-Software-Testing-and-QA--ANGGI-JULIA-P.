<div class="mb-3">
    <label class="form-label">Kode Buku <span class="text-danger">*</span></label>
    <input type="text" name="kode_buku" class="form-control <?php $__errorArgs = ['kode_buku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('kode_buku', $buku->kode_buku ?? '')); ?>" placeholder="Contoh: BK001" required>
    <?php $__errorArgs = ['kode_buku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-3">
    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
    <input type="text" name="judul" class="form-control <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('judul', $buku->judul ?? '')); ?>" placeholder="Judul lengkap buku" required>
    <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control"
               value="<?php echo e(old('penulis', $buku->penulis ?? '')); ?>" placeholder="Nama penulis">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control"
               value="<?php echo e(old('penerbit', $buku->penerbit ?? '')); ?>" placeholder="Nama penerbit">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun" class="form-control"
               value="<?php echo e(old('tahun', $buku->tahun ?? '')); ?>" placeholder="Contoh: 2023">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stok <span class="text-danger">*</span></label>
        <input type="number" name="stok" class="form-control <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               value="<?php echo e(old('stok', $buku->stok ?? 0)); ?>" min="0" required>
        <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="mb-4">
    <label class="form-label">Cover Buku</label>
    <input type="file" name="cover" class="form-control <?php $__errorArgs = ['cover'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
    <div class="form-text">Format: JPG, PNG, WEBP. Maksimal 2MB.</div>
    <?php $__errorArgs = ['cover'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php if(!empty($buku) && $buku->cover): ?>
        <div class="mt-2">
            <img src="<?php echo e($buku->cover_url); ?>" style="width:70px;height:90px;object-fit:cover;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.12);">
            <div class="form-text mt-1">Cover saat ini. Upload baru untuk mengganti.</div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/buku/_form.blade.php ENDPATH**/ ?>