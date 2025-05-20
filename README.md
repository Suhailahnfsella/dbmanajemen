# PWEB WEEK 12 - QUERY BUILDER & ORM

Project ini adalah aplikasi manajemen perpustakaan berbasis Laravel. Ikuti langkah-langkah berikut untuk mengatur dan menjalankan project ini.

## 🚀 Langkah Instalasi

### 1. Clone Repository
Clone repository ini ke komputer Anda:
```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```


### 2. Install Dependensi Laravel
Jalankan perintah berikut untuk menginstal semua dependensi Laravel menggunakan Composer:
```bash
composer install
```


### 3. Salin dan Atur File .env
Salin file .env.example menjadi .env
Lalu buka file .env dan sesuaikan konfigurasi database dengan database yang telah Anda buat. Misalnya:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbperpus
DB_USERNAME=root
DB_PASSWORD=
```
Pastikan Anda sudah membuat database bernama **dbperpus** di MySQL atau MariaDB.


### 4. Generate Key Aplikasi
Generate application key Laravel dengan menjalankan:
```bash
php artisan key:generate
```


### 5. Migrasi dan Seeder Database
Untuk membuat ulang seluruh tabel dan mengisi data awal (seeder), jalankan perintah:
```bash
php artisan migrate:fresh --seed
```
migrate:fresh akan menghapus semua tabel yang ada dan membuat ulang dari awal, lalu --seed akan mengisi tabel dengan data dummy dari seeder.


### 6. Jalankan Server Laravel
Setelah semuanya siap, jalankan server lokal Laravel dengan perintah:
```bash
php artisan serve
```
