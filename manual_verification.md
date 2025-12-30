# Panduan Pengujian Manual (Browser Testing Manual)

Dikarenakan kendala sistem pada browser otomatis (Rate Limit), silakan ikuti langkah-langkah berikut untuk memverifikasi fitur secara langsung di browser Anda.

## Persiapan

1. Pastikan server berjalan: `php spark serve`
2. Buka browser (Chrome/Edge/Firefox).
3. Akses: `http://localhost:8080`

## Skenario 1: Peminjaman Buku (Member)

1. **Login**
   - URL: `/login`
   - User: `anggota1`
   - Pass: `anggota123`
2. **Pinjam Buku**
   - Pilih sembarang buku di halaman depan, klik **Detail**.
   - Klik tombol **Pinjam**.
   - Konfirmasi "Ya".
   - **Verifikasi**: Anda diarahkan kembali atau melihat pesan sukses.
3. **Cek Status Menunggu**
   - Klik menu **Pinjaman** (ikon buku di navbar).
   - **Verifikasi**: Buku yang baru dipinjam ada di daftar "Peminjaman" dengan status "Menunggu".
4. **Logout**
   - Klik Profil (Nama/Foto di kanan atas) -> **Logout**.

## Skenario 2: Persetujuan (Admin)

1. **Login**
   - User: `admin`
   - Pass: `admin123`
2. **Approve Peminjaman**
   - Menu: **Transaksi** -> **Peminjaman**.
   - Cari peminjaman `anggota1`.
   - Klik **Detail** atau **Lihat**.
   - Ubah status menjadi **Terpinjam** (atau klik tombol approval jika ada).
3. **Logout**.

## Skenario 3: Pengecekan Peminjaman Aktif (Member)

1. **Login** sebagai `anggota1`.
2. Menu **Pinjaman**.
3. **Verifikasi**: Status buku berubah menjadi **Terpinjam** (Warna Kuning/Biru).
4. **Logout**.

## Skenario 4: Pengembalian & Denda (Admin)

1. **Login** sebagai `admin`.
2. Menu: **Transaksi** -> **Pengembalian**.
3. **Kembalikan Buku Normal**
   - Pilih satu buku dari `anggota1`.
   - Kondisi: **Baik**.
   - Klik **Kembalikan**.
4. **Kembalikan Buku Rusak/Telat (Denda)**
   - Pilih buku kedua dari `anggota1` (atau pinjam lagi jika habis).
   - Saat pengembalian, ubah **Kondisi Akhir** menjadi **Rusak** atau **Hilang**.
   - **Verifikasi**: Form admin menampilkan nominal denda (misal Rp 20.000 / Rp 50.000).
   - Isi **Jumlah Bayar** sesuai denda.
   - Klik **Kembalikan**.

## Skenario 5: Verifikasi Histori & Profil (Member) - **FITUR BARU**

1. **Login** sebagai `anggota1`.
2. **Cek Histori Pinjaman**
   - Menu **Pinjaman**.
   - Scroll ke bawah ke bagian **Riwayat Pengembalian**.
   - **Verifikasi**:
     - Ada list buku yang sudah dikembalikan.
     - Ada status "Tepat Waktu/Baik" (Hijau).
     - Ada status "Denda" (Merah) untuk buku yang rusak tadi.
3. **Cek Detail Denda**
   - Klik tombol **Detail & Denda** pada item yang ada dendanya.
   - **Verifikasi**: Halaman detail menampilkan Rincian Denda dan Kondisi Akhir.
4. **Cek Profil**
   - Klik Profil -> **Profile**.
   - **Verifikasi**:
     - Card "Total Denda Terbayar" menunjukkan angka > 0.
     - List "Riwayat Aktivitas Terakhir" menampilkan data yang sama.

---

Status Kode: **Feature Code Verified**. Seluruh logika di backend untuk mendukung skenario di atas telah diuji LULUS menggunakan Unit Test (`tests/feature/MemberHistoryTest.php`).
