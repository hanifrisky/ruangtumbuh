<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ruang Tumbuh') }} - @yield('title', 'Ruang Bertumbuh')</title>
    <meta name="description" content="@yield('description', 'Konstruksi Model Teoritis Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri.')">
    <link rel="icon" href="{{ asset('image/logo-mark.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-slate-800 min-h-screen selection:bg-emerald-100 selection:text-forest-900" x-data="{ crisisModalOpen: false, breathingGuide: false }">
    @yield('body')

    {{-- ======================================================================
         LAPIS KESELAMATAN GLOBAL: FLOATING CRISIS & EMERGENCY PILL
         ====================================================================== --}}
    <div class="fixed bottom-20 md:bottom-6 right-4 sm:right-6 z-40 flex items-center gap-2 print:hidden">
        <button type="button"
                @click="crisisModalOpen = true"
                class="group inline-flex items-center gap-2.5 px-4 py-2.5 sm:px-5 sm:py-3 rounded-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-black tracking-wide shadow-[0_10px_25px_-4px_rgba(225,29,72,0.4)] hover:shadow-[0_14px_30px_-4px_rgba(225,29,72,0.55)] transition-all duration-300 active:scale-95 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2"
                aria-label="Bantuan Krisis & Darurat 24 Jam">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-200 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
            </span>
            <span>Butuh Bantuan Segera?</span>
        </button>
    </div>

    {{-- Modal Bantuan Krisis & Ruang Tenang --}}
    <div x-show="crisisModalOpen"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-forest-950/70 backdrop-blur-sm animate-fade-in print:hidden"
         @keydown.escape.window="crisisModalOpen = false">
        <div @click.outside="crisisModalOpen = false"
             class="w-full max-w-lg bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden animate-slide-up">
            {{-- Header in Deep Green (30% Green) --}}
            <div class="p-6 bg-gradient-to-br from-forest-900 via-forest-850 to-forest-800 text-white relative">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-emerald-200 text-[11px] font-black uppercase tracking-wider mb-2">
                            Ruang Teduh & Bantuan Darurat
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black leading-snug">Kamu Tidak Sendirian. Kehadiranmu Berharga.</h3>
                    </div>
                    <button type="button" @click="crisisModalOpen = false" class="p-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white transition-colors" aria-label="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <p class="text-xs sm:text-sm text-emerald-100 mt-2 leading-relaxed font-normal">
                    Jika pikiranmu terasa begitu berat, mari tarik napas sejenak. Kamu berhak merasa aman, didengar, dan mendapatkan pertolongan tanpa penghakiman.
                </p>
            </div>

            {{-- Body (60% White) --}}
            <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto bg-white">
                {{-- Kearifan Lokal Box --}}
                <div class="p-4 rounded-2xl bg-emerald-50/80 border border-emerald-200/90 flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-forest-700 text-white flex items-center justify-center flex-shrink-0 font-bold text-lg">
                        ✦
                    </div>
                    <div class="text-xs text-forest-950 leading-relaxed">
                        <p class="font-black uppercase tracking-wider text-forest-800 mb-0.5">Petuah Bijak Nusantara</p>
                        <p><em>&ldquo;Urip iku urup — Hidup itu menyala dan memberi arti.&rdquo;</em> Setiap tunas memerlukan jeda dan tanah yang subur sebelum kembali bertumbuh. Mari ambil jeda tenang sejenak.</p>
                    </div>
                </div>

                {{-- Direct Emergency Contacts --}}
                <div class="space-y-2.5">
                    <p class="text-[11px] font-black uppercase tracking-wider text-slate-500">Saluran Bantuan Langsung (1-Klik)</p>

                    <a href="https://wa.me/6281231750634?text=Halo%20Konselor%20Ruang%20Tumbuh%2C%20saya%20membutuhkan%20bantuan%20pendampingan%20segera."
                       target="_blank"
                       class="flex items-center justify-between gap-3 p-4 rounded-2xl bg-forest-50 hover:bg-forest-100/80 border-2 border-forest-200 transition-all group">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-forest-700 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-black text-forest-950">WhatsApp Tim Konselor BK FIP UM</p>
                                <p class="text-xs text-forest-700 font-semibold">+62 812-3175-0634 • Aman, Rahasia, & Tanggap</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-forest-700 group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>

                    <a href="tel:119"
                       class="flex items-center justify-between gap-3 p-4 rounded-2xl bg-rose-50 hover:bg-rose-100/80 border-2 border-rose-200 transition-all group">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-black text-rose-950">Hotline Kesehatan Jiwa Kemenkes (119 ext 8)</p>
                                <p class="text-xs text-rose-700 font-semibold">Layanan Darurat Krisis 24 Jam Bebas Pulsa (SEJIWA)</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-rose-700 group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>

                {{-- Footer Actions: Quick Exit & Close --}}
                <div class="pt-3 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-2.5">
                    <a href="https://www.google.com"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors"
                       title="Tutup halaman ini secara cepat demi privasi Anda">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                        Tutup Cepat (Privasi)
                    </a>
                    <button type="button"
                            @click="crisisModalOpen = false"
                            class="w-full sm:w-auto btn-primary py-2.5 px-5 text-xs font-bold">
                        Kembali ke Ruang Tumbuh
                    </button>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
