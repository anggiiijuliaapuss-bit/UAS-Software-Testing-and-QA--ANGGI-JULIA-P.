<?php $__env->startSection('title', 'Tambah Buku'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-book-medical me-2" style="color:#7c3aed;"></i>
                Form Tambah Buku Baru
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('buku.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('buku._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                        </button>
                        <a href="<?php echo e(route('buku.index')); ?>" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/buku/create.blade.php ENDPATH**/ ?>