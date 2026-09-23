# SABLONIC STUDIO — PHP Native + MariaDB/MySQL + XAMPP

## Instalasi
1. Install XAMPP.
2. Start Apache dan MySQL.
3. Extract folder `sablonic` ke `C:\xampp\htdocs\`.
4. Buka phpMyAdmin: `http://localhost/phpmyadmin/`.
5. Import `database/sablonic.sql` (file ini juga membuat database `sablonic`).
6. Buka `http://localhost/sablonic/`.

Default koneksi: host 127.0.0.1, port 3306, user root, password kosong. Edit `config/database.php` bila konfigurasi XAMPP Anda berbeda.

## Demo login
- admin@sablonic.local / password
- production@sablonic.local / password
- finance@sablonic.local / password
- customer@sablonic.local / password

## Fitur yang sudah tersedia
Home, register/login/logout, role-based dashboard, custom order, kalkulasi harga, upload desain, customer tracking, upload bukti pembayaran, verifikasi payment, admin order/customer dashboard, production kanban, status history, dan database schema.

## Catatan keamanan
Demo password di SQL adalah untuk instalasi lokal. Ganti password akun sebelum digunakan di lingkungan nyata. Folder uploads harus dapat ditulis oleh Apache. Untuk deployment publik, tambahkan CSRF protection, rate limiting, MIME hardening, audit log, dan konfigurasi HTTPS.
