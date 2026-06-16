<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo">
</p>

<h1 align="center">💰 KeuanganKu</h1>
<p align="center">
  <b>Modern Accounting & Finance Management System</b><br>
  Built with Laravel to manage Chart of Account, daily transactions, and Profit/Loss reports efficiently.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-Framework-red?style=for-the-badge&logo=laravel">
  <img src="https://img.shields.io/badge/PHP-Backend-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/Bootstrap%205-UI-purple?style=for-the-badge&logo=bootstrap">
  <img src="https://img.shields.io/badge/Vue.js-Frontend-green?style=for-the-badge&logo=vue.js">
</p>

<p align="center">
  <a href="#-fitur-utama">Fitur</a> •
  <a href="#-preview-aplikasi">Preview</a> •
  <a href="#-tech-stack">Tech Stack</a> •
  <a href="#-instalasi">Instalasi</a>
</p>

---

# 📌 Tentang Project

**KeuanganKu** adalah sistem akuntansi sederhana berbasis web yang dirancang untuk mengelola keuangan pribadi maupun perusahaan kecil. Sistem ini membantu pengguna dalam mengatur Master Kategori, Chart of Account (COA), transaksi harian, serta menghasilkan laporan **Profit & Loss** secara otomatis.

---

# ✨ Nilai Jual Project

✅ Struktur Database yang rapi & sesuai standar akuntansi  
✅ Master Kategori COA + Chart of Account  
✅ Transaksi Debit & Credit  
✅ Laporan Profit & Loss per bulan  
✅ Export Laporan ke Excel  
✅ Clean & Responsive Admin Dashboard  
✅ Mudah dikembangkan & scalable  
✅ Cocok untuk UMKM, Freelancer, hingga Perusahaan Kecil

---

# 🖼 Preview Aplikasi

## 🔹 Dashboard

_(Screenshot Dashboard akan ditambahkan)_

## 🔹 Master Kategori & Chart of Account

_(Screenshot Master Data)_

## 🔹 Halaman Transaksi

_(Screenshot Form Transaksi Debit/Credit)_

## 🔹 Laporan Profit & Loss

_(Screenshot Laporan dengan tabel bulanan + Total Income, Expense, Net Income)_

---

# 🚀 Fitur Utama

### 📂 Master Data

- Manajemen Kategori COA
- Chart of Account (Kode + Nama Akun)

### 💸 Transaksi

- Input transaksi harian (Debit & Credit)
- Deskripsi, tanggal, dan referensi COA
- Multi user support

### 📊 Laporan

- Laporan Profit & Loss per bulan
- Total Income, Total Expense, dan Net Income
- Export ke Excel

### 🔐 Security

- Sistem Login & Authentication
- Role-based access (Admin/User)

---

# 🧩 Tech Stack

| Technology     | Function                |
| -------------- | ----------------------- |
| Laravel 11     | Backend Framework       |
| PHP + 8        | Server-side Programming |
| MySQL          | Database Management     |
| Bootstrap 5    | Responsive Admin UI     |
| Blade / Vue.js | Frontend                |
| Laravel Excel  | Export ke Excel         |
| Eloquent ORM   | Database Interaction    |

---

# 🏗 System Architecture

```bash
Browser (User)
      ↓
Laravel Routes + Middleware (Auth)
      ↓
Controllers
      ↓
Models (Category, ChartOfAccount, Transaction)
      ↓
Eloquent ORM
      ↓
MySQL Database
```

# Clone repository

git clone <url-repository-anda>

# Masuk ke folder project

cd keuanganku

# Install dependency

composer install

# Copy environment file

cp .env.example .env

# Generate application key

php artisan key:generate

# Jalankan migration

php artisan migrate

# (Opsional) Seeding data master

php artisan db:seed --class=CategoryAndCoaSeeder

# Jalankan server

php artisan serve
