# Panduan Instalasi dan Testing Sistem Perpustakaan

## Prasyarat
Pastikan sudah terinstal di laptop/komputer Anda:
- **PHP** >= 8.0
- **Composer** (Dependency Manager PHP)
- **Node.js** dan **npm** (untuk Vite)
- **MySQL** / **MariaDB**
- **Git**

---

## Langkah 1: Clone Repository

```bash
git clone https://github.com/abdulgani89/sistem-perpustakaan.git
cd sistem-perpustakaan
```

Atau jika sudah punya folder projeknya, buka terminal di folder tersebut.

---

## Langkah 2: Install Dependencies

### Install PHP Dependencies
```bash
composer install
```

### Install Node.js Dependencies
```bash
npm install
```

---

## Langkah 3: Konfigurasi Environment

### Copy file .env
```bash
copy .env.example .env
```

### Generate Application Key
```bash
php artisan key:generate
```

### Edit file .env
Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:** Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan kredensial MySQL di laptop Anda.

---

## Langkah 4: Buat Database

Buka **phpMyAdmin** atau MySQL CLI, lalu buat database baru:

```sql
CREATE DATABASE sistem_perpustakaan;
```

Atau via command line:
```bash
mysql -u root -p -e "CREATE DATABASE sistem_perpustakaan;"
```

---

## Langkah 5: Migrasi dan Seeding Database

Jalankan migrasi untuk membuat semua tabel dan isi data awal:

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan:
- Membuat tabel: `users`, `siswa`, `buku`, `peminjaman`, `pengembalian`, `laporan`
- Mengisi data dummy:
  - **Users**: Admin dan Kepala Perpustakaan
  - **Buku**: 50 buku dengan stok dan kolom hilang
  - **Siswa**: 30 siswa
  - **Peminjaman**: Data peminjaman dari Januari - Desember

---

## Langkah 6: Compile Assets (Vite)

### Development Mode (dengan hot reload)
Buka terminal baru dan jalankan:
```bash
npm run dev
```

Biarkan terminal ini tetap berjalan selama development.

### Production Build (opsional)
Jika ingin build untuk production:
```bash
npm run build
```

---

## Langkah 7: Jalankan Server Laravel

Buka terminal baru (jika `npm run dev` masih berjalan di terminal lain):

```bash
php artisan serve
```

Server akan berjalan di: **http://127.0.0.1:8000**

---

## Langkah 8: Testing Login

### 1. Login sebagai Admin
- **URL**: http://127.0.0.1:8000/login
- **Username**: `admin`
- **Password**: `12345`

**Fitur Admin:**
- Dashboard admin
- CRUD Buku
- CRUD Siswa
- Transaksi Peminjaman dan Pengembalian
- Proses Buku Hilang (stok berkurang, kolom hilang bertambah)
- Laporan dan Aktivitas

---

### 2. Login sebagai Kepala Perpustakaan
- **URL**: http://127.0.0.1:8000/login/kepala
- **Username**: `kepala`
- **Password**: `12345`

**Fitur Kepala Perpustakaan:**
- Dashboard dengan statistik:
  - Jumlah peminjam (hari ini, bulan ini, tahun ini)
  - Jumlah buku dipinjam (hari ini, bulan ini, tahun ini)
- Chart.js visualisasi:
  - Line chart: Tren peminjam per bulan
  - Polar area chart: Status buku (Tersedia, Dipinjam, Hilang)

---

### 3. Login sebagai Siswa
- **URL**: http://127.0.0.1:8000/login/siswa
- **Username**: `SIS001` sampai `SIS030` (sesuai NIS di database)
- **Password**: `12345`

**Fitur Siswa:**
- Lihat profil
- Riwayat peminjaman
- Status pengembalian

---

## Struktur Database

### Tabel Users
- `id_user` (Primary Key)
- `username` (unique)
- `password` (hashed dengan bcrypt)
- `role` (admin, kepala, siswa)

### Tabel Buku
- `id_buku` (Primary Key)
- `judul_buku`
- `pengarang`
- `penerbit`
- `tahun_terbit`
- `stok` (jumlah total buku)
- `hilang` (jumlah buku hilang)
- `status` (tersedia, dipinjam)

### Tabel Siswa
- `nis` (Primary Key)
- `nama_siswa`
- `kelas`
- `jurusan`
- `alamat`
- `no_telp`

### Tabel Peminjaman
- `id_peminjaman` (Primary Key)
- `id_buku` (Foreign Key ke buku)
- `nis` (Foreign Key ke siswa)
- `tanggal_pinjam`
- `tanggal_kembali` (deadline)
- `status` (dipinjam, dikembalikan)

### Tabel Pengembalian
- `id_pengembalian` (Primary Key)
- `id_peminjaman` (Foreign Key)
- `tanggal_pengembalian`
- `denda`

---

## Fitur Utama

### 1. Manajemen Buku (Admin)
- Tambah, Edit, Hapus buku
- Tracking stok dan buku hilang
- Update otomatis status buku

### 2. Transaksi Pengembalian (Admin)
- **Pengembalian Normal**: Buku kembali tersedia, stok tidak berubah
- **Buku Hilang**: 
  - Kolom `hilang` pada tabel buku **+1**
  - Kolom `stok` pada tabel buku **-1**
  - Status peminjaman diupdate ke "dikembalikan"
  - Record pengembalian dibuat

### 3. Dashboard Kepala Perpustakaan
- Statistik real-time dari database
- Chart.js untuk visualisasi:
  - Tren peminjam bulanan
  - Distribusi status buku (Polar Area Chart)
- Responsive design dengan Tailwind CSS Grid

### 4. Authentication & Authorization
- Middleware: `checkAdminAuth`, `checkKepalaAuth`, `checkSiswaAuth`
- Session-based authentication
- Password hashing dengan bcrypt

---

## Troubleshooting

### Error: "SQLSTATE[HY000] [1045] Access denied"
**Solusi:** Periksa kredensial database di file `.env`

### Error: "Vite manifest not found"
**Solusi:** Jalankan `npm run dev` atau `npm run build`

### Error: "Class 'Hash' not found"
**Solusi:** Jalankan `composer install` dan pastikan Laravel terinstall lengkap

### Port 8000 sudah digunakan
**Solusi:** Gunakan port lain:
```bash
php artisan serve --port=8080
```

### Database reset ulang
Jika ingin reset database dari awal:
```bash
php artisan migrate:fresh --seed
```

---

## Command Penting

| Command | Deskripsi |
|---------|-----------|
| `composer install` | Install PHP dependencies |
| `npm install` | Install Node.js dependencies |
| `php artisan key:generate` | Generate application key |
| `php artisan migrate` | Jalankan migrasi database |
| `php artisan migrate:fresh --seed` | Reset database + seeding |
| `php artisan db:seed` | Jalankan seeder saja |
| `php artisan serve` | Jalankan development server |
| `npm run dev` | Jalankan Vite (hot reload) |
| `npm run build` | Build production assets |

---

## Testing Fitur Buku Hilang

1. Login sebagai **admin**
2. Masuk ke menu **Transaksi**
3. Klik tombol **Kembalikan** pada salah satu peminjaman aktif
4. Di modal, klik tombol **Buku Hilang** (tombol merah)
5. Konfirmasi popup
6. Cek database tabel `buku`:
   - Kolom `hilang` bertambah 1
   - Kolom `stok` berkurang 1

---

## Kontak & Support

Jika ada kendala saat instalasi atau testing, silakan hubungi:
- **Repository**: https://github.com/abdulgani89/sistem-perpustakaan
- **Branch**: `haidar-view`

---

**Happy Testing! 🚀**
