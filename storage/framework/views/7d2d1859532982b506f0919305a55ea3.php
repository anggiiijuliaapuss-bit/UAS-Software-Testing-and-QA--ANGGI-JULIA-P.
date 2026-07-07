<?php $__env->startSection('title', 'Data Anggota'); ?>
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h6 class="mb-0" style="color:#6d28d9;font-weight:600;"><?php echo e($anggota->total()); ?> anggota terdaftar</h6>
    </div>
    <div class="d-flex gap-2">
        <form method="GET" class="d-flex gap-2">
            <div class="input-group" style="width:280px;">
                <span class="input-group-text" style="background:#f5f3ff;border-color:#ddd6fe;color:#7c3aed;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="<?php echo e($keyword); ?>" class="form-control"
                       placeholder="Cari nama, kode, email..." style="border-left:none;">
            </div>
            <button class="btn btn-outline-secondary">Cari</button>
        </form>
        <a href="<?php echo e(route('anggota.create')); ?>" class="btn btn-primary">
            <i class="fa-solid fa-user-plus me-1"></i> Tambah Anggota
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Anggota</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Tgl Daftar</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <span style="background:#ede9fe;color:#6d28d9;padding:3px 8px;border-radius:6px;font-size:.75rem;font-weight:600;">
                                <?php echo e($a->kode_anggota); ?>

                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:32px;height:32px;background:linear-gradient(135deg,#6d28d9,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.8rem;flex-shrink:0;">
                                    <?php echo e(strtoupper(substr($a->nama,0,1))); ?>

                                </div>
                                <div>
                                    <div style="font-weight:600;color:#1e1b4b;font-size:.875rem;"><?php echo e($a->nama); ?></div>
                                    <div style="font-size:.75rem;color:#9ca3af;"><?php echo e($a->alamat); ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:.875rem;"><?php echo e($a->no_hp ?: '-'); ?></td>
                        <td style="font-size:.875rem;"><?php echo e($a->email ?: '-'); ?></td>
                        <td style="font-size:.875rem;"><?php echo e(optional($a->tgl_daftar)->format('d M Y')); ?></td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="<?php echo e(route('anggota.edit', $a)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="<?php echo e(route('anggota.destroy', $a)); ?>" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus anggota ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color:#9ca3af;">
                            <i class="fa-solid fa-users fa-2x mb-2 d-block" style="color:#ddd6fe;"></i>
                            Belum ada data anggota.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"><?php echo e($anggota->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/anggota/index.blade.php ENDPATH**/ ?>