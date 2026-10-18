@extends('layouts.base')

@section('title', 'Beranda - Ruang Tumbuh')
@section('description', 'Konstruksi Model Teoritis Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri')

@section('body')
<div class="min-h-screen bg-white text-slate-800 overflow-x-hidden selection:bg-emerald-100 selection:text-forest-900">
    
    {{-- ======================================================================
         1. FLOATING CLEAN NAVBAR (60% White Canvas)
         ====================================================================== --}}
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 py-3.5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            {{-- Brand Left --}}
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-10 h-10 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform flex-shrink-0">
                <div>
                    <span class="font-sans font-black text-lg sm:text-xl text-forest-900 tracking-tight leading-none block">RUANG TUMBUH</span>
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-forest-600 block mt-0.5">BK FIP Universitas Negeri Malang</span>
                </div>
            </a>

            {{-- Desktop Links --}}
            <nav class="hidden md:flex items-center gap-1 bg-slate-50 p-1.5 rounded-full border border-slate-200">
                <a href="#beranda" class="px-4 py-1.5 rounded-full text-xs font-bold text-forest-900 bg-white shadow-sm">
                    Beranda
                </a>
                <a href="#program" class="px-4 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-forest-800 transition-colors">
                    Program & Alur
                </a>
                <a href="#pilar" class="px-4 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-forest-800 transition-colors">
                    3 Pilar Model
                </a>
                <a href="#tujuan" class="px-4 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-forest-800 transition-colors">
                    Tujuan & Manfaat
                </a>
                <a href="{{ route('informasi') }}" class="px-4 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-forest-800 transition-colors">
                    Tim Pengembang
                </a>
            </nav>

            {{-- Auth Action (30% Green Button, 10% Sky Accent) --}}
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary py-2.5 px-5 text-xs font-bold">
                        Buka Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-full text-xs font-bold text-forest-800 hover:bg-forest-50 border border-slate-200 transition-all">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary py-2.5 px-5 text-xs font-bold">
                        Daftar Akun Konseli
                    </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- ======================================================================
         2. HERO SECTION (INSPIRED DIRECTLY BY GOYANG FORUM POSTER)
         60% White Canvas Top + High Contrast Bold Green Typography + 10% Sky Accents
         ====================================================================== --}}
    <section id="beranda" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-10 pb-8 sm:pb-12 relative">
        
        {{-- Top Hashtags in 10% Sky Blue (Exactly like Goyang Poster top right corner) --}}
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-forest-50 border border-forest-200 text-forest-800 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-forest-600 animate-pulse"></span>
                <span>Riset Unggulan Departemen BK FIP Universitas Negeri Malang</span>
            </div>

            {{-- 10% Blue Hashtag Badges --}}
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3 py-1 rounded-full bg-sky-50 border border-sky-200 text-sky-700 text-xs font-bold tracking-tight">
                    #KearifanLokalNusantara
                </span>
                <span class="px-3 py-1 rounded-full bg-sky-50 border border-sky-200 text-sky-700 text-xs font-bold tracking-tight">
                    #WellBeingRemaja
                </span>
                <span class="px-3 py-1 rounded-full bg-sky-50 border border-sky-200 text-sky-700 text-xs font-bold tracking-tight">
                    #CegahIdeBunuhDiri
                </span>
            </div>
        </div>

        {{-- Main Poster Headline: Massive Bold Green Typography --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-10">
            <div class="lg:col-span-8 space-y-4">
                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-widest text-forest-700 block">
                    Platform Konseling Online Terpadu
                </span>
                <h1 class="font-sans text-4xl sm:text-5xl md:text-6xl font-black text-forest-900 tracking-tight leading-[1.08]">
                    TUMBUH TANGGUH,<br>
                    <span class="text-forest-700">RAYAKAN KEHIDUPAN</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 font-normal leading-relaxed max-w-2xl pt-2">
                    Ruang aman bagi remaja Indonesia untuk meredakan beban batin, merekonstruksi keyakinan diri melalui pendekatan <strong>REBT</strong>, serta menemukan kembali harapan masa depan berlandaskan <strong>kearifan lokal Nusantara</strong>.
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-4">
                    <a href="{{ route('register') }}" class="btn-primary py-3.5 px-8 text-sm font-bold shadow-lg">
                        Mulai Konseling Gratis &rarr;
                    </a>
                    <a href="#program" class="btn-secondary py-3.5 px-6 text-sm font-bold">
                        Lihat 8 Alur Program
                    </a>
                </div>
            </div>

            {{-- Graphic Ribbon & Miniature Life World Illustration Motif --}}
            <div class="lg:col-span-4 relative flex items-center justify-center">
                <div class="w-64 h-64 sm:w-80 sm:h-80 rounded-full bg-gradient-to-tr from-forest-100 via-sky-50 to-emerald-50 border border-forest-200/80 flex items-center justify-center relative p-6 shadow-inner">
                    <div class="text-center space-y-2">
                        <div class="w-16 h-16 rounded-2xl bg-forest-700 text-white flex items-center justify-center mx-auto shadow-md">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h4 class="font-black text-forest-950 text-base">Ruang Tumbuh Remaja</h4>
                        <p class="text-xs text-forest-800 font-medium leading-relaxed">
                            12 Konselor Ahli &bull; Privasi Dijamin &bull; Asesmen Berstandar Ilmiah
                        </p>
                        <span class="inline-block mt-2 px-3 py-1 bg-white text-sky-700 text-[11px] font-bold rounded-full border border-sky-200 shadow-sm">
                            100% Layanan Bebas Biaya
                        </span>
                    </div>

                    {{-- Floating Organic Leaf Accents --}}
                    <span class="absolute -top-2 right-4 text-2xl animate-bounce">🌱</span>
                    <span class="absolute bottom-4 -left-2 text-2xl">🍃</span>
                </div>
            </div>
        </div>

        {{-- ======================================================================
             3. 30% GREEN MASTER CONTAINER: PROGRAM & SCHEDULE SECTION
             (Directly mirrors the bottom dark-green section with yellow PROGRAM badge & QR card)
             ====================================================================== --}}
        <div id="program" class="bg-gradient-to-br from-forest-950 via-forest-900 to-forest-800 text-white rounded-3xl p-6 sm:p-10 lg:p-12 shadow-2xl relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start relative z-10">
                
                {{-- Left Side: Date / Identity + Lime-Yellow Action Ticket (like "정책제안 참여하기" in poster) --}}
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <h3 class="font-sans text-2xl sm:text-3xl font-black text-white tracking-tight">
                            LAYANAN KONSELING & REFLEKSI 2026
                        </h3>
                        <p class="text-emerald-200 text-xs sm:text-sm font-semibold mt-1 uppercase tracking-wider">
                            DEPARTEMEN BIMBINGAN DAN KONSELING FIP UM
                        </p>
                    </div>

                    {{-- Lime-Yellow Card (Mirrors the QR consultation box in poster) --}}
                    <div class="bg-lime-300 text-forest-950 p-6 rounded-3xl shadow-lg border-2 border-lime-400 space-y-3">
                        <div class="flex items-center justify-between gap-2 border-b border-forest-900/15 pb-3">
                            <span class="font-black text-xs uppercase tracking-wider text-forest-900">
                                Mulai Partisipasi Konseli
                            </span>
                            <span class="text-xs font-bold bg-forest-900 text-white px-2.5 py-0.5 rounded-full">
                                1-Klik
                            </span>
                        </div>
                        <p class="text-xs font-semibold leading-relaxed text-forest-900">
                            Akses langsung instrumen pengukuran awal Well-Being, pemilihan 12 konselor tersertifikasi, dan modul refleksi kearifan lokal.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-forest-900 hover:bg-forest-950 text-white font-black text-xs uppercase tracking-wider shadow-md transition-all">
                                <span>Daftar Konseli Sekarang</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="space-y-1.5 text-xs text-emerald-200 font-medium">
                        <p><strong>Hotline SEJIWA:</strong> 119 ext 8 (Kemenkes RI)</p>
                        <p><strong>WhatsApp Pendampingan:</strong> +62 812-3175-0634</p>
                        <p><strong>Lokasi:</strong> Kampus Universitas Negeri Malang, Jl. Semarang 5</p>
                    </div>
                </div>

                {{-- Right Side: The "PROGRAM" Section Table (Mirrors the poster's program timetable) --}}
                <div class="lg:col-span-7">
                    <div class="mb-4 flex items-center justify-between">
                        <span class="card-program-badge">
                            PROGRAM & ALUR 8 LANGKAH
                        </span>
                        <span class="text-xs text-emerald-300 font-bold uppercase tracking-wider">
                            Jalur Bertumbuh
                        </span>
                    </div>

                    <div class="space-y-2.5 text-xs sm:text-sm">
                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 01</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Pengenalan Platform & Informed Consent</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Pemberian rasa aman dan pemahaman hak privasi penuh konseli.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 02</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Asesmen Awal Well-Being & Ideasi Remaja</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Pengisian instrumen saintifik untuk pemetaan kondisi psikologis awal.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 03</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Pemilihan Konselor Pendamping</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Memilih praktisi bimbingan konseling yang selaras dengan kenyamanan diri.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 04</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Eksplorasi Mandiri & Kearifan Lokal (SFBC)</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Membangkitkan daya lentur batin melalui filosofi budaya luhur Nusantara.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 05</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Konseling Online Virtual (Google Meet / Zoom)</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Sesi dialog tatap maya terstruktur bersama konselor pendamping pilihan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 06</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Penguatan Resiliensi & Regulasi Emosi</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Latihan koping adaptif meredakan distres kognitif dan keputusasaan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 07</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Jurnal Refleksi Pasca-Sesi</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Pencatatan wawasan baru, nilai budaya yang diperkuat, dan langkah nyata.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 transition-colors">
                            <span class="font-mono font-bold text-lime-300 whitespace-nowrap min-w-[70px]">Langkah 08</span>
                            <div class="flex-1">
                                <span class="font-bold text-white">Evaluasi Pertumbuhan & Rekomendasi Konselor</span>
                                <p class="text-emerald-200 text-xs mt-0.5 font-light">Asesmen akhir membandingkan kemajuan skor serta rencana tindak lanjut.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bottom Credential Bar (like the bottom sponsor footer on the poster) --}}
            <div class="mt-8 pt-6 border-t border-white/15 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-emerald-200 font-medium">
                <div>
                    Penyelenggara / Riset: <strong>Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang</strong>
                </div>
                <div class="text-right">
                    Didukung oleh Tim Pengembang Ahli BK UM &bull; Terdaftar & Teruji Akademis
                </div>
            </div>
        </div>

    </section>

    {{-- ======================================================================
         4. 3 CORE PILLARS (60% White Cards, 30% Green Borders, 10% Blue Badges)
         ====================================================================== --}}
    <section id="pilar" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-slate-200">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="px-3 py-1 rounded-full bg-forest-50 border border-forest-200 text-forest-800 text-xs font-bold uppercase tracking-wider inline-block mb-2">
                Fondasi Teori & Model
            </span>
            <h2 class="font-sans text-3xl font-black text-forest-950 tracking-tight">
                Tiga Pilar Kekuatan Ruang Tumbuh
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                Integrasi harmonis antara sains psikologi modern dan kebijaksanaan luhur budaya Indonesia.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Pilar 1 --}}
            <div class="card p-7 hover:border-forest-500 hover:shadow-md transition-all">
                <span class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 text-xs font-bold uppercase tracking-wider inline-block mb-4 border border-sky-200">
                    Pilar 01 • Sains Kognitif
                </span>
                <h3 class="font-sans text-xl font-bold text-forest-900 mb-2">Rational Emotive Behavior Therapy (REBT)</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Membimbing remaja mengenali dan merestrukturisasi keyakinan irasional (*irrational beliefs*) penyebab distres mendalam menjadi cara pandang rasional yang konstruktif.
                </p>
            </div>

            {{-- Pilar 2 --}}
            <div class="card p-7 border-2 border-forest-300 bg-forest-50/20 hover:border-forest-600 hover:shadow-md transition-all">
                <span class="px-2.5 py-1 rounded-lg bg-forest-100 text-forest-800 text-xs font-bold uppercase tracking-wider inline-block mb-4 border border-forest-200">
                    Pilar 02 • Akar Budaya
                </span>
                <h3 class="font-sans text-xl font-bold text-forest-900 mb-2">Kearifan Lokal Nusantara</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Menghidupkan kembali nilai falsafah hidup luhur (*Urip Iku Urup, Gotong Royong, Eling lan Waspada*) sebagai jangkar identitas dan penopang ketahanan batin remaja.
                </p>
            </div>

            {{-- Pilar 3 --}}
            <div class="card p-7 hover:border-forest-500 hover:shadow-md transition-all">
                <span class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 text-xs font-bold uppercase tracking-wider inline-block mb-4 border border-sky-200">
                    Pilar 03 • Berfokus Solusi
                </span>
                <h3 class="font-sans text-xl font-bold text-forest-900 mb-2">Solution-Focused Brief Counseling (SFBC)</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Bukan berfokus pada kepedihan masa lalu, melainkan mengeksplorasi pengecualian (*exceptions*), potensi kekuatan, dan merumuskan langkah nyata bertumbuh ke depan.
                </p>
            </div>
        </div>
    </section>

    {{-- ======================================================================
         5. TUJUAN PENGEMBANGAN (7 Tujuan Ilmiah)
         ====================================================================== --}}
    <section id="tujuan" class="bg-slate-50 py-16 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="px-3 py-1 rounded-full bg-forest-50 border border-forest-200 text-forest-800 text-xs font-bold uppercase tracking-wider inline-block mb-2">
                    Capaian Riset
                </span>
                <h2 class="font-sans text-3xl font-black text-forest-950 tracking-tight">
                    7 Tujuan Pengembangan Platform
                </h2>
                <p class="text-slate-600 text-sm mt-2">
                    Tujuan strategis yang dirumuskan oleh tim pengembang Departemen BK FIP Universitas Negeri Malang.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $tujuanList = [
                        ['no' => '01', 'title' => 'Mengidentifikasi Kebutuhan Remaja', 'desc' => 'Menemukenali dinamika psikologis remaja dengan ide bunuh diri secara sensitif.'],
                        ['no' => '02', 'title' => 'Mengonstruksi Model Konseling Online', 'desc' => 'Menyusun sintaks layanan konseling berbasis kearifan lokal yang ilmiah dan teruji.'],
                        ['no' => '03', 'title' => 'Menguji Validitas Ahli & Praktisi', 'desc' => 'Memastikan materi dan instrumen divalidasi oleh pakar bimbingan konseling dan budaya.'],
                        ['no' => '04', 'title' => 'Menguji Kepraktisan & Keterterapan', 'desc' => 'Menjamin antarmuka mudah digunakan dan ramah bagi remaja sekolah menengah.'],
                        ['no' => '05', 'title' => 'Mereduksi Ide Bunuh Diri', 'desc' => 'Menurunkan intensitas distres emosional dan pemikiran melukai diri sendiri.'],
                        ['no' => '06', 'title' => 'Meningkatkan Psychological Well-Being', 'desc' => 'Menumbuhkan penerimaan diri, otonomi, dan tujuan hidup yang bermakna.'],
                        ['no' => '07', 'title' => 'Menyediakan Panduan Implementasi', 'desc' => 'Buku pedoman baku bagi konselor sekolah dalam mendampingi remaja rentan.'],
                    ];
                @endphp

                @foreach($tujuanList as $item)
                    <div class="card p-5 bg-white border border-slate-200">
                        <span class="font-mono text-xs font-black text-forest-600 block mb-2">{{ $item['no'] }}</span>
                        <h4 class="font-bold text-forest-950 text-sm mb-1">{{ $item['title'] }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================================================================
         6. CRISIS SUPPORT BANNER & FOOTER
         ====================================================================== --}}
    <footer class="bg-forest-950 text-white border-t border-forest-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start mb-8">
                <div class="md:col-span-6 space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-9 h-9 rounded-xl object-cover bg-white">
                        <span class="font-black text-xl text-white">RUANG TUMBUH</span>
                    </div>
                    <p class="text-xs text-emerald-200 font-light leading-relaxed max-w-md">
                        Konstruksi Model Teoritis Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri.
                    </p>
                    <p class="text-xs text-slate-400">
                        Departemen Bimbingan dan Konseling, Fakultas Ilmu Pendidikan, Universitas Negeri Malang (UM).
                    </p>
                </div>

                <div class="md:col-span-3 space-y-2 text-xs">
                    <p class="font-bold text-white uppercase tracking-wider">Tautan Cepat</p>
                    <p><a href="#beranda" class="text-emerald-300 hover:text-white transition-colors">Beranda Utama</a></p>
                    <p><a href="#program" class="text-emerald-300 hover:text-white transition-colors">Alur 8 Langkah</a></p>
                    <p><a href="{{ route('informasi') }}" class="text-emerald-300 hover:text-white transition-colors">Informasi & Tim Pengembang</a></p>
                    <p><a href="{{ route('login') }}" class="text-emerald-300 hover:text-white transition-colors">Masuk Akun</a></p>
                </div>

                <div class="md:col-span-3 space-y-2 text-xs">
                    <p class="font-bold text-white uppercase tracking-wider">Bantuan Krisis 24 Jam</p>
                    <p class="text-emerald-200">Hotline Kemenkes: <strong>119 ext 8</strong> (Bebas Pulsa)</p>
                    <p class="text-emerald-200">WA Konselor BK UM: <strong>+62 812-3175-0634</strong></p>
                    <p class="text-slate-400 text-[11px] mt-2">Jika Anda berada dalam bahaya mendesak, segera hubungi layanan gawat darurat terdekat.</p>
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} RUANG TUMBUH &bull; Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>

</div>
@endsection
