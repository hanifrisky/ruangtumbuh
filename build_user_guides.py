import os
from docx import Document
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from docx.oxml import parse_xml
from docx.oxml.ns import nsdecls

BASE_DIR = r"D:\Project\ruangtumbuh"
DOCS_DIR = os.path.join(BASE_DIR, "docs")
SCREENSHOTS_DIR = os.path.join(DOCS_DIR, "screenshots")
os.makedirs(DOCS_DIR, exist_ok=True)

def set_cell_background(cell, fill_hex):
    tcPr = cell._tc.get_or_add_tcPr()
    tcPr.append(parse_xml(f'<w:shd {nsdecls("w")} w:fill="{fill_hex}"/>'))

def set_cell_margins(cell, top=100, bottom=100, left=150, right=150):
    tcPr = cell._tc.get_or_add_tcPr()
    tcMar = parse_xml(f'<w:tcMar {nsdecls("w")}><w:top w:w="{top}" w:type="dxa"/><w:bottom w:w="{bottom}" w:type="dxa"/><w:left w:w="{left}" w:type="dxa"/><w:right w:w="{right}" w:type="dxa"/></w:tcMar>')
    tcPr.append(tcMar)

def setup_document(role_title):
    doc = Document()
    section = doc.sections[0]
    section.top_margin = Inches(0.8)
    section.bottom_margin = Inches(0.8)
    section.left_margin = Inches(0.9)
    section.right_margin = Inches(0.9)
    
    header = section.header
    hp = header.paragraphs[0]
    hp.alignment = WD_ALIGN_PARAGRAPH.RIGHT
    hrun = hp.add_run(f"Ruang Tumbuh | {role_title} • ruangtumbuh.appocket.id")
    hrun.font.size = Pt(8.5)
    hrun.font.color.rgb = RGBColor(148, 163, 184)

    footer = section.footer
    fp = footer.paragraphs[0]
    fp.alignment = WD_ALIGN_PARAGRAPH.CENTER
    frun = fp.add_run("Buku Panduan Pengguna Resmi - Platform Ruang Tumbuh © 2026")
    frun.font.size = Pt(8.5)
    frun.font.color.rgb = RGBColor(148, 163, 184)
    return doc

def add_callout(doc, text, title="💡 CATATAN PENTING / TIPS", border_color="0284C7", bg_color="F0F9FF"):
    table = doc.add_table(rows=1, cols=1)
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = False
    cell = table.cell(0, 0)
    cell.width = Inches(6.4)
    set_cell_background(cell, bg_color)
    set_cell_margins(cell, top=120, bottom=120, left=180, right=180)
    
    tcPr = cell._tc.get_or_add_tcPr()
    borders = parse_xml(f'''
        <w:tcBorders {nsdecls("w")}>
            <w:top w:val="none"/>
            <w:left w:val="single" w:sz="24" w:space="0" w:color="{border_color}"/>
            <w:bottom w:val="none"/>
            <w:right w:val="none"/>
        </w:tcBorders>
    ''')
    tcPr.append(borders)
    
    p = cell.paragraphs[0]
    p.paragraph_format.space_before = Pt(2)
    p.paragraph_format.space_after = Pt(2)
    run_title = p.add_run(f"{title}\n")
    run_title.bold = True
    run_title.font.size = Pt(9.5)
    run_title.font.color.rgb = RGBColor(2, 132, 199)
    run_text = p.add_run(text)
    run_text.font.size = Pt(9)
    run_text.font.color.rgb = RGBColor(51, 65, 85)
    
    doc.add_paragraph().paragraph_format.space_after = Pt(4)

def add_table_data(doc, headers, data, col_widths, theme_color="1E3A8A"):
    table = doc.add_table(rows=1, cols=len(headers))
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = False
    
    hdr_cells = table.rows[0].cells
    for i, title in enumerate(headers):
        hdr_cells[i].text = title
        hdr_cells[i].width = col_widths[i]
        set_cell_background(hdr_cells[i], theme_color)
        set_cell_margins(hdr_cells[i], top=100, bottom=100, left=120, right=120)
        p = hdr_cells[i].paragraphs[0]
        p.alignment = WD_ALIGN_PARAGRAPH.CENTER
        for r in p.runs:
            r.font.bold = True
            r.font.color.rgb = RGBColor(255, 255, 255)
            r.font.size = Pt(9)
            
    for row_idx, row_data in enumerate(data):
        row_cells = table.add_row().cells
        bg = "F8FAFC" if row_idx % 2 == 1 else "FFFFFF"
        for i, val in enumerate(row_data):
            row_cells[i].text = str(val)
            row_cells[i].width = col_widths[i]
            set_cell_background(row_cells[i], bg)
            set_cell_margins(row_cells[i], top=90, bottom=90, left=120, right=120)
            p = row_cells[i].paragraphs[0]
            for r in p.runs:
                r.font.size = Pt(8.5)
                r.font.color.rgb = RGBColor(30, 41, 59)
                
    doc.add_paragraph().paragraph_format.space_after = Pt(6)

