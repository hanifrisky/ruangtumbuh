# Pemetaan Struktur Buku Panduan Administrator

Berdasarkan hasil pemindaian terhadap dokumen rujukan:
📁 `D:\Project\ruangtumbuh\docs\sumber\Panduan_Admin_Teman_Sebayaku.docx`

Dokumen ini memetakan anatomi penulisan, gaya bahasa, hierarki bab, dan pola tutorial per fitur yang akan diterapkan secara presisi pada buku panduan **Administrator Ruang Tumbuh**.

> **Catatan Sesuai Arahan Pengguna:**
> Halaman cover depan pada dokumen rujukan untuk sementara **dilewati (skip)** terlebih dahulu. Panduan dimulai langsung dari Bab 1.

---

## 1. Analisis Pola & Gaya Penulisan Dokumen Sumber (Template)

Dokumen sumber memiliki pola penyusunan yang sangat terstruktur, lugas, dan instruksional (*action-oriented*). Setiap fitur tidak hanya dijelaskan secara teoritis, melainkan dibedah fungsi operasionalnya (tambah, edit, hapus, atur urutan) dengan langkah kerja nyata.

### A. Hierarki Heading & Tipografi
- **Heading 2**: Digunakan sebagai penanda Bab Utama dengan penomoran berurutan (contoh: `1. Login Admin`, `2. Dashboard Admin`, dst).
- **Heading 3**: Digunakan untuk memecah sub-fungsi di dalam fitur (contoh: `Fitur Utama`, `Cara Penggunaan`, `Fungsi Tombol`, `Informasi Tabel`, `Tips Pengisian`, `Contoh Penggunaan`).
- **Heading 4**: Digunakan untuk pengelompokan formulir multi-bagian (contoh pada Konselor: `1. Akun Login`, `2. Profil Konseling`).
- **Normal & List Paragraph**: Penjelasan ringkas 1-2 kalimat pengantar, diikuti langkah kerja bernomor (*numbered list*) atau butir (*bullet list*).

### B. Pola Standar Setiap Fitur (Anatomi Bab)
Setiap bab fitur di dalam template memuat elemen-elemen berikut secara konsisten:
1. **Pengantar Fitur**: 1-2 kalimat tentang tujuan halaman dan batasan fungsinya.
2. **Fitur Utama / Daftar Aksi**: Poin-poin apa saja yang dapat dilakukan di halaman tersebut (CRUD: Create, Read, Update, Delete).
3. **Tutorial Langkah Kerja (Step-by-Step)**:
   - Langkah Menambahkan Data Baru (dari klik tombol tambah, input form, hingga simpan).
   - Langkah Mengubah/Mengedit Data (dari tombol edit, ubah isian, hingga simpan perubahan).
   - Langkah Menghapus Data (konfirmasi hapus).
   - Langkah Pengaturan Khusus (seperti atur urutan soal / panah posisi jika ada).
4. **Informasi Kolom Formulir & Tabel**: Penjelasan arti setiap kolom input dan data tabel menggunakan format `Nama Kolom → Penjelasan`.
5. **Keterangan Fungsi Tombol**: Penjelasan fungsi tombol aksi (misal: Batal, Simpan, Edit, Hapus, Kembali ke Daftar).
6. **Contoh Pengisian / Skala**: Ilustrasi nyata nilai data yang diinput agar pengguna tidak bingung.
7. **Tips Pengisian**: Kotak panduan praktis (best practice) pengisian data.
8. **Tangkapan Layar (Screenshot)**: Diletakkan tepat di bawah langkah kerja atau bagian form yang sedang dibahas.

---

## 2. Pemetaan Penyesuaian dari Template ke Platform Ruang Tumbuh

Terdapat beberapa perbedaan kontekstual penting antara aplikasi contoh (*Teman Sebayaku*) dengan platform yang sedang dikembangkan (**Ruang Tumbuh**):

