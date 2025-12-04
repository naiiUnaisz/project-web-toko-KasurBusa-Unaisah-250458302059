# 🛏️ Toko Kasur Busa Cileungsi — Website E-Commerce

Aplikasi website e-commerce untuk penjualan kasur busa yang dibangun menggunakan **Laravel Livewire**, **Laravel Breeze**, dan **Tailwind CSS**. Website ini memiliki fitur lengkap seperti pencarian produk, filter berlapis, keranjang belanja, checkout dengan unggah bukti bayar, hingga ulasan dan wishlist, sehingga memberikan pengalaman belanja yang lebih modern dan nyaman.

---

## ✨ Fitur Utama

### 🛍️ Manajemen & Display Produk
- **Pencarian Produk (Search)**
- **Filter Produk Berlapis (Multi-layer Filtering)**  
  Filter berdasarkan kategori, ukuran, ketebalan, harga, dan material.
- **Sorting Produk**  
  Urutkan berdasarkan harga termurah/termahal, terbaru, atau paling populer.
- **Rekomendasi Produk Serupa**
- **Wishlist / Simpan Favorit**

### 🛒 Sistem Pembelian & Checkout
- **Keranjang Belanja (Shopping Cart)**
- **Checkout dengan Unggah Bukti Pembayaran**
- **Riwayat Pesanan**
- **Pelacakan Status Pesanan (Pending, Diproses, Dikirim, Selesai)**

### ⭐ Interaksi Pengguna
- **Sistem Ulasan & Rating Produk**
- **Halaman Detail Produk lengkap dengan galeri gambar**
- **Fitur Kontak & Chat WhatsApp langsung**

### 🔒 Sistem User
- Login, Register, Logout  
  (Menggunakan **Laravel Breeze**)
- Dashboard pengguna (riwayat pesanan, ulasan, wishlist)

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 10+**
- **Laravel Livewire** — Komponen interaktif tanpa JavaScript manual
- **Laravel Breeze** — Autentikasi ringan & siap pakai
- **Tailwind CSS** — Styling cepat dan modern
- **MySQL** — Database utama
- **Blade Template**
- **Flowbite / Plugin tambahan (opsional)**

---

## 🚀 Cara Instalasi

Pastikan sudah menginstall:
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL

### 1. Clone Repository
```bash
git clone <url-repo-kamu> 
```

2. Masuk ke Folder Project
```bash
cd toko-kasur-busa
```

4. Install Dependency Backend
```bash
composer install
```

6. Install Dependency Frontend
```bash
npm install
```

8. Salin File Environment
```bash
cp .env.example .env
```

10. Generate Application Key
```bash
php artisan key:generate
```

12. Atur Database di file .env

Contoh:

DB_DATABASE=kasur_busa

DB_USERNAME=root

DB_PASSWORD=

8. Migration & Seeder (opsional)
```bash
php artisan migrate --seed
```

▶️ Cara Menjalankan Project

1. Jalankan Local Server
```bash
php artisan serve
```

3. Jalankan Vite untuk Tailwind
```bash
npm run dev
```

Akses website di:
http://localhost:8000

📦 Struktur Fitur Utama (Singkat)

- /katalog → katalog produk + search + filter + sorting

- /Cart-Shopping → keranjang belanja

- /Cart-Payment → upload bukti bayar

- /Cart-Wishlist → produk favorit

- /detail-product/{product} → detail + rating + review + rekomendasi

