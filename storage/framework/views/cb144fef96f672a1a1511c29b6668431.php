<?php $__env->startSection('title', 'Transaksi Peminjaman'); ?>
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h6 class="mb-0" style="color:#6d28d9;font-weight:600;"><?php echo e($peminjaman->total()); ?> transaksi</h6>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <form method="GET" class="d-flex gap-2">
            <div class="input-group" style="width:240px;">
                <span class="input-group-text" style="background:#f5f3ff;border-color:#ddd6fe;color:#7c3aed;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="<?php echo e($keyword); ?>" class="form-control"
                       placeholder="Cari anggota / buku..." style="border-left:none;">
            </div>
            <select name="status" class="form-select" style="width:140px;">
                <option value="">Semua</option>
                <option value="Dipinjam" <?php if($status==='Dipinjam'): echo 'selected'; endif; ?>>Dipinjam</option>
                <option value="Dikembalikan" <?php if($status==='Dikembalikan'): echo 'selected'; endif; ?>>Dikembalikan</option>
            </select>
            <button class="btn btn-outline-secondary">Filter</button>
        </form>
        <a href="<?php echo e(route('peminjaman.create')); ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Peminjaman
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
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:28px;height:28px;background:linear-gradient(135deg,#6d28d9,#8b5cf6);border-radius:7px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.75rem;flex-shrink:0;">
                                    <?php echo e(strtoupper(substr($p->anggota->nama,0,1))); ?>

                                </div>
                                <span style="font-size:.875rem;font-weight:500;color:#1e1b4b;"><?php echo e($p->anggota->nama); ?></span>
                            </div>
                        </td>
                        <td style="font-size:.875rem;color:#374151;"><?php echo e($p->buku->judul); ?></td>
                        <td style="font-size:.875rem;"><?php echo e($p->tgl_pinjam->format('d M Y')); ?></td>
                        <td style="font-size:.875rem;">
                            <?php echo e($p->tgl_kembali->format('d M Y')); ?>

                            <?php if($p->isTerlambat()): ?>
                                <br><span style="font-size:.72rem;color:#ef4444;font-weight:600;">
                                    +<?php echo e(now()->diffInDays($p->tgl_kembali)); ?> hari
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($p->status === 'Dikembalikan'): ?>
                                <span class="badge" style="background:#f0fdf4;color:#16a34a;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-circle-check me-1"></i>Dikembalikan
                                </span>
                            <?php elseif($p->isTerlambat()): ?>
                                <span class="badge" style="background:#fef2f2;color:#ef4444;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-clock me-1"></i>Terlambat
                                </span>
                            <?php else: ?>
                                <span class="badge" style="background:#fffbeb;color:#d97706;border-radius:8px;padding:5px 10px;">
                                    <i class="fa-solid fa-book-open me-1"></i>Dipinjam
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="<?php echo e(route('peminjaman.edit', $p)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="<?php echo e(route('peminjaman.destroy', $p)); ?>" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus transaksi ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color:#9ca3af;">
                            <i class="fa-solid fa-right-from-bracket fa-2x mb-2 d-block" style="color:#ddd6fe;"></i>
                            Belum ada transaksi peminjaman.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"><?php echo e($peminjaman->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/peminjaman/index.blade.php ENDPATH**/ ?>