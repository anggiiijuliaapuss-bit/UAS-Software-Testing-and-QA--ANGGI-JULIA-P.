<?php $__env->startSection('title', 'Tambah Peminjaman'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-right-from-bracket me-2" style="color:#7c3aed;"></i>
                Form Transaksi Peminjaman
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('peminjaman.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Anggota <span class="text-danger">*</span></label>
                        <select name="anggota_id" class="form-select" required>
                            <option value="">-- Pilih Anggota --</option>
                            <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($a->id); ?>" <?php if(old('anggota_id')==$a->id): echo 'selected'; endif; ?>>
                                    <?php echo e($a->nama); ?> (<?php echo e($a->kode_anggota); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" class="form-select" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b->id); ?>" <?php if(old('buku_id')==$b->id): echo 'selected'; endif; ?>>
                                    <?php echo e($b->judul); ?> — stok: <?php echo e($b->stok); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="form-text">Hanya menampilkan buku dengan stok tersedia.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_pinjam" class="form-control"
                                   value="<?php echo e(old('tgl_pinjam', now()->format('Y-m-d'))); ?>" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Batas Kembali <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kembali" class="form-control"
                                   value="<?php echo e(old('tgl_kembali', now()->addDays(7)->format('Y-m-d'))); ?>" required>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                        </button>
                        <a href="<?php echo e(route('peminjaman.index')); ?>" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/peminjaman/create.blade.php ENDPATH**/ ?>