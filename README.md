## Resepin — Sneakpeek aplikasi

Impal adalah aplikasi resep sosial sederhana (Laravel + Vite) yang menampilkan feed resep, profil pengguna, fitur like dan komentar. Aplikasi ini dibuat untuk latihan dan demo; fokus pada pengalaman pengguna ringan dan interaksi sosial seputar resep.

Fitur utama (ringkas):
- Feed resep dengan gambar dan deskripsi
- Halaman profil pengguna
- Like dan komentar pada resep
- Autentikasi sederhana (Laravel built-in)

## Screenshot / sneak peek

_(Tambahkan screenshot atau GIF di sini jika tersedia)_

## Persyaratan (prasyarat)

- PHP 8.1+ (sesuaikan dengan `composer.json` jika perlu)
- Composer
- Node.js 18+ dan npm (Vite membutuhkan Node modern)
- MySQL / SQLite / Postgres (tergantung konfigurasi `.env`)

## Cara menjalankan setelah clone

1. Clone repository:

	git clone https://github.com/<username>/impal.git
	cd impal

2. Install dependency PHP:

	composer install

3. Salin file environment dan generate key Laravel:

	cp .env.example .env
	php artisan key:generate

4. Konfigurasi database pada file `.env` (atur DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD). Untuk quick start, Anda bisa pakai SQLite:

	touch database/database.sqlite
	# lalu set DB_CONNECTION=sqlite dan DB_DATABASE=absolute/path/to/database/database.sqlite di .env

5. Jalankan migrasi dan seeder (jika ada):

	php artisan migrate --seed

6. Install dependency JavaScript dan jalankan dev server Vite:

	npm install
	npm run dev

	- Vite akan menjalankan dev server pada http://localhost:5173 (default)

7. Jalankan backend Laravel:

	php artisan serve --host=127.0.0.1 --port=8000

	- Akses aplikasi di http://127.0.0.1:8000 (atau sesuai host/port yang dipilih). Jika Anda menggunakan Vite dengan Laravel, biasanya frontend asset akan disajikan oleh Vite dan backend oleh Artisan.

Menjalankan hanya dengan `php artisan` (tanpa Vite dev)

Jika Anda ingin menjalankan aplikasi hanya dengan `php artisan` (mis. tidak ingin menjalankan Vite dev server), Anda bisa membangun asset sekali lalu menjalankan server Laravel. Perlu dicatat: tanpa Vite dev server Anda tidak akan mendapat hot-reload untuk asset frontend.

1. (Opsional, sekali saja) Build asset produksi:

	npm install
	npm run build

	- Perintah ini akan menghasilkan file statis yang akan dilayani oleh Laravel.

2. Jalankan backend Laravel:

	php artisan serve --host=127.0.0.1 --port=8000

3. Akses aplikasi di http://127.0.0.1:8000

Catatan:
- Jika Anda benar-benar tidak ingin menggunakan Node/npm, pastikan repository sudah menyertakan build statis (folder `public/build`); jika tidak ada, Anda perlu menjalankan `npm run build` sekali untuk membuatnya.
- Untuk development yang nyaman (hot reload, HMR), tetap disarankan menjalankan `npm run dev` di terminal terpisah.

## Build untuk production

1. Compile assets produk:

	npm run build

2. Pastikan konfigurasi `.env` production sudah benar (APP_ENV=production, cache config, dll.).

## Catatan & Troubleshooting singkat

- Jika `npm run dev` error: jalankan `npm install`, pastikan versi Node kompatibel (disarankan Node 18+). Jika masih error, bersihkan cache npm dan hapus `node_modules` lalu `npm install` lagi.
- Jika migrasi gagal karena DB, periksa pengaturan di `.env` dan pastikan database tersedia.
- Untuk masalah Laravel environment, cek `php -v` dan `composer install` berhasil tanpa error.

Jika mau, saya bisa tambahkan screenshot, instruksi untuk Docker/Sail, atau perintah cepat untuk macOS (Valet) — beri tahu preferensi Anda.

---

Jika sudah cocok, saya tandai README ini selesai.

