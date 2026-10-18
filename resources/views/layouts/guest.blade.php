<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ruang Tumbuh') }} - Masuk & Daftar</title>

        <link rel="icon" href="{{ asset('image/logo-mark.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-slate-800 min-h-screen selection:bg-emerald-100 selection:text-forest-900">
        <div class="min-h-screen flex flex-col lg:flex-row">
            {{-- Left Split Screen: 30% Green Container (Inspired by Poster Bottom Section) --}}
            <div class="hidden lg:flex lg:w-5/12 bg-gradient-to-br from-forest-950 via-forest-900 to-forest-850 text-white p-12 flex-col justify-between relative overflow-hidden">
                {{-- Decorative Glow Blobs --}}
                <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-3 group">
                        <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-12 h-12 rounded-2xl object-cover bg-white shadow-md group-hover:scale-105 transition-transform">
                        <div>
                            <span class="font-sans font-black text-xl text-white block leading-none">RUANG TUMBUH</span>
                            <span class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest mt-1 block">BK FIP Universitas Negeri Malang</span>
                        </div>
                    </a>
                </div>

                <div class="relative z-10 space-y-6 my-auto max-w-md py-12">
                    {{-- 10% Blue Accent Hashtag Pill --}}
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/20 border border-sky-400/40 text-sky-200 text-xs font-bold tracking-wide">
                        #KearifanLokal &bull; #WellBeingRemaja
                    </div>
                    <h2 class="font-sans text-3xl xl:text-4xl font-black leading-tight text-white tracking-tight">
                        Tempat Aman untuk Mengurai Beban & Bertumbuh Kembali.
                    </h2>
                    <p class="text-emerald-100/90 text-sm leading-relaxed font-light">
                        Di sini, perasaanmu didengar tanpa penghakiman. Bersama konselor profesional BK FIP Universitas Negeri Malang, temukan kembali harapan dan kekuatan batinmu.
                    </p>

                    <div class="p-5 rounded-2xl bg-white/10 border border-white/15 space-y-1.5">
                        <span class="card-program-badge text-[10px]">Petuah Bijak Nusantara</span>
                        <p class="text-xs text-white leading-relaxed pt-1">
                            &ldquo;Urip iku urup — Hidupmu berharga dan menyala. Kamu tidak pernah berjalan sendirian.&rdquo;
                        </p>
                    </div>
                </div>

                <div class="relative z-10 text-xs text-emerald-200 flex items-center justify-between border-t border-white/10 pt-4">
                    <span>Kemendikti Saintek • Universitas Negeri Malang</span>
                    <span class="text-sky-300 font-bold">100% Rahasia & Bebas Biaya</span>
                </div>
            </div>

            {{-- Right Split Screen: 60% White Form Canvas --}}
            <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-10 lg:p-12 relative bg-[#F8FAFC]">
                {{-- Mobile Brand Header --}}
                <div class="lg:hidden mb-6 text-center">
                    <a href="/" class="inline-flex flex-col items-center gap-2 group">
                        <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-12 h-12 rounded-2xl object-cover bg-white shadow-md">
                        <span class="font-sans font-black text-lg text-forest-900 tracking-tight">RUANG TUMBUH</span>
                    </a>
                </div>

                <div class="w-full max-w-lg bg-white rounded-3xl border border-slate-200 p-6 sm:p-9 shadow-xl shadow-slate-200/50 animate-fade-in">
                    {{ $slot }}
                </div>

                <div class="mt-6 flex items-center gap-4 text-xs font-bold text-slate-500">
                    <a href="/" class="hover:text-forest-800 transition-colors flex items-center gap-1">
                        &larr; Kembali ke Beranda
                    </a>
                    <span>&bull;</span>
                    <a href="https://wa.me/6281231750634" target="_blank" class="text-rose-600 hover:text-rose-700 transition-colors">
                        Butuh Bantuan Krisis?
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