| Komponen | Template Rujukan (Teman Sebayaku) | Penerapan di Ruang Tumbuh |
| :--- | :--- | :--- |
| **Nama Aplikasi** | Teman Sebayaku | **Ruang Tumbuh** (`https://ruangtumbuh.appocket.id`) |
| **Kredensial Login** | `admin@temansebayaku.com` / `password` | **`admin@ruangtumbuh.com`** / `password` |
| **Instrumen Psikologis** | Instrumen kuesioner umum | **Dua Bagian Baku Terstandar**:<br>1. *Psychological Well-Being* Carol D. Ryff (25 butir, skala 25–125, 6 Dimensi, titik potong $\le 80$)<br>2. *Identifikasi Diri / Deteksi Ide Bunuh Diri* (12 butir, skala 12–60, 4 Aspek, ambang krisis $\ge 41$) |
| **Metode Self-Help** | Pendekatan WDEP umum | **Solution-Focused Brief Counseling (SFBC)** berbasis kearifan budaya Nusantara (kisah filosofis & pertanyaan reflektif: Scaling, Miracle, Exception, Coping Questions) |
| **Penyusunan Konten Materi** | Modul Lesson Builder 6 Section | **Lesson Builder Modular**: Teks, Gambar, Video, YouTube, PDF, dan Tautan Eksternal |

---

## 3. Rencana Struktur Rinci Dokumen Panduan Admin Ruang Tumbuh

Berikut adalah rancangan daftar isi dan rincian sub-bagian yang akan dituangkan ke dalam dokumen Word baru:

### Bab 1: Login Admin
- Pengantar akses Administrator.
- Langkah demi langkah masuk ke sistem:
  1. Akses URL: `https://ruangtumbuh.appocket.id/login`
  2. Input kredensial: Email (`admin@ruangtumbuh.com`) dan Kata Sandi (`password`).
  3. Klik tombol `Masuk ke Dashboard / Log in`.
- Langkah keluar dari sistem (Logout).
- *Tangkapan Layar: Halaman Login Ruang Tumbuh.*

### Bab 2: Dashboard Admin
- Pengantar beranda pemantauan sistem.
- Metrik statistik ringkas (Total User, Konselor, Soal Instrumen, Modul Budaya).
- Navigasi bilah sisi (*sidebar*) dan fungsinya.
- *Tangkapan Layar: Antarmuka Dashboard Administrator.*

### Bab 3: Manajemen Instrumen Asesmen (Overview)
- Penjelasan instrumen psikologis baku Ruang Tumbuh (Well-Being 25 butir & Deteksi Risiko 12 butir).
- Fitur CRUD instrumen: Grup Pilihan Jawaban, Bank Soal, dan Interpretasi Skor.

### Bab 4: Mengelola Grup Pilihan (Option Groups)
- Pengantar fungsi skala penilaian pilihan ganda.
- **Tutorial Menambahkan Grup Pilihan Baru**:
  - Buka menu `Grup Pilihan` di bilah sisi.
  - Klik tombol `+ Buat Group Pilihan Baru`.
  - Isi `Nama Grup Pilihan` (contoh: *Skala Likert Kesejahteraan 5 Opsi*).
  - Tambahkan opsi jawaban: klik `+ Tambah Opsi`, isi teks pilihan dan bobot nilai skor.
  - Menghapus opsi jawaban yang tidak dibutuhkan.
  - Klik tombol `Simpan Grup`.
- **Tutorial Mengedit Grup Pilihan**: Mengubah nama atau bobot skor.
- **Tutorial Menghapus Grup Pilihan**.
- **Contoh Skala Pilihan Jawaban & Tabel Bobot Skor**.
- *Tangkapan Layar: Daftar Grup Pilihan & Formulir Tambah/Edit Opsi.*

### Bab 5: Mengelola Soal Instrumen (Questions)
- Pengantar pengelolaan bank soal kuesioner asesmen.
- **Fitur Utama**: Melihat daftar, menyaring kategori, menambah, mengedit, menghapus, dan mengatur urutan soal.
- **Tutorial Menambahkan Soal Baru**:
  - Klik tombol `+ Tambah Soal Baru`.
  - Isi kolom `Pernyataan / Pertanyaan`.
  - Pilih `Kategori Soal` (*well_being* atau *suicide_ideation*).
  - Pilih `Dimensi / Aspek Kepribadian` (Penerimaan Diri, Relasi Positif, Otonomi, dsb.).
  - Pilih `Grup Opsi Jawaban` yang sesuai.
  - Klik tombol `Simpan Pernyataan`.
