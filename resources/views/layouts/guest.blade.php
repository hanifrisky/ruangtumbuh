<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ruang Tumbuh') }} - Masuk & Daftar</title>

        <link rel="icon" href="{{ asset('image/logo-mark.png') }}?v=2" type="image/png">
        <!-- Fonts: Archivo & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,100..900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F0FDF4] text-slate-800 min-h-screen selection:bg-emerald-100 selection:text-forest-900">
        <div class="min-h-screen flex flex-col lg:flex-row">
            {{-- Left Split Screen: Modern Energetic Green Brand Container --}}
            <div class="hidden lg:flex lg:w-5/12 bg-gradient-to-br from-forest-950 via-forest-900 to-emerald-950 text-white p-10 xl:p-12 flex-col justify-between relative overflow-hidden">
                {{-- Decorative Wavy Glow Blobs --}}
                <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-emerald-400/20 blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/2 -right-20 w-80 h-80 rounded-full bg-lime-400/15 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 left-10 w-72 h-72 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>

                {{-- Top Brand --}}
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-3 group">
                        <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="RUANG TUMBUH" class="w-12 h-12 rounded-2xl object-cover bg-white shadow-lg shadow-black/20 group-hover:scale-105 transition-transform">
                        <div>
                            <span class="font-display font-black text-2xl text-white block leading-tight tracking-tight">RUANG TUMBUH</span>
                            <span class="text-[10px] font-extrabold text-emerald-300 uppercase tracking-widest block">BK FIP Universitas Negeri Malang</span>
                        </div>
                    </a>
                </div>

                {{-- Middle Content with Energetic Visual & Mascot --}}
                <div class="relative z-10 space-y-6 my-auto max-w-md py-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-800/80 border border-emerald-600/60 text-emerald-200 text-xs font-black shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-lime-400 animate-pulse"></span>
                        <span>Ruang Konseling & Pertumbuhan Diri</span>
                    </div>

                    <div class="space-y-2">
                        <h2 class="font-display font-black text-3xl xl:text-4xl leading-tight text-white tracking-tight">
                            Tempat Aman untuk Mengurai Beban & Bertumbuh Kembali.
                        </h2>
                        <p class="text-emerald-100/90 text-sm leading-relaxed font-normal">
                            Di sini perasaanmu didengar tanpa penghakiman. Bersama konselor profesional BK FIP UM, temukan kembali harapan, makna, dan kekuatan batinmu.
                        </p>
                    </div>

                    {{-- Energetic Card with Illustration --}}
                    <div class="p-4 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center gap-4 shadow-xl">
                        <img src="{{ asset('image/hero-youth-growth.png') }}" alt="Remaja Ceria" class="w-16 h-16 rounded-2xl object-cover border-2 border-white/30 flex-shrink-0 bg-white">
                        <div class="min-w-0">
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-lime-300 text-forest-950 text-[10px] font-black uppercase tracking-wider mb-1">
                                ✦ Nilai Kearifan Nusantara
                            </span>
                            <p class="text-xs text-white leading-relaxed italic">
                                &ldquo;Urip iku urup — Hidupmu berharga, berdaya, dan menyala.&rdquo;
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Footer Info --}}
                <div class="relative z-10 text-xs text-emerald-200 flex items-center justify-between border-t border-white/10 pt-4 font-semibold">
                    <span>Universitas Negeri Malang</span>
                    <span class="text-lime-300 font-extrabold">100% Aman & Rahasia</span>
                </div>
            </div>

            {{-- Right Split Screen: Modern Playful Form Canvas --}}
            <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-10 lg:p-12 relative bg-gradient-to-b from-[#F0FDF4] via-white to-emerald-50/40">
                
                {{-- Decorative Blobs --}}
                <div class="absolute top-10 right-10 w-64 h-64 bg-emerald-200/25 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-10 left-10 w-72 h-72 bg-lime-200/20 rounded-full blur-3xl pointer-events-none"></div>

                {{-- Mobile Brand Header --}}
                <div class="lg:hidden mb-6 text-center relative z-10">
                    <a href="/" class="inline-flex flex-col items-center gap-2 group">
                        <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="RUANG TUMBUH" class="w-12 h-12 rounded-2xl object-cover bg-white shadow-md">
                        <span class="font-display font-black text-xl text-forest-950 tracking-tight">RUANG TUMBUH</span>
                        <span class="text-[10px] font-extrabold text-emerald-700 uppercase tracking-widest">BK FIP Universitas Negeri Malang</span>
                    </a>
                </div>

                {{-- Form Card --}}
                <div class="w-full max-w-xl bg-white rounded-[2.5rem] border-2 border-emerald-100 p-7 sm:p-10 shadow-2xl shadow-forest-900/10 relative z-10 animate-fade-in">
                    {{ $slot }}
                </div>

                {{-- Return Link --}}
                <div class="mt-6 flex flex-wrap items-center justify-center gap-4 text-xs font-bold text-slate-600 relative z-10">
                    <a href="/" class="hover:text-forest-800 transition-colors flex items-center gap-1.5 py-1 px-3 rounded-full hover:bg-emerald-100/60">
                        <span>&larr;</span>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
