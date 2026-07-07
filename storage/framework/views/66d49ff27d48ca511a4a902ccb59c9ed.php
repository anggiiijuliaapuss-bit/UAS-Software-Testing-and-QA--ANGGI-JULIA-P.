<?php $__env->startSection('title', 'Pengembalian Buku'); ?>
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h6 class="mb-0" style="color:#6d28d9;font-weight:600;"><?php echo e($pengembalian->total()); ?> transaksi pengembalian</h6>
    </div>
    <div class="d-flex gap-2">
        <form method="GET" class="d-flex gap-2">
            <div class="input-group" style="width:280px;">
                <span class="input-group-text" style="background:#f5f3ff;border-color:#ddd6fe;color:#7c3aed;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="<?php echo e($keyword); ?>" class="form-control"
                       placeholder="Cari anggota / buku..." style="border-left:none;">
            </div>
            <button class="btn btn-outline-secondary">Cari</button>
        </form>
        <a href="<?php echo e(route('pengembalian.create')); ?>" class="btn btn-primary">
            <i class="fa-solid fa-right-to-bracket me-1"></i> Proses Pengembalian
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Aktual</th>
                    <th>Denda</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pengembalian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:28px;height:28px;background:linear-gradient(135deg,#6d28d9,#8b5cf6);border-radius:7px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.75rem;flex-shrink:0;">
                                    <?php echo e(strtoupper(substr($p->peminjaman->anggota->nama,0,1))); ?>

                                </div>
                                <span style="font-size:.875rem;font-weight:500;color:#1e1b4b;">
                                    <?php echo e($p->peminjaman->anggota->nama); ?>

                                </span>
                            </div>
                        </td>
                        <td style="font-size:.875rem;color:#374151;"><?php echo e($p->peminjaman->buku->judul); ?></td>
                        <td style="font-size:.875rem;"><?php echo e($p->peminjaman->tgl_pinjam->format('d M Y')); ?></td>
                        <td style="font-size:.875rem;"><?php echo e($p->tgl_kembali_aktual->format('d M Y')); ?></td>
                        <td>
                            <?php if($p->denda > 0): ?>
                                <span class="badge" style="background:#fef2f2;color:#ef4444;border-radius:8px;padding:5px 10px;">
                                    Rp <?php echo e(number_format($p->denda,0,',','.')); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge" style="background:#f0fdf4;color:#16a34a;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-circle-check me-1"></i>Tepat waktu
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <form action="<?php echo e(route('pengembalian.destroy', $p)); ?>" method="POST" class="d-inline"
                                  onsubmit="return confirm('Batalkan pengembalian ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color:#9ca3af;">
                            <i class="fa-solid fa-right-to-bracket fa-2x mb-2 d-block" style="color:#ddd6fe;"></i>
                            Belum ada data pengembalian.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"><?php echo e($pengembalian->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/pengembalian/index.blade.php ENDPATH**/ ?>