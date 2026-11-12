# AGENTS.md - Instruksi AI untuk Project Kendaraan

## 1. Gambaran Project
Aplikasi web manajemen Kendaraan Operasional Dinas.
User login dulu, baru bisa lihat list, tambah, edit, hapus kendaraan.
Dibuat untuk admin dinas, jadi harus simpel dan gampang dipakai.
Bahasa UI: Bahasa Indonesia.

## 2. Tech Stack - JANGAN DIGANTI
- Bahasa: PHP Native (tanpa framework, tanpa Laravel, tanpa Composer)
- Database: MySQL / MariaDB via phpMyAdmin
- Server: XAMPP, jalan di `http://localhost/kendaraan`
- Frontend: HTML + CSS inline di dalam file PHP. JANGAN pakai Bootstrap, Tailwind, atau framework JS.
- Editor: Notepad / Notepad++ / VS Code

## 3. Database - INI PALING PENTING
- Host: `localhost`
- User: `root`
- Password: `` (kosong)
- Database: `db_kendaraan`
- File koneksi: `koneksi.php`

### Tabel yang BENAR, JANGAN NEBAK / JANGAN BUAT TABEL BARU
1. `kendaraan_operasional` - TABEL UTAMA
   Kolom: `id` (INT, AI), `nopol` VARCHAR, `jenis` VARCHAR, `merk` VARCHAR, `tahun` VARCHAR, `warna` VARCHAR, `kondisi` VARCHAR, `status` VARCHAR, `perangkat_daerah_id` INT, `pegawai_id` INT, `pemegang` VARCHAR(100)
   CATATAN: Nama tabelnya `kendaraan_operasional`, BUKAN `kendaraan`.

2. `perangkat_daerah`
   Kolom: `id`, `nama`, `singkatan`
   Isi yang sudah ada:
   - 1 | Dinas Pendidikan | DISDIK
   - 2 | Dinas Kesehatan | DINKES
   - 3 | Dinas Pekerjaan Umum dan Penataan Ruang | PUPR
   - 4 | Dinas Bina Marga | DBM
   - 5 | Dinas Sumber Daya Air | DSDA

3. `pegawai`
   Kolom: `id`, `nama`, dll. Relasi via `kendaraan_operasional.pegawai_id`

4. `users`
   Kolom: `id`, `username`, `password`. Untuk login.

### Query Wajib
- Untuk tampilkan list + nama dinas, SELALU pakai JOIN ini:
```sql
SELECT kendaraan_operasional.*, perangkat_daerah.nama as nama_pd, perangkat_daerah.singkatan 
FROM kendaraan_operasional 
LEFT JOIN perangkat_daerah ON kendaraan_operasional.perangkat_daerah_id = perangkat_daerah.id 
ORDER BY kendaraan_operasional.id ASC