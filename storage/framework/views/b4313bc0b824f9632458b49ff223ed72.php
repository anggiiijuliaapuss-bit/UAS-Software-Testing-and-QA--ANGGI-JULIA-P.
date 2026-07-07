<?php $__env->startSection('title', 'Laporan & Ekspor'); ?>
<?php $__env->startSection('content'); ?>

<div class="card mb-4">
    <div class="card-header">
        <i class="fa-solid fa-sliders me-2" style="color:#7c3aed;"></i>
        Filter Laporan
    </div>
    <div class="card-body p-4">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Jenis Laporan</label>
                <select name="jenis" class="form-select" onchange="this.form.submit()">
                    <option value="peminjaman" <?php if($jenis==='peminjaman'): echo 'selected'; endif; ?>>Peminjaman</option>
                    <option value="buku" <?php if($jenis==='buku'): echo 'selected'; endif; ?>>Data Buku</option>
                    <option value="anggota" <?php if($jenis==='anggota'): echo 'selected'; endif; ?>>Data Anggota</option>
                </select>
            </div>
            <?php if($jenis === 'peminjaman'): ?>
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="dari" value="<?php echo e($dari); ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="sampai" value="<?php echo e($sampai); ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-secondary w-100">
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="mb-0" style="color:#6d28d9;font-weight:600;">
        <?php echo e($data->count()); ?> data ditemukan
    </h6>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('laporan.export-pdf', request()->query())); ?>"
           class="btn btn-danger btn-sm px-3">
            <i class="fa-solid fa-file-pdf me-1"></i> Export PDF
        </a>
        <a href="<?php echo e(route('laporan.export-excel', request()->query())); ?>"
           class="btn btn-success btn-sm px-3">
            <i class="fa-solid fa-file-excel me-1"></i> Export Excel
        </a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <?php if($jenis === 'buku'): ?>
            <table class="table mb-0">
                <thead><tr><th>Kode</th><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th><th>Stok</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span style="background:#ede9fe;color:#6d28d9;padding:2px 7px;border-radius:5px;font-size:.75rem;"><?php echo e($b->kode_buku); ?></span></td>
                            <td style="font-weight:600;font-size:.875rem;color:#1e1b4b;"><?php echo e($b->judul); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($b->penulis); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($b->penerbit); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($b->tahun); ?></td>
                            <td><span style="background:#f0fdf4;color:#16a34a;padding:3px 9px;border-radius:7px;font-size:.8rem;font-weight:600;"><?php echo e($b->stok); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

        <?php elseif($jenis === 'anggota'): ?>
            <table class="table mb-0">
                <thead><tr><th>Kode</th><th>Nama</th><th>No HP</th><th>Email</th><th>Tgl Daftar</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span style="background:#ede9fe;color:#6d28d9;padding:2px 7px;border-radius:5px;font-size:.75rem;"><?php echo e($a->kode_anggota); ?></span></td>
                            <td style="font-weight:600;font-size:.875rem;color:#1e1b4b;"><?php echo e($a->nama); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($a->no_hp); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($a->email); ?></td>
                            <td style="font-size:.875rem;"><?php echo e(optional($a->tgl_daftar)->format('d M Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

        <?php else: ?>
            <table class="table mb-0">
                <thead><tr><th>Anggota</th><th>Buku</th><th>Tgl Pinjam</th><th>Batas Kembali</th><th>Status</th><th>Denda</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="font-size:.875rem;font-weight:500;"><?php echo e($p->anggota->nama); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($p->buku->judul); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($p->tgl_pinjam->format('d M Y')); ?></td>
                            <td style="font-size:.875rem;"><?php echo e($p->tgl_kembali->format('d M Y')); ?></td>
                            <td>
                                <?php if($p->status === 'Dikembalikan'): ?>
                                    <span style="background:#f0fdf4;color:#16a34a;padding:3px 9px;border-radius:7px;font-size:.78rem;font-weight:600;">Dikembalikan</span>
                                <?php else: ?>
                                    <span style="background:#fffbeb;color:#d97706;padding:3px 9px;border-radius:7px;font-size:.78rem;font-weight:600;">Dipinjam</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:.875rem;">
                                <?php echo e($p->pengembalian ? 'Rp '.number_format($p->pengembalian->denda,0,',','.') : '-'); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/laporan/index.blade.php ENDPATH**/ ?>