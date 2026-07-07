<?php $__env->startSection('title', 'Proses Pengembalian'); ?>
<?php $__env->startSection('content'); ?>
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
                <form method="POST" action="<?php echo e(route('pengembalian.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Transaksi Peminjaman <span class="text-danger">*</span></label>
                        <select name="peminjaman_id" class="form-select" required>
                            <option value="">-- Pilih Peminjaman Aktif --</option>
                            <?php $__empty_1 = true; $__currentLoopData = $peminjamanAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($p->id); ?>" <?php if(old('peminjaman_id')==$p->id): echo 'selected'; endif; ?>>
                                    <?php echo e($p->anggota->nama); ?> — <?php echo e($p->buku->judul); ?>

                                    (batas: <?php echo e($p->tgl_kembali->format('d M Y')); ?>)
                                    <?php if($p->isTerlambat()): ?> ⚠️ TERLAMBAT <?php endif; ?>
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option disabled>Tidak ada peminjaman aktif</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali Aktual <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_kembali_aktual" class="form-control"
                               value="<?php echo e(old('tgl_kembali_aktual', now()->format('Y-m-d'))); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2"
                                  placeholder="Catatan kondisi buku, dll."><?php echo e(old('keterangan')); ?></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                        </button>
                        <a href="<?php echo e(route('pengembalian.index')); ?>" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/pengembalian/create.blade.php ENDPATH**/ ?>