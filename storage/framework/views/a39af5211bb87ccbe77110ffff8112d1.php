<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            background: #f3f0ff;
        }

        /* ======= LEFT PANEL ======= */
        .left-panel {
            flex: 1;
            background: linear-gradient(155deg, #3b0764 0%, #5b21b6 40%, #7c3aed 80%, #8b5cf6 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 48px;
            position: relative;
            overflow: hidden;
        }

        /* dekorasi lingkaran latar */
        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -60px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        /* header sekolah */
        .school-header {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .school-logo {
            width: 52px; height: 52px;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            color: #fff;
            flex-shrink: 0;
        }

        .school-name-top {
            line-height: 1.25;
        }

        .school-name-top .label {
            font-size: .7rem;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .school-name-top .name {
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
        }

        /* konten tengah */
        .left-center {
            position: relative;
            z-index: 1;
        }

        .system-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: .75rem;
            color: rgba(255,255,255,0.85);
            margin-bottom: 20px;
        }

        .left-center h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .left-center h1 span {
            color: #c4b5fd;
        }

        .left-center .school-full {
            font-size: 1.05rem;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            margin-bottom: 8px;
        }

        .left-center .school-address {
            font-size: .82rem;
            color: rgba(255,255,255,0.55);
            margin-bottom: 32px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .feature-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 9px 12px;
            font-size: .78rem;
            color: rgba(255,255,255,0.85);
        }

        .feature-chip i {
            color: #c4b5fd;
            font-size: .85rem;
            flex-shrink: 0;
        }

        /* footer kiri */
        .left-footer {
            position: relative;
            z-index: 1;
            font-size: .72rem;
            color: rgba(255,255,255,0.35);
        }

        /* ======= RIGHT PANEL (FORM) ======= */
        .right-panel {
            width: 420px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 44px;
            box-shadow: -8px 0 40px rgba(109,40,217,0.08);
        }

        .form-top-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ede9fe;
            color: #6d28d9;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: .72rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .right-panel h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e1b4b;
            margin-bottom: 4px;
        }

        .right-panel .sub {
            font-size: .84rem;
            color: #9ca3af;
            margin-bottom: 28px;
        }

        .form-label {
            font-size: .8rem;
            font-weight: 600;
            color: #4c1d95;
            margin-bottom: 5px;
        }

        .input-group-text {
            background: #f5f3ff;
            border-color: #ddd6fe;
            color: #7c3aed;
            border-right: none;
        }

        .form-control {
            border-color: #ddd6fe;
            border-left: none;
            border-radius: 0 10px 10px 0 !important;
            font-size: .875rem;
            padding: 10px 14px;
            transition: all 0.18s;
        }

        .input-group .input-group-text {
            border-radius: 10px 0 0 10px !important;
        }

        .form-control:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124,58,237,0.1);
        }

        .form-control:focus + .input-group-text,
        .input-group:focus-within .input-group-text {
            border-color: #7c3aed;
        }

        .btn-login {
            background: linear-gradient(135deg, #6d28d9, #7c3aed);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            font-size: .92rem;
            color: #fff;
            width: 100%;
            margin-top: 4px;
            box-shadow: 0 4px 16px rgba(109,40,217,0.28);
            transition: all 0.18s;
            letter-spacing: .2px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #5b21b6, #6d28d9);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(109,40,217,0.38);
            color: #fff;
        }

        .divider {
            border: none;
            border-top: 1px solid #f3f4f6;
            margin: 24px 0;
        }

        .default-info {
            background: #faf8ff;
            border: 1px solid #ede9fe;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: .78rem;
            color: #6d28d9;
        }

        .default-info .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .default-info .info-row:last-child { margin-bottom: 0; }

        .default-info .info-label { color: #9ca3af; }
        .default-info .info-val { font-weight: 600; }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: none;
            border-left: 3px solid #ef4444;
            border-radius: 8px;
            font-size: .83rem;
            padding: 10px 14px;
        }

        .form-check-input:checked {
            background-color: #6d28d9;
            border-color: #6d28d9;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 28px; }
        }
    </style>
</head>
<body>

    
    <div class="left-panel">
        <div class="school-header">
            <div class="school-logo">
                <i class="fa-solid fa-school"></i>
            </div>
            <div class="school-name-top">
                <div class="label">Portal Admin</div>
                <div class="name">SMA Negeri 4 Magelang</div>
            </div>
        </div>

        <div class="left-center">
            <div class="system-badge">
                <i class="fa-solid fa-book-bookmark"></i>
                Sistem Informasi Perpustakaan
            </div>
            <h1>Perpustakaan<br><span>Digital Sekolah</span></h1>
            <div class="school-full">SMA Negeri 4 Magelang</div>
            <div class="school-address">
                <i class="fa-solid fa-location-dot me-1"></i>
                Jl. Panembahan Senopati No.4, Magelang, Jawa Tengah
            </div>

            <div class="feature-grid">
                <div class="feature-chip">
                    <i class="fa-solid fa-book"></i> Kelola data buku
                </div>
                <div class="feature-chip">
                    <i class="fa-solid fa-users"></i> Data anggota
                </div>
                <div class="feature-chip">
                    <i class="fa-solid fa-right-from-bracket"></i> Peminjaman
                </div>
                <div class="feature-chip">
                    <i class="fa-solid fa-right-to-bracket"></i> Pengembalian
                </div>
                <div class="feature-chip">
                    <i class="fa-solid fa-file-pdf"></i> Ekspor PDF/Excel
                </div>
                <div class="feature-chip">
                    <i class="fa-solid fa-qrcode"></i> QR Code buku
                </div>
            </div>
        </div>

        <div class="left-footer">
            &copy; <?php echo e(date('Y')); ?> SMA Negeri 4 Magelang &mdash; Sistem Informasi Perpustakaan
        </div>
    </div>

    
    <div class="right-panel">
        <div class="form-top-badge">
            <i class="fa-solid fa-lock"></i> Area Admin
        </div>

        <h2>Masuk ke Sistem</h2>
        <p class="sub">Login sebagai admin perpustakaan untuk mengelola data</p>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control"
                           value="<?php echo e(old('email')); ?>" placeholder="admin@perpus.sch.id" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="font-size:.82rem;color:#6b7280;">
                    Ingat saya di perangkat ini
                </label>
            </div>
            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk ke Sistem
            </button>
        </form>

        <hr class="divider">

 
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\sistem-informasi-perpus\resources\views/auth/login.blade.php ENDPATH**/ ?>