def add_screenshot(doc, img_name, caption):
    img_path = os.path.join(SCREENSHOTS_DIR, img_name)
    if os.path.exists(img_path):
        p = doc.add_paragraph()
        p.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p.paragraph_format.space_before = Pt(8)
        p.paragraph_format.space_after = Pt(3)
        run = p.add_run()
        run.add_picture(img_path, width=Inches(5.8))
        
        cp = doc.add_paragraph()
        cp.alignment = WD_ALIGN_PARAGRAPH.CENTER
        cp.paragraph_format.space_before = Pt(2)
        cp.paragraph_format.space_after = Pt(8)
        crun = cp.add_run(caption)
        crun.italic = True
        crun.font.size = Pt(8.5)
        crun.font.color.rgb = RGBColor(100, 116, 139)

def add_cover(doc, title, subtitle, module_name):
    p_pre = doc.add_paragraph()
    p_pre.paragraph_format.space_before = Pt(24)
    p_pre.paragraph_format.space_after = Pt(4)
    r_pre = p_pre.add_run("PANDUAN OPERASIONAL & PENGGUNAAN SISTEM")
    r_pre.font.size = Pt(10.5)
    r_pre.bold = True
    r_pre.font.color.rgb = RGBColor(14, 165, 233)

    p_title = doc.add_paragraph()
    p_title.paragraph_format.space_before = Pt(0)
    p_title.paragraph_format.space_after = Pt(6)
    r_title = p_title.add_run(title)
    r_title.bold = True
    r_title.font.size = Pt(24)
    r_title.font.color.rgb = RGBColor(15, 23, 42)

    p_sub = doc.add_paragraph()
    p_sub.paragraph_format.space_before = Pt(0)
    p_sub.paragraph_format.space_after = Pt(14)
    r_sub = p_sub.add_run(subtitle)
    r_sub.font.size = Pt(12)
    r_sub.font.color.rgb = RGBColor(71, 85, 105)

    headers = ["Parameter", "Keterangan Informasi"]
    data = [
        ["Nama Aplikasi", "Ruang Tumbuh"],
        ["Tautan Aplikasi (URL)", "https://ruangtumbuh.appocket.id"],
        ["Modul yang Dibahas", module_name],
        ["Tanggal Pembaruan Terakhir", "Oktober 2026"],
        ["Format Distribusi Dokumen", "Microsoft Word (.docx) & PDF Ready"],
    ]
    add_table_data(doc, headers, data, [Inches(2.2), Inches(4.2)], theme_color="0F172A")
    doc.add_page_break()

def add_heading_1(doc, text):
    h = doc.add_paragraph()
    h.paragraph_format.space_before = Pt(16)
    h.paragraph_format.space_after = Pt(6)
    r = h.add_run(text)
    r.bold = True
    r.font.size = Pt(14.5)
    r.font.color.rgb = RGBColor(15, 23, 42)
    return h

def add_heading_2(doc, text):
    h = doc.add_paragraph()
    h.paragraph_format.space_before = Pt(11)
    h.paragraph_format.space_after = Pt(4)
    r = h.add_run(text)
    r.bold = True
    r.font.size = Pt(11.5)
    r.font.color.rgb = RGBColor(30, 58, 138)
    return h

def add_heading_3(doc, text):
    h = doc.add_paragraph()
    h.paragraph_format.space_before = Pt(7)
    h.paragraph_format.space_after = Pt(2)
    r = h.add_run(text)
    r.bold = True
    r.font.size = Pt(10)
    r.font.color.rgb = RGBColor(51, 65, 85)
    return h

def add_paragraph(doc, text):
    p = doc.add_paragraph()
    p.paragraph_format.space_after = Pt(6)
    p.paragraph_format.line_spacing = 1.15
    r = p.add_run(text)
    r.font.size = Pt(9.5)
    r.font.color.rgb = RGBColor(51, 65, 85)
    return p

