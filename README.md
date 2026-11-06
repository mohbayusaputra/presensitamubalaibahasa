<div align="center">

# 📝 Presensi Tamu — Balai Bahasa Provinsi Riau

Aplikasi buku tamu digital dan survei kepuasan layanan untuk **Balai Bahasa Provinsi Riau**.

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-38B2AC?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)](https://mysql.com)

### 🌐 [Lihat Versi Live](https://ppidbbpriau.kemendikdasmen.go.id/portal/tamu)

</div>

---

## 📖 Tentang Proyek

Aplikasi ini telah **digunakan secara resmi (live)** oleh instansi Balai Bahasa Provinsi Riau (Kemendikdasmen) pada portal PPID:

👉 https://ppidbbpriau.kemendikdasmen.go.id/portal/tamu

Tamu yang berkunjung mengisi formulir kehadiran secara digital (bisa melalui QR Code), lalu mengisi survei layanan. Petugas dapat mengelola data melalui dashboard admin.

## ✨ Fitur

- 🧾 **Formulir buku tamu** digital untuk publik
- 📊 **Survei kepuasan layanan** setelah kunjungan
- 📱 **Generator QR Code** untuk akses cepat formulir
- 🔐 **Dashboard admin** (login) dengan ringkasan data
- 🗂️ **Manajemen data tamu** (lihat, tambah, ubah, hapus)
- 💬 **Manajemen data survei**
- 👤 Manajemen profil admin

## 🛠️ Teknologi

| Bagian | Teknologi |
|---|---|
| Backend | Laravel 12, PHP 8.2+ |
| Auth | Laravel Breeze |
| Frontend | Blade, Tailwind CSS, Vite |
| Database | MySQL |

## 🚀 Instalasi

```bash
# 1. Clone repository
git clone https://github.com/<username>/presensitamubalaibahasa.git
cd presensitamubalaibahasa

# 2. Install dependensi
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate
```

Edit `.env`: atur koneksi database (`DB_*`) serta akun admin (`ADMIN_EMAIL`, `ADMIN_PASSWORD`).

```bash
# 4. Migrasi dan seeder akun admin
php artisan migrate
php artisan db:seed --class=AdminUserSeeder

# 5. Jalankan aplikasi
npm run dev
php artisan serve
```

Buka `http://localhost:8000`.

## 🗺️ Rute Utama

| URL | Keterangan |
|---|---|
| `/tamu` | Formulir buku tamu (publik) |
| `/survei` | Formulir survei (publik) |
| `/generate-qrcode` | QR Code formulir |
| `/login` | Login admin |
| `/dashboard` | Dashboard admin |

## 🔒 Keamanan

- File `.env`, database lokal, dan arsip data **tidak** disertakan di repository.
- Kredensial admin diatur melalui environment variable. Password bawaan seeder (`12345678`) hanya untuk demo lokal; **ganti dengan password yang kuat** di produksi dan set `APP_DEBUG=false`.

## 📄 Lisensi

Dibangun di atas [Laravel](https://laravel.com) (lisensi MIT). Proyek ini dikembangkan untuk keperluan Balai Bahasa Provinsi Riau.
