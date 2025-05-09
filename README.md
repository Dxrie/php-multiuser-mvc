# PHP Multiuser Sumatif 2 TP 1

## Gambaran Umum Proyek
PHP Multiuser adalah aplikasi web yang dibangun menggunakan pola desain Model-View-Controller (MVC). Aplikasi ini mendukung berbagai role seperti:
- Admin
- Penjual
- Pembeli

Masing-masing role memiliki dashboard dan alur autentikasi yang berbeda. Struktur proyek dibuat modular dan mudah dipahami dengan pemisahan tanggung jawab antara controller, model, dan view.

## Arsitektur Proyek
Aplikasi mengikuti pola MVC:
- **Controller**: Menangani input pengguna dan logika sistem
- **Model**: Berinteraksi dengan database
- **View**: Menampilkan output ke user

Aplikasi dijalankan melalui `public/index.php` yang mengarahkan permintaan melalui class App.

## Komponen Inti

### app/core/
- **App.php**: Router utama; mem-parsing URL dan meneruskan ke controller/method yang sesuai
- **Controller.php**: Kelas dasar untuk semua controller yang akan di-inherit
- **Database.php**: Mengelola koneksi database menggunakan PDO
- **Flasher.php**: Utility pesan sederhana untuk menampilkan pesan sementara

### app/config/ & init.php
- **config.php**: Menyimpan konstanta konfigurasi (kredensial database, base URL)
- **init.php**: Memuat komponen inti dan konfigurasi - mengatur lingkungan aplikasi

## Controller
- **Auth.php**: Menangani login, registrasi, dan logout pengguna umum
- **AdminAuth.php**: Logika autentikasi khusus untuk admin
- **SellerAuth.php**: Autentikasi untuk penjual
- **Home.php**: Controller halaman utama (halaman publik)
- **AdminDashboard.php**: Menyediakan view/data untuk admin yang login
- **SellerDashboard.php**: Menyediakan view/data untuk penjual yang login

## Model
- **UserModel.php**: Mengelola interaksi data pengguna umum dengan database
- **AdminModel.php**: Menangani kueri dan logika khusus admin

## View
View disimpan di folder `app/views/` berisi template HTML dengan PHP untuk konten dinamis. Contoh:
- `login.php`, `register.php`: Halaman login dan registrasi
- `adminDashboard.php`, `sellerDashboard.php`: Dashboard untuk peran admin dan penjual

## Direktori Public
Folder `public/` adalah root web dan berisi:
- `index.php`: Controller utama yang menangani semua permintaan
- `css/`: File stylesheet Bootstrap untuk tampilan UI yang konsisten
- `.htaccess`: Untuk menulis ulang URL agar mendukung URL bersih melalui index.php

## Ringkasan
Proyek PHP Multiuser menunjukkan implementasi bersih dari:
- Arsitektur MVC
- Autentikasi berbasis peran
- Struktur modular untuk pemeliharaan dan skalabilitas mudah

Dengan pemisahan yang jelas antara:
- Controller yang terpisah dengan baik
- Model yang merangkum logika data
- View yang memastikan pengalaman antarmuka lancar menggunakan Bootstrap
