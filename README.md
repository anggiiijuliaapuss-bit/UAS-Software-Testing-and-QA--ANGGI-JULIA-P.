# Sistem Informasi Perpustakaan Sekolah

Project Laravel **siap jalan** untuk UAS Pemrograman Berbasis Web — Studi
Kasus: Sistem Informasi Perpustakaan. Single user (admin perpus), MySQL,
Bootstrap.

> Project ini menggunakan **Laravel 10** (kompatibel dengan **PHP 8.1+**).
> Kalau PHP kamu sudah 8.2 ke atas, project ini tetap jalan normal.

## Fitur

- Login admin (single user)
- Dashboard: jumlah buku, anggota, dipinjam, tersedia + grafik peminjaman (Chart.js) + notifikasi stok habis
- CRUD Data Buku (+ upload cover, pagination, search)
- CRUD Data Anggota (+ pagination, search)
- Transaksi Peminjaman (otomatis mengurangi stok buku)
- Pengembalian Buku (otomatis menambah stok + hitung denda telat Rp 1.000/hari)
- Laporan + Export PDF & Export Excel
- QR Code & Barcode per buku

## Cara Menjalankan

### 0. Pastikan versi PHP
```bash
php -v
```
Harus PHP **8.1.0 atau lebih tinggi**. Kalau masih di bawah itu, update PHP dulu di Laragon/XAMPP.

### 1. Install dependency PHP
```bash
composer install
```

### 2. Generate APP_KEY
File `.env` sudah disediakan (hasil copy dari `.env.example`). Tinggal generate key:
```bash
php artisan key:generate
```

### 3. Buat database MySQL
```sql
CREATE DATABASE perpustakaan;
```
Lalu sesuaikan kredensial di `.env` kalau perlu (default: `root` tanpa password, host `127.0.0.1`, port `3306`):
```
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & isi data awal
```bash
php artisan migrate --seed
php artisan storage:link
```

### 5. Jalankan server
```bash
php artisan serve
```
Buka **http://127.0.0.1:8000**

### Login Admin
```
Email    : admin@perpus.sch.id
Password : admin123
```

## Catatan

- **Tidak perlu `npm install`** — semua tampilan pakai Bootstrap 5 & Chart.js
  lewat CDN, tidak ada build asset (Vite) yang dipakai.
- **Parameter route `anggota`**: Laravel menyingularkan kata "anggota"
  menjadi "anggotum" (perilaku inflector bawaan, mirip kasus `data` →
  `datum`). Karena itu `AnggotaController` pakai parameter `$anggotum` di
  method `edit/update/destroy` — ini sudah benar dan jangan diubah.
- **Denda keterlambatan**: Rp 1.000/hari, bisa diubah di konstanta
  `DENDA_PER_HARI` pada `app/Http/Controllers/PengembalianController.php`.
- **QR Code & Barcode**: tombol ikon QR di halaman Data Buku
  (`/buku/{id}/kode`).
- Kalau `composer install` gagal karena versi package bentrok, coba
  `composer update barryvdh/laravel-dompdf maatwebsite/excel milon/barcode simplesoftwareio/simple-qrcode`
  untuk ambil versi terbaru yang kompatibel.

## Struktur Folder
```
app/
├── Models/         (Anggota, Buku, Peminjaman, Pengembalian, User)
├── Http/Controllers/
│   ├── Auth/LoginController.php
│   ├── DashboardController.php
│   ├── BukuController.php
│   ├── AnggotaController.php
│   ├── PeminjamanController.php
│   ├── PengembalianController.php
│   └── LaporanController.php
└── Exports/        (BukuExport, AnggotaExport, PeminjamanExport)

database/
├── migrations/     (users, anggota, buku, peminjaman, pengembalian)
└── seeders/        (AdminSeeder, BukuSeeder, AnggotaSeeder)

resources/views/
├── layouts/, auth/, dashboard/, buku/, anggota/, peminjaman/, pengembalian/, laporan/

routes/web.php
```

## Submit Tugas
- Push folder ini ke GitHub (sebelumnya `composer install` dulu di lokal,
  folder `vendor/` & `.env` otomatis ter-ignore oleh `.gitignore`).
- Laporan PDF dikumpulkan terpisah sesuai instruksi dosen.
