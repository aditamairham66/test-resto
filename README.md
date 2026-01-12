### INIT PROJECT
- PHP 8.2
- MYSQL 5.7

## Instalasi

### 1. Clone Repository
Clone repository ini ke direktori lokal kamu menggunakan perintah berikut:

```bash
git clone [link-project]
cd [name-project]
```

### 2. Install Dependencies
Jalankan perintah berikut untuk menginstall semua dependencies PHP:

```bash
composer install
```

### 3. Konfigurasi Environment
Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database dan lainnya sesuai kebutuhan kamu:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Migrasi Database
Jalankan migrasi untuk membuat tabel-tabel di database:

```bash
php artisan migrate
php artisan db:seed
```

### 5. Menjalankan Aplikasi
Jalankan server pengembangan Laravel dengan perintah berikut:

```bash
php artisan serve
```

Sekarang kamu bisa mengakses aplikasi di `http://localhost:8000`.

## Strukur Direktori
Beberapa direktori penting dalam proyek ini adalah:

- `resources/views`: Direktori untuk file blade Laravel.
- `routes`: Direktori untuk file rute Laravel.
- `database/migrations`: Direktori untuk file migrasi database.

## Kontribusi
Jika kamu ingin berkontribusi ke proyek ini, silakan buat pull request atau buka isu di GitHub.

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).
