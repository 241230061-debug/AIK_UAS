# AIK_UAS

Repository ini berisi kode sumber untuk proyek web **AIK_UAS**. Proyek ini dikembangkan menggunakan framework Laravel, HTML, CSS, dan MySQL.

## 🚀 Fitur Utama
* **Autentikasi & Multi-role:** Sistem login dan manajemen hak akses pengguna.
* **Manajemen Data Dinamis:** Implementasi CRUD (Create, Read, Update, Delete) yang terintegrasi dengan database.
* **Arsitektur Terstruktur:** Menggunakan konsep MVC (Model-View-Controller) bawaan Laravel untuk kode yang bersih dan mudah dirawat.

## 🛠️ Prasyarat (Prerequisites)
Sebelum menjalankan proyek ini di lingkungan lokal, pastikan komputer kamu sudah terinstal:
* PHP (Minimal v8.1 atau versi yang direkomendasikan untuk Laravel yang digunakan)
* Composer (Dependency Manager untuk PHP)
* MySQL / MariaDB (Bisa menggunakan XAMPP atau Laragon)
* Node.js & NPM (Untuk pengelolaan aset frontend)

---

## 💻 Langkah-Langkah Cloning & Instalasi

Ikuti langkah-langkah berikut secara berurutan untuk menduplikasi dan menjalankan proyek ini di komputer lokal kamu:

### 1. Clone Repository
Buka terminal (Git Bash, Command Prompt, atau Terminal di VS Code), lalu jalankan perintah berikut:
```bash
git clone [https://github.com/241230061-debug/AIK_UAS.git](https://github.com/241230061-debug/AIK_UAS.git)

### Setelah proses cloning selesai, masuk ke dalam direktori proyek
cd AIK_UAS

### Instal semua package PHP yang dibutuhkan oleh framework melalui Composer:
composer install

### Instal package javascript/css dan lakukan compile aset frontend:
npm install && npm run dev

### Salin file konfigurasi bawaan .env.example menjadi .env:
cp .env.example .env

### Buka file .env tersebut menggunakan kode editor (seperti VS Code), lalu sesuaikan konfigurasi databasenya. Buat database baru di phpMyAdmin dengan nama aik_uas (atau nama lain yang kamu inginkan), lalu sesuaikan baris berikut:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aik_uas
DB_USERNAME=root
DB_PASSWORD=

### Jalankan perintah ini untuk membuat key pengaman enkripsi aplikasi Laravel kamu:
php artisan key:generate

### Jalankan perintah migrasi untuk membuat seluruh tabel yang diperlukan ke dalam database yang telah kamu siapkan:
php artisan migrate

### Aplikasi web sekarang sudah siap digunakan. Aktifkan server lokal Laravel dengan perintah:
php artisan serve
