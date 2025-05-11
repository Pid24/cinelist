📽️ CineList – Aplikasi Manajemen Film Laravel
CineList adalah aplikasi sederhana berbasis Laravel untuk mencatat, mengelola, dan menampilkan data film. Cocok untuk pembelajaran CRUD, relasi many-to-many, upload file, filter data, dan layout responsif menggunakan Tailwind CSS.

✨ Fitur
✅ Autentikasi user (Laravel Breeze)

✅ CRUD data film (judul, sutradara, tahun, rating, sinopsis, poster)

✅ Relasi many-to-many antara film & genre

✅ Filter & search film berdasarkan genre dan rating

✅ Upload gambar poster film

✅ Dashboard statistik (total film, genre terbanyak, rata-rata rating)

✅ Dark mode & responsif

🚀 Instalasi
1. Clone project
bash
Salin
Edit
git clone https://github.com/namamu/cinelist.git
cd cinelist
2. Install dependensi
bash
Salin
Edit
composer install
npm install && npm run dev
3. Buat file .env
bash
Salin
Edit
cp .env.example .env
php artisan key:generate
Lalu sesuaikan konfigurasi database di .env:

dotenv
Salin
Edit
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cinelist
DB_USERNAME=root
DB_PASSWORD=
4. Jalankan migrasi & seeder
bash
Salin
Edit
php artisan migrate --seed
5. Jalankan server
bash
Salin
Edit
php artisan serve
👤 Login Akun Default (Seeder)
Email: test@example.com

Password: password

Kamu bisa mengganti atau menambahkan user baru di halaman Register.

📂 Struktur Penting
File/Folder	Keterangan
app/Models/Film.php	Model Film (relasi dengan Genre)
app/Models/Genre.php	Model Genre
resources/views/films	Halaman tampilan daftar, tambah, edit film
resources/views/dashboard.blade.php	Dashboard dengan statistik dan tabel film
routes/web.php	Routing utama
database/seeders/GenreSeeder.php	Seeder genre default

🛠️ Tools & Teknologi
Laravel 10+

Laravel Breeze (auth)

Tailwind CSS

Vite (JS bundler)

MySQL / SQLite

Laravel Eloquent ORM

🧪 Testing Manual
Login sebagai user

Tambahkan film

Upload poster dan pilih genre

Lihat dashboard apakah data statistik terupdate

Gunakan fitur search & filter di halaman daftar film

📄 Lisensi
Proyek ini bebas digunakan untuk keperluan pembelajaran. Tidak untuk dikomersialkan tanpa izin.