# ==============================================================================
# 1. GENERATE DOKUMEN ADMIN
# ==============================================================================
def generate_admin_doc():
    print("Membangun Dokumen: Panduan_Pengguna_Ruang_Tumbuh_Admin.docx...")
    doc = setup_document("Buku Panduan Administrator")
    add_cover(
        doc,
        title="Buku Panduan Pengguna: Administrator",
        subtitle="Platform Konseling & Resiliensi Remaja Berbasis Kearifan Lokal Nusantara",
        module_name="Modul Pengelolaan Master Data & Konfigurasi Sistem (Admin)"
    )

    # 1. Judul & Versi
    add_heading_1(doc, "1. Informasi Modul & Akses Sistem")
    add_paragraph(doc, "Dokumen ini merupakan panduan teknis resmi bagi Pengelola Sistem (Administrator) di platform Ruang Tumbuh. Melalui modul ini, Administrator memegang wewenang penuh dalam mengelola master data pengguna, profil konselor bimbingan konseling, instrumen asesmen psikologis (skala resiliensi dan deteksi risiko), modul self-help berbasis kearifan budaya Nusantara, serta modul edukasi materi.")
    
    headers_info = ["Komponen", "Spesifikasi / Keterangan"]
    data_info = [
        ["Nama Aplikasi", "Ruang Tumbuh"],
        ["Domain Akses", "https://ruangtumbuh.appocket.id"],
        ["Role Sasaran", "Administrator Sistem (Admin)"],
        ["Modul Utama", "Manajemen User, Konselor, Asesmen, Self-Help, & Lessons"],
        ["Periode Pembaruan", "Oktober 2026"],
    ]
    add_table_data(doc, headers_info, data_info, [Inches(2.0), Inches(4.4)], theme_color="0F172A")

    # 2. Pendahuluan Ringan
    add_heading_1(doc, "2. Pendahuluan Ringan")
    add_paragraph(doc, "Ruang Tumbuh adalah platform konseling daring dan pengembangan resiliensi berbasis kearifan lokal yang dirancang khusus untuk mendampingi remaja dan siswa. Peran Administrator adalah memastikan operasional platform berjalan dengan lancar, data instrumen psikologis valid, profil para konselor tersaji dengan akurat, dan materi intervensi budaya nusantara selalu mutakhir.")
    add_paragraph(doc, "Tanggung jawab utama seorang Administrator meliputi:\n"
                  "1. Pengelolaan Akun Pengguna: Mendaftarkan konselor baru, memvalidasi akun siswa (konseli), dan mengelola keamanan kredensial akun.\n"
                  "2. Konfigurasi Konselor: Menata nomor urut konselor, deskripsi keahlian, nomor kontak WhatsApp, dan foto profil.\n"
                  "3. Pengelolaan Instrumen: Memelihara butir-butir pertanyaan asesmen resiliensi, skala pilihan ganda, dan rentang interpretasi skor.\n"
                  "4. Pengayaan Kearifan Budaya: Menambah dan memperbarui suku budaya, materi cerita inspiratif, serta pertanyaan refleksi SFBC (Solution-Focused Brief Counseling).")
    
    add_callout(doc, "Hak akses Administrator bersifat rahasia dan memiliki hak kendali penuh atas basis data. Pastikan kredensial akun disimpan dengan aman dan selalu lakukan proses logout setelah menyelesaikan sesi kerja.", title="⚠️ KEAMANAN HAK AKSES ADMINISTRATOR", border_color="E11D48", bg_color="FFF1F2")

    # 3. Prasyarat (Prerequisites)
    add_heading_1(doc, "3. Prasyarat (Prerequisites)")
    add_paragraph(doc, "Sebelum memulai operasional pada panel Administrator, pastikan telah memenuhi prasyarat berikut:")
    prereq_headers = ["Kebutuhan", "Spesifikasi Minimal yang Disarankan"]
    prereq_data = [
        ["Akun & Hak Akses", "Akun terdaftar dengan role 'admin' (kredensial diberikan oleh Superadmin)."],
        ["Perangkat Komputer", "Laptop atau PC desktop dengan resolusi layar minimal 1280 x 720 piksel."],
        ["Peramban Web (Browser)", "Google Chrome v100+, Microsoft Edge v100+, Mozilla Firefox, atau Safari."],
        ["Koneksi Internet", "Koneksi stabil minimal 2 Mbps untuk kelancaran unggah berkas dan olah data."],
        ["Perangkat Lunak Tambahan", "Aplikasi pengolah gambar sederhana (jika ingin mengunggah foto profil konselor)."]
    ]
    add_table_data(doc, prereq_headers, prereq_data, [Inches(2.2), Inches(4.2)], theme_color="1E3A8A")

    # 4. Langkah Penggunaan (Step-by-Step)
    add_heading_1(doc, "4. Langkah Penggunaan (Step-by-Step)")
    
    add_heading_2(doc, "4.1 Masuk ke Halaman Login & Autentikasi Admin")
    add_paragraph(doc, "Langkah-langkah untuk masuk ke panel Administrator:\n"
                  "1. Buka peramban web dan akses alamat: https://ruangtumbuh.appocket.id/login\n"
                  "2. Masukkan alamat email atau username Administrator pada formulir yang tersedia.\n"
                  "3. Masukkan kata sandi (password) akun Anda.\n"
                  "4. Klik tombol 'Masuk' atau 'Log in'. Sistem akan secara otomatis mengarahkan Anda ke Dashboard Admin.")
    add_screenshot(doc, "02_login_page.png", "Gambar 1.1: Halaman Masuk (Login) Ruang Tumbuh")

    add_heading_2(doc, "4.2 Mengenal Tampilan Dashboard Administrator")
    add_paragraph(doc, "Dashboard Administrator merupakan beranda kendali utama yang menampilkan ringkasan data penting, navigasi cepat ke seluruh modul, serta indikator operasional.")
    add_screenshot(doc, "admin_01_dashboard.png", "Gambar 1.2: Antarmuka Dashboard Administrator Ruang Tumbuh")
    add_callout(doc, "Menu navigasi bilah sisi (sidebar) kiri memuat tautan cepat ke: Manajemen Pengguna, Manajemen Konselor, Bank Soal, Skala Pilihan, Interpretasi Skor, Modul Budaya Nusantara, dan Pelajaran.", title="📌 TIPS NAVIGASI", border_color="0D9488", bg_color="F0FDFA")

    add_heading_2(doc, "4.3 Manajemen Akun Pengguna (Users)")
    add_paragraph(doc, "Pada menu 'Users' (/admin/users), Administrator dapat melihat daftar seluruh pengguna terdaftar (Admin, Konselor, Konseli), mencari pengguna berdasarkan nama/email, serta menambahkan akun baru atau mereset password.")
    add_screenshot(doc, "admin_02_users.png", "Gambar 1.3: Halaman Manajemen Pengguna (Users)")
    
    headers_user_action = ["Aksi / Tombol", "Fungsi & Kegunaan"]
    data_user_action = [
        ["Tambah Pengguna (+)", "Membuka formulir pendaftaran akun pengguna baru secara manual."],
        ["Filter Role", "Menyaring tampilan daftar pengguna berdasarkan role (Admin, Konselor, atau Konseli)."],
        ["Tombol Edit (Ikon Pensil)", "Memperbarui nama, email, username, atau mengubah kata sandi akun."],
        ["Tombol Hapus (Ikon Sampah)", "Menghapus akun pengguna dari pangkalan data sistem."]
    ]
    add_table_data(doc, headers_user_action, data_user_action, [Inches(2.2), Inches(4.2)])

    add_heading_2(doc, "4.4 Manajemen Profil Konselor")
    add_paragraph(doc, "Menu 'Counselors' (/admin/counselors) digunakan untuk mengelola profil publik para konselor yang akan dipilih oleh siswa. Profil ini mencakup riwayat pendidikan, motto hidup, nomor WhatsApp untuk konsultasi cepat, dan nomor urut tampilan.")
    add_screenshot(doc, "admin_03_counselors.png", "Gambar 1.4: Halaman Manajemen Data Konselor")
    add_callout(doc, "Nomor Urut (Order Number) menentukan urutan kemunculan konselor di beranda siswa. Berikan nomor urut yang rapi agar konselor prioritas muncul di baris teratas.", title="💡 TIPS PENGATURAN KONSELOR", border_color="2563EB", bg_color="EFF6FF")

    add_heading_2(doc, "4.5 Manajemen Bank Soal Instrumen (Questions)")
    add_paragraph(doc, "Menu 'Questions' (/admin/questions) memuat butir-butir pertanyaan asesmen psikologis. Administrator dapat menentukan apakah soal termasuk ke dalam Skala Resiliensi atau Skala Deteksi Risiko Ide Bunuh Diri, serta menentukan dimensi aspek kepribadian.")
    add_screenshot(doc, "admin_04_questions.png", "Gambar 1.5: Manajemen Bank Soal Asesmen Psikologis")

    add_heading_2(doc, "4.6 Pengaturan Skala Pilihan Jawaban (Option Groups)")
    add_paragraph(doc, "Menu 'Option Groups' (/admin/option-groups) mengatur bobot nilai dari setiap opsi pilihan ganda (misal: Skala Likert 1-4 atau 1-5, Sangat Tidak Sesuai hingga Sangat Sesuai).")
    add_screenshot(doc, "admin_05_option_groups.png", "Gambar 1.6: Halaman Skala Pilihan Jawaban (Option Groups)")

    add_heading_2(doc, "4.7 Manajemen Interpretasi Skor Asesmen")
    add_paragraph(doc, "Menu 'Interpretations' (/admin/interpretations) menentukan batasan skor (rentang nilai minimum dan maksimum), nama kategori hasil asesmen (Rendah, Sedang, Tinggi), serta deskripsi rekomendasi tindakan yang otomatis muncul pada laporan hasil siswa.")
    add_screenshot(doc, "admin_06_interpretations.png", "Gambar 1.7: Halaman Manajemen Interpretasi Skor")

    add_heading_2(doc, "4.8 Manajemen Modul Self-Help Kearifan Budaya (Tribes & Materials)")
    add_paragraph(doc, "Platform Ruang Tumbuh memiliki keunikan berupa modul intervensi berbasis kearifan budaya Nusantara (Tribes). Administrator mengelola suku budaya, materi cerita kearifan lokal, dan pertanyaan refleksi mandiri bagi siswa.")
    add_screenshot(doc, "admin_07_tribes.png", "Gambar 1.8: Daftar Suku Budaya Nusantara (Tribes)")
    add_paragraph(doc, "Untuk mengelola materi dan pertanyaan pada suku tertentu, klik tombol 'Materials' pada baris suku yang dipilih:")
    add_screenshot(doc, "admin_08_materials.png", "Gambar 1.9: Manajemen Materi Refleksi SFBC pada Suku Terpilih")

    add_heading_2(doc, "4.9 Manajemen Modul Pembelajaran Edukatif (Lessons)")
    add_paragraph(doc, "Menu 'Lessons' (/admin/lessons) memungkinkan Administrator mempublikasikan artikel edukatif, video bimbingan, atau panduan kesehatan mental remaja yang dapat diakses oleh seluruh siswa.")
    add_screenshot(doc, "admin_09_lessons.png", "Gambar 1.10: Halaman Manajemen Modul Pembelajaran (Lessons)")

    output_path = os.path.join(DOCS_DIR, "Panduan_Pengguna_Ruang_Tumbuh_Admin.docx")
    doc.save(output_path)
    print(f"Berhasil membuat: {output_path}")

