@extends('layouts.base')

@section('title', 'Ruang Tumbuh - Pusat Bantuan Konseling Online Remaja')
@section('description', 'Platform pusat bantuan konseling online bermuatan nilai kearifan lokal untuk meningkatkan well-being remaja dengan pendekatan REBT dan Carol D. Ryff.')

@section('body')
<div class="min-h-screen bg-[#F8FCF8] text-slate-800 selection:bg-emerald-200 selection:text-forest-950 overflow-x-hidden">
    
    {{-- ======================================================================
         1. MODERN PLAYFUL NAVBAR
         ====================================================================== --}}
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-emerald-100 py-3.5 px-4 sm:px-8 lg:px-12 transition-all">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            
            {{-- Brand Logo --}}
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-forest-800 to-emerald-500 p-0.5 shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform flex-shrink-0">
                    <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="Logo Ruang Tumbuh" class="w-full h-full rounded-[14px] object-cover bg-white">
                </div>
                <div>
                    <span class="font-display font-black text-xl sm:text-2xl text-forest-950 tracking-tight leading-none block">RUANG TUMBUH</span>
                    <span class="text-[11px] sm:text-xs font-bold text-emerald-700 block mt-0.5">BK FIP Universitas Negeri Malang</span>
                </div>
            </a>

            {{-- Navigation Links --}}
            <nav class="hidden lg:flex items-center gap-1.5 bg-emerald-50/70 p-1.5 rounded-full border border-emerald-200/60 text-xs sm:text-sm font-bold text-slate-700">
                <a href="#tentang" class="px-4 py-1.5 rounded-full hover:bg-white hover:text-emerald-800 transition-colors">Tentang</a>
                <a href="#tujuan" class="px-4 py-1.5 rounded-full hover:bg-white hover:text-emerald-800 transition-colors">Tujuan</a>
                <a href="#karakteristik" class="px-4 py-1.5 rounded-full hover:bg-white hover:text-emerald-800 transition-colors">Keunggulan</a>
                <a href="#langkah" class="px-4 py-1.5 rounded-full hover:bg-white hover:text-emerald-800 transition-colors">Alur Layanan</a>
                <a href="#pengembang" class="px-4 py-1.5 rounded-full hover:bg-white hover:text-emerald-800 transition-colors">Pengembang</a>
            </nav>

            {{-- Actions --}}
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary py-2.5 px-5 text-xs sm:text-sm rounded-full shadow-md shadow-forest-800/20">
                        Buka Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex py-2.5 px-4 text-xs sm:text-sm font-bold text-forest-900 hover:text-emerald-700 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary py-2.5 px-5 text-xs sm:text-sm rounded-full shadow-md shadow-forest-800/20">
                        Daftar Akun
                    </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- ======================================================================
         2. HERO SECTION: "RUANG TUMBUH" (MODERN, PLAYFUL, ENERGETIC)
         ====================================================================== --}}
    <section class="relative pt-8 sm:pt-14 pb-0 overflow-hidden bg-gradient-to-b from-white via-emerald-50/40 to-[#F0FDF4]">
        
        {{-- Playful Wavy SVG Background Decorations --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-200/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-20 w-80 h-80 bg-lime-200/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                
                {{-- Left Column: Text & Energetic Callout --}}
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    {{-- Playful Pill Badge --}}
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100/90 text-forest-900 text-xs sm:text-sm font-black border border-emerald-300/80 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                        <span>Platform Bimbingan & Konseling Online Remaja</span>
                        <span class="bg-lime-300 text-forest-950 px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider">Kearifan Lokal</span>
                    </div>

                    {{-- Hero Title: RUANG TUMBUH --}}
                    <div class="space-y-1">
                        <h1 class="font-display font-black text-5xl sm:text-6xl md:text-7xl lg:text-[5.25rem] text-forest-950 tracking-tight leading-[0.95]">
                            RUANG <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-emerald-700 to-forest-800">TUMBUH</span>
                        </h1>
                        <p class="font-display font-extrabold text-lg sm:text-2xl text-emerald-800 tracking-tight">
                            Selamat Datang di Ruang Tumbuh!
                        </p>
                    </div>

                    {{-- Explanatory Lead Paragraph --}}
                    <p class="text-slate-700 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                        Pusat bantuan pelaksanaan konseling online bermuatan nilai kearifan lokal untuk meningkatkan <em>well-being</em> pada remaja yang beride bunuh diri. Kami hadir mendampingi kamu menyelesaikan permasalahan dengan fokus pada pemulihan kondisi kesejahteraan psikologis untuk menghadapi masa depan penuh harapan.
                    </p>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-2">
                        <a href="{{ route('register') }}" class="btn-primary py-4 px-8 text-base font-extrabold rounded-2xl shadow-lg shadow-forest-800/25 hover:shadow-xl hover:scale-[1.02] transition-all flex items-center gap-2">
                            <span>Mulai Konseling Sekarang</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="#langkah" class="btn-secondary py-4 px-7 text-base font-bold rounded-2xl border-2 border-emerald-200 hover:border-emerald-400 hover:bg-emerald-50 transition-all">
                            Alur 8 Langkah
                        </a>
                    </div>

                    {{-- Highlights Chips --}}
                    <div class="pt-3 flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs font-bold text-emerald-900">
                        <div class="flex items-center gap-1.5 bg-white/80 px-3 py-1.5 rounded-xl border border-emerald-200/80 shadow-xs">
                            <span class="text-emerald-600">✓</span>
                            <span>Pendekatan REBT & Ryff</span>
                        </div>
                        <div class="flex items-center gap-1.5 bg-white/80 px-3 py-1.5 rounded-xl border border-emerald-200/80 shadow-xs">
                            <span class="text-emerald-600">✓</span>
                            <span>Nilai Kearifan Nusantara</span>
                        </div>
                        <div class="flex items-center gap-1.5 bg-white/80 px-3 py-1.5 rounded-xl border border-emerald-200/80 shadow-xs">
                            <span class="text-emerald-600">✓</span>
                            <span>100% Aman & Rahasia</span>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Modern Energetic Youth 3D Illustration --}}
                <div class="lg:col-span-5 relative flex justify-center">
                    
                    {{-- Playful Wavy Organic Backdrop --}}
                    <div class="relative w-full max-w-lg">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-300 via-lime-200 to-teal-200 rounded-[2.5rem] transform rotate-3 scale-95 opacity-80 blur-lg"></div>
                        
                        <div class="relative bg-white rounded-[2.5rem] p-4 sm:p-6 border-4 border-emerald-100 shadow-2xl overflow-hidden group">
                            
                            {{-- Energetic Youth Group Image --}}
                            <div class="rounded-3xl overflow-hidden bg-gradient-to-b from-emerald-50/50 to-white">
                                <img src="{{ asset('image/hero-youth-growth.png') }}" 
                                     alt="Kelompok remaja Indonesia ceria merayakan kesehatan mental dan pertumbuhan diri di Ruang Tumbuh" 
                                     class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700" 
                                     width="640" 
                                     height="540" 
                                     loading="eager" />
                            </div>

                            {{-- Wavy Floating Micro-Card --}}
                            <div class="mt-4 p-3.5 bg-gradient-to-r from-emerald-500 to-forest-700 text-white rounded-2xl flex items-center justify-between gap-3 shadow-md">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center font-black text-lg">
                                        🌱
                                    </div>
                                    <div>
                                        <p class="text-xs font-black leading-tight">Kamu Tidak Sendirian</p>
                                        <p class="text-[11px] text-emerald-100 font-medium">Ada ruang aman untuk didengar dan bertumbuh</p>
                                    </div>
                                </div>
                                <span class="text-xs font-extrabold bg-lime-300 text-forest-950 px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    Gratis
                                </span>
                            </div>
                        </div>

                        {{-- Playful Floating Badges --}}
                        <div class="absolute -top-4 -right-2 bg-lime-300 text-forest-950 font-black text-xs px-3.5 py-1.5 rounded-full border-2 border-white shadow-lg transform rotate-6 animate-bounce">
                            ✦ Ceria & Optimis
                        </div>
                        <div class="absolute -bottom-3 -left-3 bg-forest-900 text-white font-bold text-xs px-4 py-2 rounded-2xl shadow-lg border-2 border-emerald-300 transform -rotate-3">
                            🤝 Didampingi Konselor Ahli
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- Wavy Organic SVG Divider to Next Section --}}
        <div class="w-full overflow-hidden leading-none mt-12 sm:mt-16 text-white -mb-px">
            <svg class="relative block w-full h-14 sm:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,140.83,111.45,200.74,99,240.23,90.81,280.23,64.1,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    {{-- ======================================================================
         3. SECTION: TENTANG RUANG TUMBUH & 3 KOMPONEN UTAMA
         ====================================================================== --}}
    <section id="tentang" class="bg-white py-16 sm:py-24 px-4 sm:px-8 lg:px-12 relative">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-forest-900 text-xs font-black uppercase tracking-wider">
                    Model Konseling Berbasis Budaya & Sains
                </span>
                <h2 class="font-display font-black text-3xl sm:text-5xl text-forest-950 tracking-tight">
                    Mengenal Lebih Dekat <span class="text-emerald-700">Ruang Tumbuh</span>
                </h2>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    RUANG TUMBUH merupakan model konseling online yang dikembangkan untuk mendukung peningkatan kesejahteraan psikologis (<em>psychological well-being</em>) remaja melalui pendekatan Rational Emotive Behavior Therapy (REBT) yang diperkaya dengan nilai-nilai kearifan lokal Indonesia.
                </p>
            </div>

            {{-- Big Story Callout Box with Wavy Accent --}}
            <div class="p-8 sm:p-12 rounded-[2.5rem] bg-gradient-to-br from-emerald-50 via-teal-50/50 to-lime-50/40 border-2 border-emerald-200/80 shadow-sm relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-emerald-200/30 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10 space-y-4 text-slate-800 text-base sm:text-lg leading-relaxed font-medium">
                    <p>
                        Model ini dirancang sebagai ruang pendampingan yang <strong>aman, suportif, dan inklusif</strong> bagi remaja untuk memahami pengalaman emosional, mengenali pola pikir yang kurang membantu, membangun keyakinan yang lebih rasional, serta menemukan kembali makna, kekuatan, dan harapan dalam kehidupannya.
                    </p>
                    <p>
                        Ketiga komponen dilaksanakan melalui media konseling online dengan tetap memperhatikan kebutuhan perkembangan remaja, kerahasiaan, etika profesi, dan keselamatan pengguna.
                    </p>
                </div>
            </div>

            {{-- 3 Komponen Utama (Playful Cards) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                
                {{-- Komponen 1: REBT --}}
                <div class="p-7 sm:p-8 rounded-3xl bg-white border-2 border-emerald-200 hover:border-emerald-500 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-forest-900 flex items-center justify-center font-black text-2xl group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            🧠
                        </div>
                        <span class="text-xs font-black uppercase tracking-wider text-emerald-700 block">
                            Mekanisme Perubahan Psikologis
                        </span>
                        <h3 class="font-display font-black text-xl text-forest-950">
                            Pendekatan REBT
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Membantu remaja mengenali, mengevaluasi, dan merekonstruksi keyakinan irasional yang memicu distres emosional menjadi keyakinan rasional yang fleksibel dan konstruktif.
                        </p>
                    </div>
                    <div class="pt-6 border-t border-slate-100 mt-6 flex items-center gap-2 text-xs font-extrabold text-forest-800">
                        <span>Pilar Sains Kognitif</span>
                        <span>✦</span>
                    </div>
                </div>

                {{-- Komponen 2: Kearifan Lokal --}}
                <div class="p-7 sm:p-8 rounded-3xl bg-forest-950 text-white border-2 border-forest-900 shadow-xl flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-lime-300 text-forest-950 flex items-center justify-center font-black text-2xl group-hover:scale-110 transition-all">
                            🌾
                        </div>
                        <span class="text-xs font-black uppercase tracking-wider text-lime-300 block">
                            Refleksi & Penguatan Makna
                        </span>
                        <h3 class="font-display font-black text-xl text-white">
                            Nilai Kearifan Lokal
                        </h3>
                        <p class="text-slate-200 text-sm leading-relaxed">
                            Mengintegrasikan falsafah luhur budaya Indonesia sebagai sumber daya lentur batin, ketenangan diri, peneguh identitas, dan perekat dukungan sosial yang kontekstual.
                        </p>
                    </div>
                    <div class="pt-6 border-t border-forest-800 mt-6 flex items-center gap-2 text-xs font-extrabold text-lime-300">
                        <span>Pilar Akar Nusantara</span>
                        <span>✦</span>
                    </div>
                </div>

                {{-- Komponen 3: Ryff Well-Being --}}
                <div class="p-7 sm:p-8 rounded-3xl bg-white border-2 border-emerald-200 hover:border-emerald-500 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-teal-100 text-teal-900 flex items-center justify-center font-black text-2xl group-hover:scale-110 group-hover:bg-teal-600 group-hover:text-white transition-all">
                            ✨
                        </div>
                        <span class="text-xs font-black uppercase tracking-wider text-teal-700 block">
                            Orientasi Hasil Perkembangan
                        </span>
                        <h3 class="font-display font-black text-xl text-forest-950">
                            Model Carol D. Ryff
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Mendorong pengembangan 6 dimensi kesejahteraan psikologis: penerimaan diri, relasi positif, otonomi, penguasaan lingkungan, tujuan hidup, dan pertumbuhan pribadi.
                        </p>
                    </div>
                    <div class="pt-6 border-t border-slate-100 mt-6 flex items-center gap-2 text-xs font-extrabold text-teal-800">
                        <span>Pilar Kesejahteraan Utuh</span>
                        <span>✦</span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- Wavy Transition --}}
    <div class="w-full overflow-hidden leading-none text-emerald-950 bg-white -mb-px">
        <svg class="relative block w-full h-12 sm:h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,90 350,-40 500,60 C650,160 900,10 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
        </svg>
    </div>

    {{-- ======================================================================
         4. SECTION: RUANG TUMBUH DIKEMBANGKAN UNTUK (7 TUJUAN UTAMA)
         ====================================================================== --}}
    <section id="tujuan" class="bg-emerald-950 text-white py-16 sm:py-24 px-4 sm:px-8 lg:px-12 relative overflow-hidden">
        
        <div class="max-w-7xl mx-auto space-y-12 relative z-10">
            
            <div class="max-w-3xl space-y-3">
                <span class="inline-block px-4 py-1.5 rounded-full bg-lime-300 text-forest-950 text-xs font-black uppercase tracking-wider">
                    Fokus & Komitmen Layanan
                </span>
                <h2 class="font-display font-black text-3xl sm:text-5xl text-white tracking-tight">
                    RUANG TUMBUH Dikembangkan Untuk:
                </h2>
                <p class="text-emerald-200 text-base sm:text-lg">
                    Tujuh tujuan utama platform dalam mendampingi remaja mengatasi beban psikologis dan menemukan kembali arah hidup yang bermakna.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                
                @php
                    $tujuanCards = [
                        [
                            'icon' => '🎯',
                            'title' => 'Memahami Pikiran & Emosi',
                            'desc' => 'Memfasilitasi remaja memahami pikiran, emosi, dan perilaku yang muncul ketika menghadapi masalah hidup yang berat.'
                        ],
                        [
                            'icon' => '🔍',
                            'title' => 'Mengevaluasi Keyakinan Irasional',
                            'desc' => 'Membantu remaja mengenali dan mengevaluasi keyakinan yang tidak rasional atau tidak membantu perkembangan diri.'
                        ],
                        [
                            'icon' => '🌱',
                            'title' => 'Mengembangkan Keyakinan Rasional',
                            'desc' => 'Mengembangkan keyakinan alternatif yang lebih rasional, fleksibel, dan mendukung kesehatan psikologis jangka panjang.'
                        ],
                        [
                            'icon' => '🌾',
                            'title' => 'Integrasi Nilai Kearifan Lokal',
                            'desc' => 'Mengintegrasikan nilai kearifan lokal sebagai sumber refleksi, dukungan sosial, dan penguatan makna kehidupan.'
                        ],
                        [
                            'icon' => '⭐',
                            'title' => '6 Dimensi Well-Being Ryff',
                            'desc' => 'Mendukung pengembangan enam dimensi psychological well-being Carol D. Ryff secara utuh dan terukur.'
                        ],
                        [
                            'icon' => '💻',
                            'title' => 'Akses Konselor Profesional Daring',
                            'desc' => 'Memfasilitasi kemudahan akses terhadap pendampingan konselor profesional bersertifikat melalui media online.'
                        ],
                        [
                            'icon' => '🛡️',
                            'title' => 'Mengenali Sumber Dukungan Aman',
                            'desc' => 'Membantu remaja mengenali sumber dukungan yang aman dan memperoleh bantuan profesional sesuai tingkat kebutuhannya.'
                        ]
                    ];
                @endphp

                @foreach($tujuanCards as $idx => $t)
                    <div class="p-6 rounded-3xl bg-forest-900/80 border border-emerald-500/30 hover:border-lime-300 hover:bg-forest-900 transition-all duration-300 flex flex-col justify-between group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-3xl">{{ $t['icon'] }}</span>
                                <span class="w-8 h-8 rounded-full bg-white/10 text-lime-300 flex items-center justify-center font-black text-xs">
                                    {{ $idx + 1 }}
                                </span>
                            </div>
                            <h3 class="font-display font-black text-lg text-white group-hover:text-lime-200 transition-colors">
                                {{ $t['title'] }}
                            </h3>
                            <p class="text-slate-300 text-sm leading-relaxed">
                                {{ $t['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>

    {{-- Wavy Transition --}}
    <div class="w-full overflow-hidden leading-none text-emerald-950 bg-[#F0FDF4] -mb-px">
        <svg class="relative block w-full h-12 sm:h-16 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,90 350,-40 500,60 C650,160 900,10 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
        </svg>
    </div>

    {{-- ======================================================================
         5. SECTION: KEUNGGULAN DAN KARAKTERISTIK MODEL (6 KARAKTERISTIK)
         ====================================================================== --}}
    <section id="karakteristik" class="bg-[#F0FDF4] py-16 sm:py-24 px-4 sm:px-8 lg:px-12 relative">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-200/80 text-forest-950 text-xs font-black uppercase tracking-wider">
                    Nilai Pembeda Platform
                </span>
                <h2 class="font-display font-black text-3xl sm:text-5xl text-forest-950 tracking-tight">
                    Keunggulan & Karakteristik Model
                </h2>
                <p class="text-slate-600 text-base sm:text-lg">
                    RUANG TUMBUH memiliki karakteristik utama yang membedakannya sebagai ekosistem konseling yang holistik dan ramah remaja.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- 1. Berbasis Teori --}}
                <div class="p-7 rounded-3xl bg-white border-2 border-emerald-100 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xl mb-4">
                        📘
                    </div>
                    <h3 class="font-display font-black text-xl text-forest-950 mb-2">Berbasis Teori</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Mengintegrasikan REBT sebagai mekanisme perubahan dan model <em>psychological well-being</em> Ryff sebagai orientasi hasil perkembangan.
                    </p>
                </div>

                {{-- 2. Peka Budaya --}}
                <div class="p-7 rounded-3xl bg-white border-2 border-emerald-100 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-lime-100 text-forest-900 flex items-center justify-center font-bold text-xl mb-4">
                        🌺
                    </div>
                    <h3 class="font-display font-black text-xl text-forest-950 mb-2">Peka Budaya</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Memanfaatkan kearifan lokal secara kontekstual, reflektif, dan menghargai keberagaman pengalaman unik setiap remaja.
                    </p>
                </div>

                {{-- 3. Berorientasi Kekuatan --}}
                <div class="p-7 rounded-3xl bg-white border-2 border-emerald-100 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-800 flex items-center justify-center font-bold text-xl mb-4">
                        💪
                    </div>
                    <h3 class="font-display font-black text-xl text-forest-950 mb-2">Berorientasi Kekuatan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Membantu remaja mengenali kemampuan diri, sumber dukungan, dan kemungkinan perubahan tanpa menyalahkan diri atas kesulitan yang dialami.
                    </p>
                </div>

                {{-- 4. Media Online Fleksibel --}}
                <div class="p-7 rounded-3xl bg-white border-2 border-emerald-100 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xl mb-4">
                        📱
                    </div>
                    <h3 class="font-display font-black text-xl text-forest-950 mb-2">Menggunakan Media Online</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Memperluas peluang akses informasi dan pendampingan, dengan tetap menjaga privasi, keamanan digital, dan etika layanan jarak jauh.
                    </p>
                </div>

                {{-- 5. Mengutamakan Keselamatan --}}
                <div class="p-7 rounded-3xl bg-white border-2 border-emerald-100 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-800 flex items-center justify-center font-bold text-xl mb-4">
                        🚨
                    </div>
                    <h3 class="font-display font-black text-xl text-forest-950 mb-2">Mengutamakan Keselamatan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Mengintegrasikan asesmen risiko, perencanaan keselamatan (*safety planning*), dukungan sosial aman, dan rujukan profesional sesuai kebutuhan.
                    </p>
                </div>

                {{-- 6. Perkembangan Berkelanjutan --}}
                <div class="p-7 rounded-3xl bg-white border-2 border-emerald-100 hover:border-emerald-500 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xl mb-4">
                        🚀
                    </div>
                    <h3 class="font-display font-black text-xl text-forest-950 mb-2">Perkembangan Berkelanjutan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Menekankan proses belajar mandiri, refleksi, penerapan keterampilan koping, dan tindak lanjut sesuai kebutuhan unik setiap individu.
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- ======================================================================
         6. SECTION: LANGKAH MENGAKSES LAYANAN (8 ALUR PRAKTIS)
         ====================================================================== --}}
    <section id="langkah" class="bg-white py-16 sm:py-24 px-4 sm:px-8 lg:px-12 relative">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-forest-900 text-xs font-black uppercase tracking-wider">
                    Panduan Alur Konseli
                </span>
                <h2 class="font-display font-black text-3xl sm:text-5xl text-forest-950 tracking-tight">
                    Langkah Mengakses Layanan Ruang Tumbuh
                </h2>
                <p class="text-slate-600 text-base sm:text-lg">
                    Ikuti 8 langkah mudah berikut untuk memulai perjalanan bimbingan dan konseling terpadu kamu.
                </p>
            </div>

            @php
                $langkahLayanan = [
                    ['step' => '1', 'title' => 'Register Akun Konseli', 'desc' => 'Silakan lakukan pendaftaran akun baru melalui halaman register dengan data yang valid dan aman.', 'action' => 'Daftar Akun', 'link' => route('register')],
                    ['step' => '2', 'title' => 'Masuk Melalui Menu Log-in', 'desc' => 'Gunakan akun yang telah didaftarkan untuk masuk ke dalam dasbor pribadi Ruang Tumbuh kamu.', 'action' => 'Masuk Akun', 'link' => route('login')],
                    ['step' => '3', 'title' => 'Memilih Konselor Pendamping', 'desc' => 'Pilih praktisi konselor profesional yang tersedia sesuai kenyamanan dan kebutuhan bimbinganmu.', 'action' => 'Pilih Konselor', 'link' => route('register')],
                    ['step' => '4', 'title' => 'Mengisi Instrumen Awal (Pre-Test)', 'desc' => 'Mengisi instrumen Well-Being dan Ide Bunuh Diri sebelum sesi konseling untuk memetakan kondisi awal.', 'action' => 'Isi Instrumen', 'link' => route('register')],
                    ['step' => '5', 'title' => 'Penjadwalan Konseling', 'desc' => 'Melakukan penjadwalan sesi konseling tatap maya (Meet / Zoom) bersama konselor yang telah dipilih.', 'action' => 'Atur Jadwal', 'link' => route('register')],
                    ['step' => '6', 'title' => 'Pengisian Jurnal Refleksi', 'desc' => 'Menuliskan lembar refleksi pribadi setiap kali selesai mengikuti sesi konseling online.', 'action' => 'Isi Refleksi', 'link' => route('register')],
                    ['step' => '7', 'title' => 'Mengisi Instrumen Akhir (Post-Test)', 'desc' => 'Mengisi instrumen Well-Being dan Ide Bunuh Diri sesudah rangkaian sesi untuk mengukur kemajuan diri.', 'action' => 'Asesmen Akhir', 'link' => route('register')],
                    ['step' => '8', 'title' => 'Evaluasi dan Tindak Lanjut', 'desc' => 'Melihat komparasi grafik pertumbuhan diri serta arahan rekomendasi tindak lanjut dari konselor.', 'action' => 'Lihat Evaluasi', 'link' => route('register')],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($langkahLayanan as $l)
                    <div class="p-6 rounded-3xl bg-slate-50/80 border-2 border-emerald-100 hover:border-emerald-500 hover:bg-white hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                        <div class="space-y-3">
                            <div class="w-10 h-10 rounded-2xl bg-forest-800 text-white font-black text-sm flex items-center justify-center shadow-sm group-hover:bg-emerald-600 transition-colors">
                                {{ $l['step'] }}
                            </div>
                            <h3 class="font-display font-black text-lg text-forest-950">
                                {{ $l['title'] }}
                            </h3>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                {{ $l['desc'] }}
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-200/80">
                            <a href="{{ $l['link'] }}" class="text-xs font-bold text-forest-800 group-hover:text-emerald-700 flex items-center justify-between">
                                <span>{{ $l['action'] }}</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Playful Wavy Action Banner --}}
            <div class="p-8 sm:p-10 rounded-[2.5rem] bg-gradient-to-r from-forest-950 via-forest-900 to-emerald-900 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
                <div class="space-y-2 text-center md:text-left">
                    <span class="text-xs font-black uppercase tracking-wider text-lime-300">Siap Melangkah Maju?</span>
                    <h3 class="font-display font-black text-2xl sm:text-3xl text-white">Mulailah Dari Langkah Pertama Sekarang</h3>
                    <p class="text-emerald-200 text-sm max-w-xl">Pendaftaran mudah, gratis, dan kamu langsung terhubung dengan sistem bimbingan konseling.</p>
                </div>
                <a href="{{ route('register') }}" class="btn-lime py-4 px-8 text-base rounded-2xl flex-shrink-0 shadow-lg shadow-lime-400/20">
                    Daftar Akun Sekarang &rarr;
                </a>
            </div>

        </div>
    </section>

    {{-- ======================================================================
         7. SECTION: TENTANG MODEL & FONDASI RISET
         ====================================================================== --}}
    <section class="bg-[#F8FCF8] py-16 sm:py-24 px-4 sm:px-8 lg:px-12 relative border-t border-emerald-100">
        <div class="max-w-5xl mx-auto space-y-8">
            
            <div class="space-y-4">
                <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-forest-950 text-xs font-black uppercase tracking-wider">
                    Tujuan & Signifikansi
                </span>
                <h2 class="font-display font-black text-3xl sm:text-4xl text-forest-950 tracking-tight">
                    Tentang Model Ruang Tumbuh
                </h2>
            </div>

            <div class="bg-white p-8 sm:p-12 rounded-[2.5rem] border-2 border-emerald-100 shadow-sm space-y-6 text-slate-700 text-base sm:text-lg leading-relaxed font-medium">
                <p>
                    Model ini ditujukan terutama untuk mendukung remaja yang mengalami <strong>tekanan emosional, perasaan tidak berharga, kesulitan menghadapi masalah, kehilangan arah hidup, maupun pikiran tentang mengakhiri hidup</strong>.
                </p>
                <p>
                    RUANG TUMBUH bukan sekadar ruang untuk menceritakan masalah, melainkan juga ruang untuk memahami diri, meninjau kembali cara berpikir, membangun strategi menghadapi kesulitan, dan mengembangkan hubungan yang lebih sehat dengan diri sendiri maupun orang lain.
                </p>
                <div class="p-6 rounded-2xl bg-emerald-50 border-l-4 border-emerald-600 text-forest-950 font-bold text-base leading-relaxed">
                    Melalui platform Ruang Tumbuh yang merupakan implikasi dari <em>Konstruksi Model Teoritis Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri</em> diharapkan dapat mencegah permasalahan terkait dengan kesehatan mental dan menjadi pribadi yang memiliki kesehatan mental yang baik.
                </div>
            </div>

        </div>
    </section>

    {{-- ======================================================================
         8. SECTION: TENTANG PENGEMBANG (7 AKADEMISI & PENELITI)
         ====================================================================== --}}
    <section id="pengembang" class="bg-white py-16 sm:py-24 px-4 sm:px-8 lg:px-12 border-t border-slate-100">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-forest-900 text-xs font-black uppercase tracking-wider">
                    Tim Akademisi Ahli
                </span>
                <h2 class="font-display font-black text-3xl sm:text-5xl text-forest-950 tracking-tight">
                    Tentang Pengembang
                </h2>
                <p class="text-slate-600 text-base sm:text-lg">
                    Platform dan instrumen teoritis ini dikembangkan oleh tim pakar bimbingan konseling dan psikologi pendidikan terkemuka.
                </p>
            </div>

            @php
                $pengembangList = [
                    ['name' => 'Prof. Dr. M. Ramli, M.A', 'role' => 'Guru Besar Bimbingan & Konseling', 'inst' => 'Universitas Negeri Malang', 'slug' => 'ramli'],
                    ['name' => 'Prof. Dr. Juntika Nurihsan, M.Pd', 'role' => 'Guru Besar Bimbingan & Konseling', 'inst' => 'Universitas Pendidikan Indonesia', 'slug' => 'juntika-nurihsan'],
                    ['name' => 'Prof. Dr. Zadrian Ardi, S.Pd., M.Pd., Kons', 'role' => 'Guru Besar Bimbingan & Konseling', 'inst' => 'Universitas Negeri Padang', 'slug' => 'zadrian-ardi'],
                    ['name' => 'Prof. Dr. Nur Hidayah, M.Pd', 'role' => 'Guru Besar Bimbingan & Konseling', 'inst' => 'Universitas Negeri Malang', 'slug' => 'nur-hidayah'],
                    ['name' => 'Dr. Nur Mega Aris Saputra, S.Pd., M.Pd', 'role' => 'Dosen & Peneliti Utama', 'inst' => 'Universitas Negeri Malang', 'slug' => 'aris-saputra'],
                    ['name' => 'Dr. Juwanto, S.Pd.I., M.Pd', 'role' => 'Dosen & Pengembang Model', 'inst' => 'Universitas Prof. Dr. Hazarin, S.H. (UNIHAZ) Bengkulu', 'slug' => 'juwanto'],
                    ['name' => 'Ade Herdian Putra, S.Pd., M.Pd. Kons', 'role' => 'Konselor & Pengembang Layanan', 'inst' => 'Universitas Negeri Padang', 'slug' => 'ade-herdian'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($pengembangList as $p)
                    @php
                        $photoFound = null;
                        foreach (['png', 'jpg', 'jpeg', 'webp'] as $ext) {
                            $path = 'image/team/' . $p['slug'] . '.' . $ext;
                            if (file_exists(public_path($path))) {
                                $photoFound = asset($path);
                                break;
                            }
                        }
                    @endphp
                    <div class="p-6 rounded-3xl bg-slate-50 border-2 border-emerald-100/90 hover:border-emerald-500 hover:bg-emerald-50/40 hover:shadow-md transition-all duration-300 space-y-4 flex flex-col justify-between group">
                        <div class="space-y-4">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden bg-gradient-to-tr from-emerald-600 to-forest-800 text-white font-black text-xl flex items-center justify-center shadow-md flex-shrink-0 border-2 border-emerald-200/50 group-hover:scale-105 transition-transform duration-300">
                                @if($photoFound)
                                    <img src="{{ $photoFound }}" alt="Foto {{ $p['name'] }}" class="w-full h-full object-cover object-top">
                                @else
                                    <span>{{ strtoupper(substr(preg_replace('/^(Prof\.|Dr\.|M\.|Muh\.)\s*/i', '', $p['name']), 0, 2)) }}</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-display font-bold text-base text-forest-950 leading-snug group-hover:text-emerald-800 transition-colors">
                                    {{ $p['name'] }}
                                </h3>
                                <p class="text-xs font-bold text-emerald-700 mt-1">
                                    {{ $p['role'] }}
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    {{ $p['inst'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- University Logos Consortium --}}
            <div class="pt-8 flex flex-wrap items-center justify-center gap-8 sm:gap-12 opacity-80">
                <img src="{{ asset('image/logo/Diktisaintek.png') }}" alt="Diktisaintek" class="h-12 w-auto object-contain">
            <img src="{{ asset('image/logo/logo-um.webp') }}" alt="UM" class="h-12 w-auto object-contain">
                <img src="{{ asset('image/logo/logo-upi.webp') }}" alt="UNP" class="h-12 w-auto object-contain">
                <img src="{{ asset('image/logo/logo-unihaz.jpg') }}" alt="UNY" class="h-12 w-auto object-contain">
                <img src="{{ asset('image/logo/logo-unp.png') }}" alt="UNY" class="h-12 w-auto object-contain">
            </div>

        </div>
    </section>

    {{-- ======================================================================
         9. FOOTER & KONTAK RESMI
         ====================================================================== --}}
    <footer class="bg-forest-950 text-white pt-16 pb-24 sm:pb-16 px-4 sm:px-8 lg:px-12 border-t border-forest-900">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                {{-- Brand & Deskripsi --}}
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white p-0.5">
                            <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="Ruang Tumbuh" class="w-full h-full rounded-lg object-cover">
                        </div>
                        <span class="font-display font-black text-2xl text-white tracking-tight">RUANG TUMBUH</span>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Konstruksi Model Teoritis Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri.
                    </p>
                    <div class="pt-2">
                        <span class="inline-block px-3 py-1 rounded-full bg-emerald-900/80 text-emerald-200 text-xs font-bold border border-emerald-700/50">
                            Fakultas Ilmu Pendidikan • Universitas Negeri Malang
                        </span>
                    </div>
                </div>

                {{-- Alamat & Kontak Resmi --}}
                <div class="md:col-span-4 space-y-3 text-sm">
                    <h3 class="font-display font-black text-base text-lime-300 uppercase tracking-wider">Alamat & Kontak</h3>
                    <p class="text-slate-200 font-medium">
                        <strong>Departemen Bimbingan dan Konseling FIP UM</strong><br>
                        Jl. Semarang No 5 Kota Malang, Jawa Timur 65145
                    </p>
                    <p class="text-slate-300 pt-1">
                        <strong>Kontak WhatsApp:</strong> <a href="https://wa.me/6281231750634" target="_blank" class="text-lime-300 hover:underline">+62 812-3175-0634</a><br>
                        <strong>Email:</strong> <a href="mailto:aris.saputra.fip@um.ac.id" class="text-lime-300 hover:underline">aris.saputra.fip@um.ac.id</a>
                    </p>
                </div>

                {{-- Bantuan Darurat 24 Jam --}}
                <div class="md:col-span-3 space-y-3 text-sm">
                    <h3 class="font-display font-black text-base text-rose-300 uppercase tracking-wider">Layanan Darurat 24 Jam</h3>
                    <p class="text-slate-200">
                        Hotline Kemenkes SEJIWA: <strong class="text-white">119 ext 8</strong> (Bebas Pulsa)
                    </p>
                    <p class="text-xs text-slate-400 leading-relaxed pt-1">
                        Jika kamu atau sahabatmu berada dalam kondisi krisis atau bahaya segera, hubungi nomor darurat atau fasilitas kesehatan terdekat.
                    </p>
                </div>

            </div>

            <div class="pt-8 border-t border-forest-900 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} RUANG TUMBUH &bull; Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang. Seluruh hak cipta dilindungi.
            </div>

        </div>
    </footer>

</div>
@endsection
