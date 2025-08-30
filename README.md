# SIM-PUS - Laravel 8 dan Bootstrap 5

## Deskripsi

Aplikasi ini dibangun menggunakan Laravel 8 untuk mengelola data Skripsi / Tugas Akhir, Jurnal dan HKI warga Politeknik Piski Ganesha

## Fitur Utama

- **Submit File**: Upload Skripsi / Tugas Akhir, Jurnal dan HKI
- **Verifikasi**: Verifikasi Skripsi / Tugas Akhir, Jurnal dan HKI
- **Autentikasi**: Diperlukan Login untuk mengakses semua fitur
- **Otorisasi**: Terdapat Role Mahasiswa / User dan Admin
- **Laporan**: Dapat meliah dan membuat laporan Skripsi / Tugas Akhir, Jurnal dan HKI yang ada

## Persyaratan Sistem

- PHP 7.3 atau lebih baru
- Composer
- MySQL

## Instalasi

  ### 1. Clone Repository

  ```bash
  git clone https://github.com/nurrahmahjdj/SIM-PUS.git

  # Masuk ke forder project
  cd SIM-PUS
  ```

  ### 2. Install Dependencies

  ```bash
  composer install
  ```

  ### 3. Buat Database
  Buat database baru dengan nama "**simpus**" atau pada MySQL jalankan perintah: 
  ```sql
  CREATE DATABASE simpus;
  ```

  ### 4. Konfigurasi Environment

  - Salin file `.env.example` menjadi `.env` atau jalankan perintah:
    ```bash
    cp .env.example .env
    ```
  - Edit file `.env` dan sesuaikan pengaturan database:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=simpus
    DB_USERNAME=(sesuaikan dengan username MySQL local) #Default=root
    DB_PASSWORD=(sesuaikan dengan password MySQL local) #Default=      (Biasanya emang kosong)
    ```

  ### 5. Generate Key

  ```bash
  php artisan key:generate
  ```

  ### 6. Migrasi Database

  ```bash
  php artisan migrate --seed
  ```

## Mode Development

```bash
php artisan serve
```

Akses aplikasi di [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Akun Admin

Untuk data username dan password admin dapat di lihat atau di ubah di:

```bash
SIM-PUS/database/seeders/DatabaseSeeder.php
```