- **Tutorial Mengedit Soal**: Memperbarui redaksi kalimat atau pilihan grup.
- **Tutorial Menghapus Soal**.
- **Tutorial Mengatur Urutan Soal (Reordering)**: Menggunakan ikon panah atau drag-and-drop lalu klik `Simpan Urutan`.
- **Informasi Kolom Tabel Soal**: No Urut, Teks Pertanyaan, Kategori, Dimensi, Grup Pilihan, Aksi.
- *Tangkapan Layar: Tabel Daftar Soal & Formulir Input Soal.*

### Bab 6: Manajemen Interpretasi Skor (Interpretations)
- Pengantar pengelompokan skor hasil asesmen siswa.
- **Tutorial Menambahkan Interpretasi Baru**:
  - Klik tombol `+ Tambah Interpretasi Baru`.
  - Isi `Skor Minimal` (batas bawah).
  - Isi `Skor Maksimal` (batas atas).
  - Isi `Keterangan & Rekomendasi Hasil` (deskripsi klinis dan tindak lanjut).
  - Klik tombol `Simpan Interpretasi`.
- **Tutorial Mengedit & Menghapus Interpretasi**.
- **Fungsi Tombol**: Edit, Hapus, Batal, Simpan.
- **Contoh Rentang Norma Baku**:
  - Norma Well-Being (Carol D. Ryff 25–125 poin, titik potong $\le 80$).
  - Norma Deteksi Ide Bunuh Diri (12–60 poin, ambang krisis $\ge 41$).
- **Tips Pengisian**: Rentang tidak boleh tumpang tindih (*overlap*), rekomendasi operasional jelas.
- *Tangkapan Layar: Daftar Interpretasi & Formulir Tambah/Edit.*

### Bab 7: Manajemen Konselor (Counselors)
- Pengantar pengelolaan akun dan profil konselor pembimbing.
- **Tutorial Menambahkan Konselor Baru**:
  - Klik tombol `+ Tambah Konselor`.
  - **Bagian 1: Akun Login**: Nama Lengkap & Gelar, Username, Alamat Email, Kata Sandi, dan Konfirmasi Kata Sandi.
  - **Bagian 2: Profil Konseling**: Nomor Urut Tampilan (*Order Number*), Nomor WhatsApp, Motto Hidup/Konseling, Unggah Foto Profil (JPG/PNG max 2MB), Deskripsi Diri & Keahlian, dan Penanda Tim Pengembang.
  - Klik tombol `Daftarkan Konselor`.
- **Tutorial Mengedit Profil Konselor**.
- **Tutorial Menghapus Konselor**.
- **Fungsi Tombol & Tips Pengisian**: Pastikan WhatsApp aktif dan foto berlatar profesional.
- *Tangkapan Layar: Daftar Konselor & Formulir Registrasi Konselor.*

### Bab 8: Manajemen Self-Help Kearifan Budaya (Overview & Alur)
- Pengantar modul refleksi mandiri berbasis kearifan budaya lokal Nusantara dengan pendekatan SFBC (*Solution-Focused Brief Counseling*).
- Struktur hierarki data: Suku Budaya $\rightarrow$ Materi Cerita Filosofis $\rightarrow$ Pertanyaan Reflektif Mandiri.
- Alur pengelolaan dari penambahan suku hingga materi siap dipakai oleh siswa.

### Bab 9: Mengelola Suku Budaya Nusantara (Tribes)
- Pengantar data suku bangsa dan falsafah hidup.
- **Tutorial Menambahkan Suku Baru**:
  - Klik tombol `+ Tambah Suku`.
  - Isi `Nama Suku Budaya` (contoh: *Jawa*, *Sunda*, *Madura*, *Bugis-Makassar*, *Bali*).
  - Klik `Simpan Suku`.
- **Tutorial Mengedit Nama Suku**.
- **Tutorial Menghapus Suku**.
- *Tangkapan Layar: Kartu Suku Budaya & Formulir Tambah Suku.*

### Bab 10: Mengelola Materi Self-Help Budaya (Materials)
- Pengantar materi narasi inspiratif kearifan leluhur.
- **Tutorial Menambahkan Materi Baru**:
  - Klik tombol `Kelola Materi & Soal` pada kartu suku.
  - Klik tombol `+ Tambah Materi`.
  - Isi `Judul Materi / Kisah` (contoh: *Filosofi Urip Iku Urup*).
  - Isi `Nilai-Nilai Budaya` (contoh: *Ketabahan, Keselarasan, Gotong Royong*).
  - Isi `Deskripsi & Makna Filosofis` cerita.
  - Klik tombol `Simpan Materi`.
