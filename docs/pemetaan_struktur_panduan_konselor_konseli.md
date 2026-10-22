# Pemetaan Struktur Buku Panduan Konselor & Konseli

Dokumen ini memetakan rancangan struktur bab, gaya penulisan, anatomi tutorial per fitur, dan peletakan tangkapan layar (*screenshot*) untuk buku panduan:
1. 📄 **Buku Panduan Pengguna: Konselor**
2. 📄 **Buku Panduan Pengguna: Konseli (Siswa)**

Sesuai pola standar pada dokumen template rujukan [`Panduan_Admin_Teman_Sebayaku.docx`](file:///d:/Project/ruangtumbuh/docs/sumber/Panduan_Admin_Teman_Sebayaku.docx):
- Halaman cover depan **dilewati (skip)** terlebih dahulu.
- Setiap bab menggunakan hierarki `Heading 2` dengan penomoran berurutan.
- Setiap fitur dijabarkan fungsi-fungsinya dengan langkah kerja nyata (*step-by-step*), tabel penjelasan kolom/parameter, fungsi tombol, dan tips pengisian.
- Tangkapan layar (*screenshot*) asli antarmuka Ruang Tumbuh disematkan langsung di bawah instruksi terkait.

---

## BAGIAN 1: PEMETAAN BUKU PANDUAN KONSELOR

### Bab 1: Login Konselor
- Penjelasan akses masuk konselor untuk mendampingi siswa binaan.
- Langkah demi langkah login: URL `https://ruangtumbuh.appocket.id/login`, input email (`aris.saputra.fip@um.ac.id`), password (`password`), klik Masuk.
- Langkah logout akun.
- *Screenshot: `konselor_01_dashboard.png` (form login).*

### Bab 2: Dashboard Konselor
- Penjelasan fungsi beranda kerja konselor.
- **4 Kartu Statistik Cerdas**:
  1. *Konseli Terdaftar*: Total siswa yang memilih konselor bersangkutan.
  2. *Jadwal Sesi Aktif*: Pertemuan konseling virtual yang sedang berjalan atau akan datang.
  3. *Peringatan Krisis (Merah)*: Siswa dengan indikasi risiko krisis akut (Skor Ide $\ge 41$).
  4. *Prioritas Skrining (Kuning)*: Siswa dengan Well-Being rendah (Skor $\le 80$).
- **Informasi Tabel Siswa Binaan**:
  - Kolom Identitas: Nama Siswa, Kelas, Asal Sekolah.
  - Kolom Skor Ganda: `WB: {skor}/125` dan `Ide: {skor}/60`.
  - Badge Visual: `⚠ Krisis` (merah menyala) & `Prioritas (≤ 80)` (kuning).
  - Tombol Aksi: `Sesi & Chat`, `Hasil Asesmen & PDF`, `Jawaban Self-Help`.
- *Screenshot: `konselor_01_dashboard.png`.*

### Bab 3: Manajemen Sesi Konseling & Live Chat
- Pengantar komunikasi konseling privat dan terenkripsi.
- **Tutorial Live Chat**:
  - Membuka ruang konseling melalui tombol `Sesi & Chat`.
  - Mengetik dan mengirimkan pesan bimbingan konseling pada kotak obrolan.
  - Membaca balasan chat siswa secara langsung (real-time).
  - Memeriksa waktu pengiriman pesan dan penanda status terbaca (*read receipt*).
- *Screenshot: `konselor_02_session_chat.png`.*

### Bab 4: Penjadwalan Konseling Virtual & Link Video Meet
- Pengantar penyelenggaraan telekonseling tatap muka daring.
- **Tutorial Menetapkan Jadwal Pertemuan**:
  - Mengisi tanggal dan jam rencana pertemuan virtual pada formulir jadwal.
  - Memilih platform konferensi (Google Meet / Zoom Meeting).
  - Menyematkan tautan (link) ruang pertemuan virtual.
  - Mengubah status sesi (*scheduled* $\rightarrow$ *completed*).
  - Klik tombol `Simpan Jadwal`.
- *Screenshot: `konselor_03_session_schedule_eval.png`.*

### Bab 5: Evaluasi Sesi Konseling & Lembar Refleksi Siswa
- Pengantar pencatatan rekam kemajuan klinis konseli.
- **Tutorial Mengisi Catatan Evaluasi & Rekomendasi**:
  - Mengisi formulir evaluasi sesi mengenai kemajuan siswa dan observasi perilaku.
  - Menuliskan rekomendasi rencana tindak lanjut (*action plan*).
  - Klik `Simpan Evaluasi`.
- **Tutorial Meninjau Refleksi Pasca Konseling Siswa**:
  - Membaca jawaban 3 pertanyaan reflektif siswa.
  - Memberikan catatan umpan balik (*counselor feedback*) yang menguatkan motivasi siswa.
- *Screenshot: `konselor_03_session_schedule_eval.png`.*

### Bab 6: Analisis Klinis Asesmen Psikologis
- Pengantar interpretasi instrumen terstandar Ruang Tumbuh.
- **Tutorial Membuka Lembar Asesmen**: Klik tombol `Hasil Asesmen & PDF`.
- **Ringkasan Skor & Norma Empiris**:
  - Skala Well-Being Carol D. Ryff (25 butir, norma $M=91.70, SD=11.93$).
  - Titik Potong Skrining: Skor $\le 80$ menandai prioritas pencegahan selektif ($AUC=0.81, NPV=0.96$).
- **Analisis 6 Dimensi Well-Being**: Penerimaan Diri, Relasi Positif, Otonomi, Penguasaan Lingkungan, Tujuan Hidup, Pertumbuhan Pribadi.
- **Analisis 4 Aspek Ide Bunuh Diri**: Keputusasaan, Perasaan Menjadi Beban, Pikiran Kematian, Ketidakberdayaan.
- *Screenshot: `konselor_04_wellbeing_summary.png` & `konselor_05_wellbeing_dimensions.png`.*

### Bab 7: Protokol Tindakan Klinis & Peringatan Krisis
- Prosedur Operasional Baku (SOP) saat mendeteksi indikator `⚠ Krisis`.
- Langkah penanganan di hari yang sama:
  1. Melakukan kontak darurat segera melalui chat/telepon.
  2. Melibatkan orang tua / wali kelas secara bijak dan proporsional.
  3. Menyusun Rencana Keselamatan (*Safety Planning*).
  4. Melakukan rujukan (*referral*) ke psikolog klinis / psikiater / rumah sakit.
- *Screenshot: `konselor_06_wellbeing_protocol.png`.*

### Bab 8: Pengelolaan Laporan PDF & Reset Asesmen
- **Tutorial Mengunduh Laporan PDF Resmi**: Klik tombol `Unduh PDF` untuk menyimpan dokumen arsip rekam bimbingan konseling.
- **Tutorial Mereset Asesmen**: Prosedur mereset instrumen jika siswa memerlukan asesmen ulang berkala atau terjadi kekeliruan teknis saat pengisian.
- *Screenshot: `konselor_04_wellbeing_summary.png`.*

### Bab 9: Pemantauan Jawaban Modul Self-Help Budaya
- Pengantar pemantauan intervensi kearifan lokal berbasis SFBC.
- **Tutorial Meninjau Jawaban Budaya Siswa**: Klik tombol `Jawaban Self-Help`.
- Membaca respon siswa pada 4 jenis pertanyaan reflektif: *Scaling Question*, *Miracle Question*, *Exception Question*, dan *Coping Question*.
- Memanfaatkan wawasan budaya siswa sebagai materi pendukung sesi konseling.
- *Screenshot: `konselor_07_selfhelp_monitor.png`.*

### Bab 10: Etika Layanan Konseling Daring & Kerahasiaan Data
- Penjelasan kode etik bimbingan dan konseling dalam setting daring.
- Prinsip kerahasiaan (*confidentiality*), batas keterbukaan (*exceptions to confidentiality* dalam kondisi bahaya jiwa), dan etika telekonseling profesional.

---

## BAGIAN 2: PEMETAAN BUKU PANDUAN KONSELI (SISWA)

### Bab 1: Pendaftaran Akun Siswa Baru (Registrasi)
- Langkah membuat akun mandiri: Akses URL `https://ruangtumbuh.appocket.id/register`.
- Mengisi formulir pendaftaran: Nama Lengkap, Username, Email, Jenis Kelamin, Kelas, Asal Sekolah, Password, Konfirmasi Password.
- Klik tombol `Daftar Sekarang`.
- *Screenshot: `konseli_01_register.png`.*

### Bab 2: Masuk ke Akun (Login)
- Langkah masuk akun: Akses URL `https://ruangtumbuh.appocket.id/login`.
- Masukkan username/email dan kata sandi.
- Klik tombol `Masuk ke Dashboard / Log in`.
- Langkah keluar akun (Logout).
- *Screenshot: `konseli_02_login.png`.*

### Bab 3: Dashboard Siswa & Panduan 7 Langkah Bertumbuh
- Tinjauan beranda siswa Ruang Tumbuh.
- Memahami kartu tahapan bimbingan:
  - Langkah 1–3: Registrasi, Login, dan Asesmen Awal.
  - Langkah 4–5: Memilih Konselor dan Mulai Konseling Online.
  - Langkah 6–7: Refleksi Sesi, Modul Budaya Nusantara, dan Asesmen Akhir.
- Kartu status asesmen awal dan tombol unduh laporan PDF resmi.
- *Screenshot: `konseli_03_dashboard.png`.*

### Bab 4: Mengerjakan Asesmen Resiliensi Diri (Well-Being)
- Masuk ke menu Asesmen (`/konseli/wellbeing`).
- Membaca petunjuk pengerjaan dan jaminan kerahasiaan.
- **Langkah Pengerjaan 2 Bagian**:
  - *Bagian 1*: Pernyataan Kesejahteraan Psikologis (25 butir).
  - *Bagian 2*: Pernyataan Pengenalan Diri & Pikiran Mendalam (12 butir).
- Menyimpan sementara jawaban atau menyelesaikan asesmen.
- Melihat hasil capaian skor dan mengunduh berkas laporan PDF resmi.
- *Screenshot: `konseli_04_wellbeing_index.png`.*

### Bab 5: Memilih Konselor Pendamping
- Masuk ke menu Pilih Konselor (`/konseli/counselor`).
- Membaca kartu profil para konselor: nama & gelar, pasfoto, motto hidup, riwayat keahlian, nomor WhatsApp.
- Memilih konselor yang paling dipercaya dan klik tombol `Pilih Konselor Ini`.
- *Screenshot: `konseli_05_counselor_select.png`.*

### Bab 6: Memulai Sesi Konseling Online (Live Chat)
- Masuk ke menu Konseling Online (`/konseli/counseling`).
- Menuliskan curhatan atau beban pikiran pada kotak chat.
- Mengirim pesan dan membaca balasan empatik dari konselor secara privat.
- Tips bercerita secara jujur dan terbuka tanpa takut dihakimi.
- *Screenshot: `konseli_06_counseling_room.png`.*

### Bab 7: Menghadiri Tatap Muka Virtual (Google Meet / Zoom)
- Meninjau banner jadwal pertemuan daring yang telah disepakati bersama konselor.
- Memeriksa tanggal, jam temu, dan platform video conference.
- Mengklik tombol `Masuk ke Video Meet` saat jam konsultasi tiba untuk terhubung langsung.
- *Screenshot: `konseli_06_counseling_room.png`.*

### Bab 8: Mengisi Lembar Refleksi Pasca Konseling
- Membuka menu Refleksi Sesi (`/konseli/reflection`) setelah sesi konseling selesai.
- Mengisi 3 pertanyaan reflektif:
  1. *Hal positif apa yang kamu dapatkan hari ini?*
  2. *Perubahan pikiran atau perasaan apa yang kamu rasakan?*
  3. *Langkah konkret apa yang akan kamu lakukan?*
- Membaca umpan balik penguatan dari konselor.
- *Screenshot: `konseli_07_reflection.png`.*

### Bab 9: Memantau Grafik Evaluasi Perkembangan Diri
- Membuka menu Evaluasi & Tindak Lanjut (`/konseli/evaluation`).
- Membaca grafik batang komparasi perolehan skor awal (pre-test) vs skor akhir (post-test).
- Membaca banner evaluasi penurunan risiko pikiran negatif.
- Memeriksa tabel perkembangan 6 dimensi kesejahteraan diri beserta delta perolehan poin.
- Membaca catatan saran perbaikan diri dari konselor.
- *Screenshot: `konseli_08_evaluation_charts.png` & `konseli_09_evaluation_details.png`.*

### Bab 10: Memilih Suku Budaya Nusantara
- Membuka menu Suku Budaya (`/konseli/tribe`).
- Melihat khazanah kebudayaan Indonesia (Jawa, Sunda, Madura, Bugis-Makassar, Bali, dll.).
- Mengklik tombol `Pilih Budaya Ini`.
- *Screenshot: `konseli_10_tribe_select.png`.*

### Bab 11: Mengerjakan Modul Self-Help Kearifan Lokal SFBC
- Membuka modul materi pada suku budaya terpilih (`/konseli/self-help/{id}`).
- Membaca kisah inspiratif ketabahan leluhur dan nilai-nilai filosofis nusantara.
- Menjawab butir pertanyaan reflektif mandiri terpandu SFBC (*Scaling*, *Miracle*, *Exception*, *Coping*).
- Mengklik tombol `Simpan Jawaban Refleksi`.
- *Screenshot: `konseli_11_selfhelp_detail.png`.*

### Bab 12: Mengakses Modul Pembelajaran Edukatif (Lessons)
- Membuka menu Pembelajaran (`/konseli/lessons`).
- Membaca artikel psikoedukasi, infografis, video materi, dan modul panduan PDF kesehatan mental remaja.
- *Screenshot: `konseli_12_lessons.png`.*

### Bab 13: Mengelola Profil & Keamanan Akun Siswa
- Membuka menu Profil (`/konseli/profile`).
- Memperbarui data nama, kelas, atau asal sekolah.
- Mengubah kata sandi akun untuk keamanan.
- *Screenshot: `konseli_13_profile.png`.*
