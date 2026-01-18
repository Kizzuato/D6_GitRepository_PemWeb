# FORTE - Sistem Monitoring IoT & Laporan Insiden

<p align="center">
  <strong>Tugas Akhir Pemrograman Website - Kelompok D6</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.10-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql" alt="MySQL">
</p>

## 📋 Deskripsi Proyek

**FORTE** adalah sistem monitoring berbasis IoT yang dirancang untuk memudahkan pengguna dalam memantau berbagai sensor secara akurat dan real-time. Setiap sensor mencatat data penting seperti daya, posisi, akselerasi, dan anomali yang terdeteksi, sehingga pengguna dapat langsung mengambil keputusan berdasarkan informasi terbaru.

Proyek ini adalah tugas akhir dari mata kuliah **Pemrograman Website** untuk **Kelompok D6**.

## ✨ Fitur Utama

### Manajemen Pengguna
- Sistem autentikasi dan otorisasi dengan berbagai peran (role-based access control)
- Manajemen profil pengguna
- Sistem skor kredit untuk pengguna
- Logging aktivitas pengguna

### Monitoring Sensor
- Integrasi dengan sensor IoT untuk mengumpulkan data daya real-time
- Pencatatan log sensor
- Dashboard pemantauan sensor

### Laporan & Analisis
- Pembuatan laporan konsumsi energi
- Klasifikasi laporan berdasarkan kategori
- Validasi laporan oleh admin
- Analisis data historis

### Sistem Transaksi
- Pencatatan transaksi energi
- Riwayat skor kredit pengguna
- Integrasi MQTT untuk komunikasi real-time

### Manajemen Peran & Izin
- Sistem izin berbasis role menggunakan Spatie
- Kontrol akses granular untuk fitur aplikasi
- Policies untuk otorisasi resource

## 🛠️ Teknologi & Tools

### Backend
- **Framework**: Laravel 10.10
- **Database**: MySQL
- **ORM**: Eloquent
- **Authentication**: Laravel Sanctum
- **Permission System**: Spatie Laravel Permission

### Real-time & IoT
- **MQTT Client**: PHP MQTT Client v2.3
- **Event Broadcasting**: Laravel Broadcasting
- **WebSocket Support**: Laravel default

### Testing & Development
- **Testing Framework**: PHPUnit
- **Faker**: FakerPHP untuk data dummy
- **Debugging**: Laravel Ignition
- **Code Quality**: Laravel Pint

### Frontend Integration
- **Vite**: Module bundler modern
- **Package Manager**: NPM & Composer

## 📁 Struktur Direktori

```
forte-laravel/
├── app/
│   ├── Console/          # Console commands
│   ├── Events/           # Event classes (UserActionEvent)
│   ├── Exceptions/       # Custom exceptions
│   ├── Helpers/          # Helper functions
│   ├── Http/
│   │   ├── Controllers/  # Request handlers
│   │   ├── Middleware/   # HTTP middleware
│   │   └── Requests/     # Form request validations
│   ├── Models/           # Eloquent models
│   │   ├── User.php
│   │   ├── Sensor.php
│   │   ├── SensorLog.php
│   │   ├── Report.php
│   │   ├── Classification.php
│   │   ├── Transaction.php
│   │   ├── CreditScoreLog.php
│   │   ├── Power.php
│   │   ├── Role.php
│   │   └── Validation.php
│   ├── Policies/         # Authorization policies
│   ├── Repositories/     # Repository pattern implementation
│   ├── Services/         # Business logic services
│   ├── Traits/           # Reusable traits
│   └── Providers/        # Service providers
├── config/               # Configuration files
├── database/
│   ├── migrations/       # Database migrations
│   ├── seeders/          # Database seeders
│   └── factories/        # Model factories
├── routes/               # API & Web routes
├── resources/            # Views & assets
├── storage/              # Application storage
├── tests/                # Test files
└── vendor/               # Composer dependencies
```

## 🗄️ Model Data

### Core Models
- **User**: Pengguna sistem dengan credit score
- **Sensor**: Perangkat sensor untuk pengukuran daya
- **SensorLog**: Catatan pembacaan sensor
- **Report**: Laporan analisis energi
- **Transaction**: Transaksi energi pengguna
- **CreditScoreLog**: Riwayat perubahan skor kredit
- **Classification**: Klasifikasi tipe laporan
- **Validation**: Proses validasi laporan
- **Power**: Data daya terukur
- **Role**: Peran pengguna dalam sistem

## 🚀 Instalasi & Setup

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Node.js & NPM
- Composer

### Langkah Instalasi

1. **Clone Repository**
```bash
cd forte-laravel
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=forte
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan Migrations**
```bash
php artisan migrate
php artisan db:seed
```

6. **Generate Assets**
```bash
npm run build
```

7. **Jalankan Server**
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

## 📚 API Documentation

Sistem ini menyediakan REST API endpoints yang dilindungi dengan Laravel Sanctum. Semua endpoint API memerlukan autentikasi token.

### Authentication
- Login untuk mendapatkan token
- Token digunakan dalam header: `Authorization: Bearer {token}`

### Main Endpoints
- `GET /api/user` - Ambil data pengguna terautentikasi
- Report Management, Sensor Monitoring, Transaction History

## 🧪 Testing

Jalankan test suite:
```bash
php artisan test
```

Jalankan dengan coverage:
```bash
php artisan test --coverage
```

## 🔒 Keamanan

- Password hashing dengan bcrypt
- CSRF protection pada form
- Authorization policies untuk resource access
- Input validation pada semua form requests
- SQL injection prevention melalui Eloquent ORM

## 👥 Anggota Kelompok D6

- **Project**: FORTE - Sistem Monitoring IoT & Laporan Insiden
- **Kelompok**: D6
- **Mata Kuliah**: Tugas Akhir Pemrograman Website
- **Anggota 1**: 152024127 Dzakiyya Puteri Aulia
- **Anggota 2**: 152024198 Zahratu Thohiroh Sunanto
- **Anggota 3**: 152024160 Satria Radja Anugerah

## 📄 Lisensi

MIT License - Proyek akademis untuk keperluan pembelajaran.

## 📧 Kontak & Support

Untuk pertanyaan atau dukungan terkait proyek, hubungi anggota kelompok D6.

---

**Dikembangkan dengan Laravel 10 | Tahun Akademik 2025-2026**