# ==============================================================================
# 2. GENERATE DOKUMEN KONSELOR
# ==============================================================================
def generate_konselor_doc():
    print("Membangun Dokumen: Panduan_Pengguna_Ruang_Tumbuh_Konselor.docx...")
    doc = setup_document("Buku Panduan Konselor")
    add_cover(
        doc,
        title="Buku Panduan Pengguna: Konselor",
        subtitle="Platform Pendampingan Psikologis & Layanan Konseling Online Remaja",
        module_name="Modul Layanan Konseling & Pemantauan Konseli (Konselor)"
    )

    # 1. Judul & Versi
    add_heading_1(doc, "1. Informasi Modul & Akses Sistem")
    add_paragraph(doc, "Dokumen ini menyajikan panduan lengkap bagi Konselor Ruang Tumbuh dalam memberikan pendampingan bimbingan dan konseling kepada siswa (konseli). Modul ini mencakup ruang kerja konseling interaktif, telekonseling video (Google Meet / Zoom), pemantauan skor asesmen resiliensi, pemeriksaan refleksi budaya, serta pencatatan evaluasi sesi.")
    
    headers_info = ["Komponen", "Spesifikasi / Keterangan"]
    data_info = [
        ["Nama Aplikasi", "Ruang Tumbuh"],
        ["Domain Akses", "https://ruangtumbuh.appocket.id"],
        ["Role Sasaran", "Konselor / Guru Bimbingan dan Konseling (BK)"],
        ["Modul Utama", "Dashboard Binaan, Live Chat, Video Meet, Skor Asesmen, & Evaluasi"],
        ["Periode Pembaruan", "Oktober 2026"],
    ]
    add_table_data(doc, headers_info, data_info, [Inches(2.0), Inches(4.4)], theme_color="0D9488")

    # 2. Pendahuluan Ringan
    add_heading_1(doc, "2. Pendahuluan Ringan")
    add_paragraph(doc, "Peran Konselor dalam platform Ruang Tumbuh adalah sebagai fasilitator pertumbuhan psikologis siswa. Melalui sistem ini, Konselor dapat memonitor kondisi kesejahteraan mental siswa binaannya secara terstruktur, memberikan intervensi solusi singkat (SFBC), dan mendeteksi sedini mungkin potensi risiko psikologis.")
    add_paragraph(doc, "Fitur-fitur utama bagi Konselor:\n"
                  "1. Pemantauan Konseli Binaan: Mengetahui siswa mana saja yang telah memilih Anda sebagai konselor pendamping.\n"
                  "2. Rekam Jejak Asesmen: Memeriksa skor hasil pre-test dan post-test resiliensi serta indikator risiko siswa, lengkap dengan fitur unduh PDF resmi.\n"
                  "3. Layanan Chat Konseling: Berkomunikasi secara privat, empatik, dan aman melalui ruang obrolan langsung.\n"
                  "4. Penjadwalan Temu Virtual: Menyepakati waktu tatap muka virtual dan menyematkan tautan Google Meet / Zoom.\n"
                  "5. Evaluasi & Rekomendasi Sesi: Memberikan catatan kemajuan konseli dan tindak lanjut pasca sesi konseling.")

    # 3. Prasyarat (Prerequisites)
    add_heading_1(doc, "3. Prasyarat (Prerequisites)")
    prereq_headers = ["Kebutuhan", "Spesifikasi Minimal yang Disarankan"]
    prereq_data = [
        ["Akun Konselor", "Akun aktif ber-role 'konselor' yang telah didaftarkan oleh Administrator."],
        ["Perangkat", "Laptop, PC, atau Tablet yang dilengkapi kamera depan (webcam) dan mikrofon."],
        ["Peramban Web", "Google Chrome, Microsoft Edge, atau browser modern versi terkini."],
        ["Koneksi Internet", "Koneksi stabil minimal 5 Mbps (sangat disarankan untuk kelancaran video call)."],
        ["Platform Telekonseling", "Akun Google (untuk Google Meet) atau Zoom Meeting."]
    ]
    add_table_data(doc, prereq_headers, prereq_data, [Inches(2.2), Inches(4.2)], theme_color="0D9488")

    # 4. Langkah Penggunaan (Step-by-Step)
    add_heading_1(doc, "4. Langkah Penggunaan (Step-by-Step)")
    
    add_heading_2(doc, "4.1 Masuk ke Halaman Login Konselor")
    add_paragraph(doc, "Langkah masuk ke sistem:\n"
                  "1. Buka browser dan kunjungi https://ruangtumbuh.appocket.id/login\n"
                  "2. Masukkan alamat email institusi / username konselor yang telah terdaftar.\n"
                  "3. Masukkan password akun Konselor Anda.\n"
                  "4. Klik tombol 'Log in'. Sistem langsung mengarahkan Anda ke Dashboard Konselor.")
    add_screenshot(doc, "02_login_page.png", "Gambar 2.1: Halaman Masuk Akun Konselor")

    add_heading_2(doc, "4.2 Memahami Dashboard Konselor & Daftar Siswa Binaan")
    add_paragraph(doc, "Setelah login berhasil, Anda akan disambut oleh Dashboard Konselor (/konselor). Halaman ini menampilkan sambutan personal, panduan ringkas alur kerja konseling, serta tabel daftar seluruh siswa yang telah memilih Anda sebagai konselor pendamping.")
    add_screenshot(doc, "konselor_01_dashboard.png", "Gambar 2.2: Tampilan Dashboard Konselor & Daftar Konseli Binaan")

    headers_konselor_menu = ["Tombol / Kolom", "Keterangan Fungsi"]
    data_konselor_menu = [
        ["Nama Siswa & Sekolah", "Menampilkan identitas siswa binaan, kelas, dan asal sekolah."],
        ["Hasil Asesmen", "Membuka halaman pemantauan skor Wellbeing dan deteksi risiko siswa."],
        ["Jawaban Self-Help", "Melihat hasil refleksi pengerjaan modul kearifan lokal oleh siswa."],
        ["Ruang Sesi Konseling", "Membuka ruang komunikasi chat, jadwal temu, dan evaluasi konseling."]
    ]
    add_table_data(doc, headers_konselor_menu, data_konselor_menu, [Inches(2.2), Inches(4.2)], theme_color="0D9488")

    add_heading_2(doc, "4.3 Mengelola Sesi Konseling, Live Chat, & Jadwal Pertemuan")
    add_paragraph(doc, "Klik tombol 'Ruang Sesi Konseling' pada baris siswa yang bersangkutan untuk masuk ke ruang kerja konseling (/konselor/konseli/{id}/session). Di halaman ini Anda dapat:\n"
                  "1. Berbalas pesan instan (Live Chat) dengan siswa secara aman dan tertutup.\n"
                  "2. Menentukan Jadwal Konseling dan memasukkan tautan Google Meet / Zoom agar siswa dapat langsung bergabung pada jam yang ditentukan.\n"
                  "3. Menuliskan catatan Evaluasi Sesi dan Rekomendasi Tindak Lanjut.")
    add_screenshot(doc, "konselor_02_konseli_session.png", "Gambar 2.3: Ruang Kerja Sesi Konseling Konselor")
    add_callout(doc, "Pastikan untuk selalu memperbarui status jadwal dan menyematkan link video conference setidaknya 30 menit sebelum sesi konseling dimulai.", title="💬 TIPS PENJADWALAN KONSULTASI", border_color="0D9488", bg_color="F0FDFA")

    add_heading_2(doc, "4.4 Memantau Hasil Asesmen Psikologis & Unduh Laporan PDF")
    add_paragraph(doc, "Konselor dapat meninjau hasil tes asesmen siswa melalui menu 'Hasil Asesmen' (/konselor/konseli/{id}/wellbeing). Halaman ini menyajikan skor resiliensi, dimensi resiliensi yang perlu ditingkatkan, serta indikator risiko psikologis.")
    add_screenshot(doc, "konselor_03_konseli_wellbeing.png", "Gambar 2.4: Lembar Analisis Skor Asesmen Konseli")
    add_paragraph(doc, "Fitur pada lembar asesmen:\n"
                  "• Unduh Laporan PDF: Klik tombol 'Unduh PDF' untuk menyimpan arsip laporan perkembangan siswa secara resmi.\n"
                  "• Reset Asesmen: Jika siswa mengalami kendala teknis saat mengisi atau membutuhkan tes ulang berkala, konselor dapat mereset instrumen.")
    add_callout(doc, "Jika terdeteksi indikator risiko tinggi pada asesmen siswa, segera lakukan kontak prioritas melalui live chat atau hubungi pihak sekolah/wali untuk pendampingan intensif.", title="🚨 PERINGATAN RISIKO PSIKOLOGIS", border_color="E11D48", bg_color="FFF1F2")

    add_heading_2(doc, "4.5 Memeriksa Jawaban Modul Self-Help Budaya Nusantara")
    add_paragraph(doc, "Siswa dibekali latihan reflektif mandiri melalui kearifan budaya Nusantara. Konselor dapat membaca respons narasi siswa melalui tombol 'Jawaban Self-Help' (/konselor/konseli/{id}/self-help). Informasi ini sangat berguna sebagai bahan eksplorasi saat sesi konseling tatap muka.")
    add_screenshot(doc, "konselor_04_konseli_selfhelp.png", "Gambar 2.5: Pemantauan Lembar Refleksi Mandiri Budaya Konseli")

    output_path = os.path.join(DOCS_DIR, "Panduan_Pengguna_Ruang_Tumbuh_Konselor.docx")
    doc.save(output_path)
    print(f"Berhasil membuat: {output_path}")

