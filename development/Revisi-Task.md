# Revisi & Penyesuaian Berdasarkan Dokumen INSTRUMENT.md (Revisi-Task.md)

Dokumen ini memuat rencana dan hasil eksekusi penyesuaian sistem platform **RuangTumbuh.com** agar selaras secara menyeluruh dengan instrumen baku di [development/INSTRUMENT.md](file:///d:/Project/ruangtumbuh/development/INSTRUMENT.md).

---

## Ringkasan Penyesuaian

Berdasarkan [INSTRUMENT.md](file:///d:/Project/ruangtumbuh/development/INSTRUMENT.md), instrumen terdiri dari dua bagian terpisah dengan norma dan fungsi klinis yang berbeda:
1. **Bagian 1: Psychological Well-Being (Carol D. Ryff — 25 Butir)**:
   - Rentang skor: **25 – 125** ($M = 91,70; SD = 11,93$).
   - Titik Potong Skrining: **Skor Total $\le 80$** (Rerata butir $\le 3,20$) menandai siswa yang menjadi prioritas pencegahan selektif ($AUC = 0,81$; $NPV = 0,96$).
   - 6 Dimensi: *Penerimaan Diri*, *Relasi Positif*, *Otonomi*, *Penguasaan Lingkungan*, *Tujuan Hidup*, *Pertumbuhan Pribadi*. Dimensi *Relasi Positif* ($r = -0,83$) dan *Tujuan Hidup* ($r = -0,79$) merupakan faktor prediktor kuat ide bunuh diri jika rendah.
2. **Bagian 2: Identifikasi Diri (Ide Bunuh Diri — 12 Butir)**:
   - Rentang skor: **12 – 60** (kategori teoritis: *Sangat Rendah 12–21*, *Rendah 22–31*, *Sedang 32–40*, *Tinggi 41–50*, *Sangat Tinggi 51–60*).
   - Peringatan Krisis: **Skor $\ge 41$** atau butir inti frekuensi tinggi ($\ge 4$) membutuhkan **tindakan segera di hari yang sama, pelibatan orang tua, dan rujukan profesional**.

---

## Status Eksekusi Tugas Penyesuaian

### 1. Peningkatan Dashboard Konselor (Skrining & Peringatan Krisis)
- [x] **1.1. Deteksi Krisis pada Daftar Konseli**:
  - Menampilkan badge merah mencolok `⚠ Krisis` bila konseli terindikasi krisis (`is_crisis == true`).
  - Menampilkan badge kuning `Prioritas (&le; 80)` bila konseli masuk titik potong skrining.
  - Kartu statistik atas kini memantau 4 metrik: Konseli Terdaftar, Jadwal Sesi Aktif, Peringatan Krisis, dan Prioritas Skrining (&le; 80).
- [x] **1.2. Pemisahan Tampilan Skor Kolom Tabel**:
  - Kolom Awal dan Sesudah kini menampilkan skor terpisah yang jelas: `WB: {skor}/125` dan `Ide: {skor}/60`.
- [x] **1.3. Akses Langsung Laporan PDF Konselor**:
  - Tombol aksi diperluas menjadi `Sesi & Chat` dan `Hasil Asesmen & PDF` untuk navigasi cepat konselor.

### 2. Peningkatan Halaman Evaluasi & Tindak Lanjut Konseli (`evaluation/index.blade.php`)
- [x] **2.1. Skala Komparasi Skor yang Presisi**:
  - Grafik batang komparasi disesuaikan dengan skala baku Well-Being (125 poin) dan Ide Bunuh Diri (60 poin).
  - Terdapat banner evaluasi risiko ide bunuh diri yang memperlihatkan apakah risiko menurun (positif), stabil, atau memerlukan pemantauan lanjutan.
- [x] **2.2. Komparasi 6 Dimensi Well-Being & 4 Aspek Ide Bunuh Diri**:
  - Ditambahkan tabel komparasi detail 6 dimensi (skor awal vs skor sesudah, delta perolehan poin, dan arah penguatan layanan) ketika pre-test dan post-test telah diisi.

### 3. Peningkatan Pengalaman Pengisian Instrumen (`show.blade.php`)
- [x] **3.1. Pembatas Kontekstual Bagian 1 & Bagian 2**:
  - Menampilkan banner edukatif dan rasa aman (*psychological safety*) dinamis berbasis Alpine.js saat konseli berada di Bagian 1 (butir 1–25) maupun Bagian 2 (butir 26–37).

### 4. Peningkatan Tampilan Sesi Konselor (`session.blade.php`) & Dashboard Konseli (`dashboard.blade.php`)
- [x] **4.1. Header Manajemen Sesi Konselor**:
  - Header sesi konselor menampilkan skor terpisah (`Well-Being /125` dan `Ide /60`) serta banner peringatan darurat jika konseli terindikasi krisis.
- [x] **4.2. Kartu Langkah 4 & 7 pada Dashboard Konseli**:
  - Menyelaraskan teks judul langkah 4 dan 7 dengan skala `/125 Poin`, serta menyediakan tombol unduh PDF resmi langsung dari beranda.

### 5. Pengujian & Verifikasi Menyeluruh
- [x] **5.1. Uji Fitur & Integrasi Unit Test**:
  - Seluruh rangkaian test suite (25 tests, 73 assertions) lulus 100% tanpa error atau regresi.
- [x] **5.2. Kompilasi Aset Frontend**:
  - Menjalankan `npm run build` dengan hasil sukses (`built in 5.13s`).