- **Tutorial Mengedit Materi**.
- **Tutorial Menghapus Materi**.
- *Tangkapan Layar: Daftar Materi & Formulir Input Materi.*

### Bab 11: Mengelola Pertanyaan Refleksi Self-Help SFBC
- Pengantar butir pertanyaan pemantik daya lenting (resiliensi) siswa.
- **Tutorial Menambahkan Pertanyaan Reflektif**:
  - Klik tombol `+ Tambah Pertanyaan` pada editor materi.
  - Pilih kategori pertanyaan SFBC:
    - *Scaling Question* (Pengukuran Skala Keyakinan Diri)
    - *Miracle Question* (Eksplorasi Harapan Masa Depan)
    - *Exception Question* (Menemukan Momen Keberhasilan di Masa Lalu)
    - *Coping Question* (Menggali Daya Tahan & Kekuatan Diri)
  - Isi teks pertanyaan pemandu refleksi.
  - Klik tombol `Simpan Materi`.
- **Tutorial Mengedit & Menghapus Pertanyaan Refleksi**.
- *Tangkapan Layar: Editor Pertanyaan Refleksi.*

### Bab 12: Manajemen Pengguna (Users)
- Pengantar pengelolaan akun seluruh pengguna sistem (Admin, Konselor, Konseli/Siswa).
- **Fitur Utama**: Pencarian nama/email, filter role, reset tampilan, edit data pengguna, ganti password, dan hapus akun.
- **Tutorial Mencari & Menyaring Pengguna**:
  - Masukkan kata kunci pada kotak pencarian.
  - Pilih dropdown Role (Admin, Konselor, Konseli) lalu klik tombol Cari.
  - Klik tombol `Reset` untuk mengembalikan ke seluruh data.
- **Tutorial Mengubah Data Pengguna (Edit User)**:
  - Klik tombol `Edit` pada baris pengguna.
  - Ubah nama, username, email, atau ubah kata sandi baru.
  - Klik `Simpan Perubahan`.
- **Tutorial Menghapus Pengguna (Delete User)**.
- *Tangkapan Layar: Tabel Pengguna dengan Filter Role & Formulir Edit User.*

### Bab 13: Manajemen Materi Pembelajaran (Lessons)
- Pengantar modul psikoedukasi dan artikel kesehatan mental umum bagi siswa.
- **Tutorial Menambahkan Lesson Baru**:
  - Klik tombol `+ Buat Lesson`.
  - Masukkan `Judul Lesson` dan `Tag / Kategori` pada panel kiri.
  - Memilih dan menambahkan Section Konten modular:
    - *Teks / Artikel*: editor tulisan edukatif.
    - *Gambar*: unggah berkas infografis/ilustrasi.
    - *Video*: unggah berkas video materi.
    - *YouTube*: tautan video edukasi.
    - *Dokumen PDF*: sematkan berkas panduan PDF.
    - *Tautan Layar / Link*: tautan sumber rujukan.
  - Mengatur urutan section konten dengan panah atas/bawah atau seret (*drag-and-drop*).
  - Klik tombol `Simpan Lesson`.
- **Tutorial Mengedit & Menghapus Lesson**.
- *Tangkapan Layar: Daftar Lessons & Builder Section Konten.*

### Bab 14: Alur Penggunaan Sistem oleh Konseli (Siswa)
- Panduan ringkas bagi Administrator mengenai alur perjalanan siswa di sistem:
  1. Registrasi Akun Siswa (`/register`)
  2. Masuk Akun (`/login`)
  3. Pengerjaan Asesmen Awal Pre-Test Well-Being & Ide Bunuh Diri (`/konseli/wellbeing`)
  4. Pemilihan Konselor Pendamping (`/konseli/counselor`)
  5. Sesi Konseling Online: Live Chat & Tatap Muka Virtual Google Meet (`/konseli/counseling`)
  6. Pengisian Refleksi Pasca Sesi Konseling (`/konseli/reflection`)
  7. Pemilihan Suku Budaya & Pengerjaan Modul Self-Help SFBC (`/konseli/tribe`)
  8. Pengerjaan Asesmen Akhir Post-Test (`/konseli/wellbeing/post_test`)
  9. Evaluasi Komparatif & Tindak Lanjut Perkembangan Diri (`/konseli/evaluation`)
