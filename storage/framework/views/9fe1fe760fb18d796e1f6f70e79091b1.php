<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - SI Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f3f0ff;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(160deg, #4c1d95 0%, #6d28d9 60%, #7c3aed 100%);
            box-shadow: 4px 0 20px rgba(109,40,217,0.18);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            padding: 0;
        }

        .sidebar-brand {
            padding: 24px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            margin-bottom: 8px;
        }

        .sidebar-brand .brand-title {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .sidebar-brand .brand-sub {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.6);
            font-weight: 400;
        }

        .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 10px;
        }

        .sidebar nav { flex: 1; padding: 0 12px; }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.4);
            padding: 12px 10px 4px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.75);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 9px 12px;
            border-radius: 10px;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.18s ease;
        }

        .sidebar .nav-link .nav-icon {
            width: 30px; height: 30px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.08);
            font-size: 0.82rem;
            transition: all 0.18s;
            flex-shrink: 0;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.12);
        }

        .sidebar .nav-link:hover .nav-icon {
            background: rgba(255,255,255,0.2);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.18);
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }

        .sidebar .nav-link.active .nav-icon {
            background: #fff;
            color: #6d28d9;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.12);
            margin-top: auto;
        }

        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 10px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            margin-bottom: 8px;
        }

        .sidebar-user .user-avatar {
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem;
            color: #fff;
        }

        .sidebar-user .user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
        }

        .sidebar-user .user-role {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
        }

        .btn-logout {
            width: 100%;
            background: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            font-size: 0.82rem;
            padding: 7px;
            transition: all 0.18s;
        }

        .btn-logout:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 0 #ede9fe, 0 2px 12px rgba(109,40,217,0.06);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar .page-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e1b4b;
            margin: 0;
        }

        .topbar .breadcrumb {
            font-size: 0.78rem;
            color: #8b5cf6;
            margin: 0;
        }

        .topbar-right {
            display: flex; align-items: center; gap: 10px;
        }

        .topbar-badge {
            background: #ede9fe;
            color: #6d28d9;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .content-area { padding: 24px 28px; flex: 1; }

        /* ===== CARDS ===== */
        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(109,40,217,0.07), 0 1px 3px rgba(0,0,0,0.04);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #f0ebff;
            border-radius: 14px 14px 0 0 !important;
            padding: 14px 18px;
            font-weight: 600;
            color: #1e1b4b;
            font-size: 0.92rem;
        }

        .card-footer {
            background: #faf8ff;
            border-top: 1px solid #f0ebff;
            border-radius: 0 0 14px 14px !important;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            border-radius: 14px;
            padding: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -30px; right: 20px;
            width: 60px; height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .stat-card .stat-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 14px;
        }

        .stat-card .stat-label {
            font-size: 0.78rem;
            font-weight: 500;
            opacity: 0.85;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.1;
        }

        /* ===== TABLE ===== */
        .table thead th {
            background: #faf8ff;
            color: #6d28d9;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #ede9fe;
            padding: 12px 16px;
        }

        .table tbody td {
            font-size: 0.875rem;
            color: #374151;
            padding: 12px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f5f3ff;
        }

        .table tbody tr:hover td { background: #faf8ff; }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 8px 16px;
            box-shadow: 0 2px 8px rgba(109,40,217,0.25);
            transition: all 0.18s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9, #5b21b6);
            box-shadow: 0 4px 14px rgba(109,40,217,0.35);
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-color: #d8b4fe;
            color: #6d28d9;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.18s;
        }

        .btn-outline-secondary:hover {
            background: #ede9fe;
            color: #5b21b6;
            border-color: #a78bfa;
        }

        .btn-outline-primary {
            border-color: #a78bfa;
            color: #6d28d9;
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .btn-outline-primary:hover {
            background: #6d28d9;
            border-color: #6d28d9;
        }

        .btn-outline-danger {
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .btn-outline-dark {
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .btn-light {
            background: #f5f3ff;
            border-color: #ede9fe;
            color: #6d28d9;
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .btn-danger { border-radius: 8px; font-size: 0.875rem; }
        .btn-success { border-radius: 8px; font-size: 0.875rem; }

        /* ===== FORMS ===== */
        .form-control, .form-select {
            border-color: #ddd6fe;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.18s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124,58,237,0.12);
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #4c1d95;
        }

        /* ===== BADGES ===== */
        .badge { border-radius: 6px; font-weight: 500; }

        /* ===== ALERTS ===== */
        .alert {
            border: none;
            border-radius: 12px;
            font-size: 0.875rem;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        /* ===== PAGINATION ===== */
        .pagination .page-link {
            border-color: #ede9fe;
            color: #6d28d9;
            border-radius: 8px !important;
            margin: 0 2px;
            font-size: 0.82rem;
        }

        .pagination .page-item.active .page-link {
            background: #6d28d9;
            border-color: #6d28d9;
        }

        .cover-thumb {
            width: 45px; height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.12);
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-book-bookmark" style="color:#fff;font-size:1rem;"></i>
        </div>
        <div class="brand-title">SI Perpustakaan</div>
        <div class="brand-sub">Sistem Informasi Sekolah</div>
    </div>

    <nav>
        <div class="nav-section-label">Menu Utama</div>
        <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
            <span class="nav-icon"><i class="fa-solid fa-gauge"></i></span>
            Dashboard
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('buku.*') ? 'active' : ''); ?>" href="<?php echo e(route('buku.index')); ?>">
            <span class="nav-icon"><i class="fa-solid fa-book"></i></span>
            Data Buku
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('anggota.*') ? 'active' : ''); ?>" href="<?php echo e(route('anggota.index')); ?>">
            <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
            Data Anggota
        </a>

        <div class="nav-section-label mt-1">Transaksi</div>
        <a class="nav-link <?php echo e(request()->routeIs('peminjaman.*') ? 'active' : ''); ?>" href="<?php echo e(route('peminjaman.index')); ?>">
            <span class="nav-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
            Peminjaman
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('pengembalian.*') ? 'active' : ''); ?>" href="<?php echo e(route('pengembalian.index')); ?>">
            <span class="nav-icon"><i class="fa-solid fa-right-to-bracket"></i></span>
            Pengembalian
        </a>

        <div class="nav-section-label mt-1">Laporan</div>
        <a class="nav-link <?php echo e(request()->routeIs('laporan.*') ? 'active' : ''); ?>" href="<?php echo e(route('laporan.index')); ?>">
            <span class="nav-icon"><i class="fa-solid fa-chart-column"></i></span>
            Laporan & Ekspor
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <div class="user-name"><?php echo e(auth()->user()->name ?? 'Admin'); ?></div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="btn-logout" type="submit">
                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Keluar
            </button>
        </form>
    </div>
</div>

<div class="main-wrapper">
    <div class="topbar">
        <div>
            <h5 class="page-title"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h5>
        </div>
        <div class="topbar-right">
            <span class="topbar-badge">
                <i class="fa-regular fa-clock me-1"></i>
                <?php echo e(now()->locale('id')->translatedFormat('d M Y')); ?>

            </span>
        </div>
    </div>

    <div class="content-area">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-1"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fa-solid fa-triangle-exclamation me-1"></i>
                <ul class="mb-0 mt-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/layouts/app.blade.php ENDPATH**/ ?>