# ==============================================================================
# 3. GENERATE DOKUMEN KONSELI (SISWA)
# ==============================================================================
def generate_konseli_doc():
    print("Membangun Dokumen: Panduan_Pengguna_Ruang_Tumbuh_Konseli.docx...")
    doc = setup_document("Buku Panduan Siswa (Konseli)")
    add_cover(
        doc,
        title="Buku Panduan Pengguna: Siswa (Konseli)",
        subtitle="Tempat Nyaman Remaja Bercerita, Bertumbuh, & Membangun Resiliensi Diri",
        module_name="Modul Layanan Konseling Mandiri & Interaksi Siswa (Konseli)"
    )

    # 1. Judul & Versi
    add_heading_1(doc, "1. Informasi Modul & Akses Sistem")
    add_paragraph(doc, "Dokumen ini merupakan panduan ramah pengguna bagi Siswa / Remaja (Konseli) dalam memanfaatkan seluruh fitur di aplikasi Ruang Tumbuh. Panduan ini menjelaskan bagaimana cara mengukur resiliensi diri, memilih konselor bimbingan konseling yang cocok, berdialog secara privat, serta mempelajari materi pengembangan diri berbasis kearifan budaya Nusantara.")
    
    headers_info = ["Komponen", "Spesifikasi / Keterangan"]
    data_info = [
        ["Nama Aplikasi", "Ruang Tumbuh"],
        ["Domain Akses", "https://ruangtumbuh.appocket.id"],
        ["Role Sasaran", "Siswa / Remaja (Konseli)"],
        ["Fitur Utama", "Tes Asesmen Diri, Pilih Konselor, Chat & Video Konseling, Modul Budaya"],
        ["Periode Pembaruan", "Oktober 2026"],
    ]
    add_table_data(doc, headers_info, data_info, [Inches(2.0), Inches(4.4)], theme_color="2563EB")

    # 2. Pendahuluan Ringan
    add_heading_1(doc, "2. Pendahuluan Ringan")
    add_paragraph(doc, "Selamat datang di Ruang Tumbuh! Aplikasi ini hadir sebagai ruang yang aman, nyaman, dan bebas penghakiman untuk kamu yang ingin mengenali diri, mengatasi kecemasan atau stres sekolah, serta menemukan kembali semangat dan daya juang (resiliensi).")
    add_paragraph(doc, "Apa saja yang bisa kamu lakukan di Ruang Tumbuh?\n"
                  "1. Mengetahui Kekuatan Dirimu: Mengisi asesmen singkat untuk mengetahui tingkat resiliensi dan kondisi kesehatan mentalmu.\n"
                  "2. Didampingi Konselor Terpercaya: Kamu bebas memilih konselor atau guru BK yang paling membuatmu nyaman.\n"
                  "3. Curhat & Konseling Privat: Bertukar pesan via chat atau melakukan tatap muka virtual tanpa khawatir rahasiamu bocor.\n"
                  "4. Belajar dari Kearifan Leluhur: Membaca kisah-kisah bijak Nusantara yang memotivasi dan mengisi lembar refleksi diri.")
    add_callout(doc, "Seluruh cerita, jawaban asesmen, dan percakapanmu dengan konselor di Ruang Tumbuh dijamin kerahasiaannya sesuai kode etik bimbingan dan konseling. Ceritakan apa adanya dengan jujur ya!", title="🛡️ PRIVASI DAN KERAHASIAAN TERJAMIN", border_color="2563EB", bg_color="EFF6FF")

    # 3. Prasyarat (Prerequisites)
    add_heading_1(doc, "3. Prasyarat (Prerequisites)")
    prereq_headers = ["Kebutuhan", "Penjelasan"]
    prereq_data = [
        ["Akun Siswa", "Kamu dapat mendaftar akun mandiri secara gratis melalui menu 'Daftar'."],
        ["Perangkat", "Bisa menggunakan Smartphone (HP Android/iPhone), Tablet, maupun Laptop."],
        ["Peramban (Browser)", "Gunakan aplikasi Google Chrome, Safari, atau Microsoft Edge."],
        ["Koneksi Internet", "Koneksi data seluler atau Wi-Fi yang lancar."],
        ["Aplikasi Pendukung", "Aplikasi Google Meet jika ingin melakukan tatap muka virtual lewat HP."]
    ]
    add_table_data(doc, prereq_headers, prereq_data, [Inches(2.2), Inches(4.2)], theme_color="2563EB")

    # 4. Langkah Penggunaan (Step-by-Step)
    add_heading_1(doc, "4. Langkah Penggunaan (Step-by-Step)")
    
    add_heading_2(doc, "4.1 Pendaftaran Akun Siswa Baru (Registrasi)")
    add_paragraph(doc, "Jika kamu belum memiliki akun, ikuti langkah berikut:\n"
                  "1. Buka https://ruangtumbuh.appocket.id/register\n"
                  "2. Masukkan Nama Lengkap, Username unik, dan Alamat Email aktif.\n"
                  "3. Pilih Jenis Kelamin, Kelas, dan Asal Sekolahmu.\n"
                  "4. Buat kata sandi (password) yang mudah kamu ingat.\n"
                  "5. Klik tombol 'Daftar Sekarang'. Akunmu langsung aktif!")
    add_screenshot(doc, "03_register_page.png", "Gambar 3.1: Halaman Pendaftaran Akun Siswa Baru")

    add_heading_2(doc, "4.2 Masuk ke Akun (Login)")
    add_paragraph(doc, "Bagi yang sudah memiliki akun, kunjungi https://ruangtumbuh.appocket.id/login, masukkan email/username dan password, lalu klik tombol 'Masuk'.")
    add_screenshot(doc, "02_login_page.png", "Gambar 3.2: Halaman Masuk Akun Siswa")

    add_heading_2(doc, "4.3 Mengenal Dashboard Siswa")
    add_paragraph(doc, "Setelah masuk, kamu akan tiba di Dashboard Siswa (/konseli). Di sini kamu bisa melihat langkah-langkah bimbingan yang perlu kamu selesaikan: mulai dari mengisi asesmen, memilih konselor, hingga mulai bercerita.")
    add_screenshot(doc, "konseli_01_dashboard.png", "Gambar 3.3: Dashboard Utama Siswa Ruang Tumbuh")

    add_heading_2(doc, "4.4 Mengikuti Asesmen Resiliensi Diri (Wellbeing)")
    add_paragraph(doc, "Langkah pertama yang sangat dianjurkan adalah mengikuti tes asesmen resiliensi (/konseli/wellbeing):\n"
                  "1. Klik tombol 'Asesmen Resiliensi' pada menu navigasi.\n"
                  "2. Klik 'Mulai Asesmen' untuk membuka butir-butir pernyataan.\n"
                  "3. Jawablah setiap pernyataan sesuai dengan perasaan dan kondisi yang sesungguhnya kamu alami.\n"
                  "4. Setelah semua pertanyaan terisi, klik tombol 'Selesai & Lihat Hasil'.")
    add_screenshot(doc, "konseli_02_wellbeing_index.png", "Gambar 3.4: Menu Asesmen Resiliensi Siswa")
    add_callout(doc, "Setelah menyelesaikan asesmen, kamu bisa melihat ringkasan skor resiliensimu dan mengunduh berkas laporan dalam format PDF resmi.", title="📄 LAPORAN PDF HASIL ASESMEN", border_color="0D9488", bg_color="F0FDFA")

    add_heading_2(doc, "4.5 Memilih Konselor Pendamping")
    add_paragraph(doc, "Kamu berhak memilih konselor yang kamu percayai:\n"
                  "1. Masuk ke menu 'Pilih Konselor' (/konseli/counselor).\n"
                  "2. Baca profil, latar belakang, dan motto hidup para konselor.\n"
                  "3. Klik tombol 'Pilih Konselor Ini' pada profil konselor yang kamu kehendaki.")
    add_screenshot(doc, "konseli_03_counselor_select.png", "Gambar 3.5: Halaman Daftar Profil & Pemilihan Konselor")

    add_heading_2(doc, "4.6 Memulai Sesi Konseling Online (Chat & Video)")
    add_paragraph(doc, "Setelah memilih konselor, kamu dapat masuk ke menu 'Konseling Online' (/konseli/counseling):\n"
                  "1. Tuliskan pesan curhat atau hal yang sedang mengganjal pikiranmu di kotak chat, lalu klik kirim.\n"
                  "2. Konselor akan membalas pesanmu dan mengajukan jadwal pertemuan daring.\n"
                  "3. Saat jadwal tiba, kamu cukup klik tombol 'Masuk ke Video Meet' untuk terhubung langsung dengan konselormu.")
    add_screenshot(doc, "konseli_04_counseling_room.png", "Gambar 3.6: Ruang Percakapan Chat & Info Jadwal Konseling Online")

    add_heading_2(doc, "4.7 Mengisi Refleksi Pasca Konseling")
    add_paragraph(doc, "Setelah menyelesaikan sesi berbincang dengan konselor, luangkan waktu 2-3 menit untuk mengisi menu 'Refleksi Sesi' (/konseli/reflection). Refleksi ini bertujuan mencatat poin positif apa yang kamu dapatkan dan rencana aksi perbaikan dirimu ke depan.")
    add_screenshot(doc, "konseli_05_reflection.png", "Gambar 3.7: Lembar Pengisian Refleksi Pasca Konseling")

    add_heading_2(doc, "4.8 Modul Self-Help Kearifan Budaya Nusantara")
    add_paragraph(doc, "Ruang Tumbuh menyediakan petuah bijak dari berbagai suku di Indonesia (/konseli/tribe):\n"
                  "1. Pilih suku budaya yang ingin kamu pelajari (misal: Jawa, Sunda, Madura, Bugis-Makassar, dll).\n"
                  "2. Baca kisah inspiratif dan falsafah hidup resiliensi leluhur nusantara.\n"
                  "3. Isi pertanyaan refleksi singkat untuk melatih ketangguhan mentalmu.")
    add_screenshot(doc, "konseli_06_tribe_select.png", "Gambar 3.8: Pilihan Suku Budaya Nusantara")
    add_screenshot(doc, "konseli_07_selfhelp_detail.png", "Gambar 3.9: Tampilan Materi Cerita & Lembar Refleksi Mandiri Budaya")

    add_heading_2(doc, "4.9 Mengakses Modul Pembelajaran & Mengubah Profil")
    add_paragraph(doc, "Kamu juga bisa membaca berbagai tips kesehatan mental di menu 'Pembelajaran' (/konseli/lessons), serta memperbarui data diri atau mengganti kata sandi di menu 'Profil' (/konseli/profile).")
    add_screenshot(doc, "konseli_08_lessons.png", "Gambar 3.10: Menu Modul Pembelajaran Edukatif")
    add_screenshot(doc, "konseli_09_profile.png", "Gambar 3.11: Halaman Pengaturan Profil Siswa")

    output_path = os.path.join(DOCS_DIR, "Panduan_Pengguna_Ruang_Tumbuh_Konseli.docx")
    doc.save(output_path)
    print(f"Berhasil membuat: {output_path}")

# ==============================================================================
# MAIN EXECUTION
# ==============================================================================
if __name__ == "__main__":
    generate_admin_doc()
    generate_konselor_doc()
    generate_konseli_doc()
    print("\nSeluruh dokumen Word (.docx) berhasil dibangun dengan sempurna!")
