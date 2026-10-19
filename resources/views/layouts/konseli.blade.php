@extends('layouts.base')

@section('body')
<div class="min-h-screen flex bg-[#F0FDF4]/50 text-slate-800">
    {{-- ======================================================================
         DESKTOP LEFT NAVIGATION RAIL (Modern Playful Green Theme)
         ====================================================================== --}}
    <aside class="hidden lg:flex lg:flex-col lg:w-72 bg-white border-r border-emerald-100 p-6 justify-between fixed inset-y-0 z-30 shadow-[4px_0_24px_rgba(6,78,59,0.04)]">
        <div class="space-y-6">
            {{-- Brand Logo --}}
            <a href="{{ route('konseli.dashboard') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="RUANG TUMBUH" class="w-11 h-11 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform flex-shrink-0">
                <div>
                    <span class="font-display font-black text-xl text-forest-950 leading-none block">RUANG TUMBUH</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-700 block mt-1">Portal Siswa Konseli</span>
                </div>
            </a>

            {{-- Navigation Rail Menu --}}
            <nav class="space-y-1.5 pt-2">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-3 block mb-2">Navigasi Layanan</span>

                <a href="{{ route('konseli.dashboard') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.dashboard') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda & Alur</span>
                </a>

                <a href="{{ route('konseli.counselor.index') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.counselor.*') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Pilih Konselor</span>
                </a>

                <a href="{{ route('konseli.wellbeing.index') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.wellbeing.*') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Asesmen Well-Being</span>
                </a>

                <a href="{{ route('konseli.counseling.index') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.counseling.*') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Chat & Jadwal Meet</span>
                </a>

                <a href="{{ route('konseli.reflection.index') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.reflection.*') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Jurnal Refleksi</span>
                </a>

                <a href="{{ route('konseli.evaluation.index') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.evaluation.*') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                    <span>Evaluasi Diri</span>
                </a>

                @if(!empty($hasLessons))
                <a href="{{ route('konseli.lessons.index') }}"
                   class="nav-rail-item {{ request()->routeIs('konseli.lessons.*') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Materi Pembelajaran</span>
                </a>
                @endif
            </nav>
        </div>

        {{-- Bottom Profile & Logout --}}
        <div class="pt-4 border-t border-emerald-100 space-y-3">
            <div class="flex items-center gap-3 p-3 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-forest-800 text-white font-black flex items-center justify-center text-sm flex-shrink-0 shadow-xs">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-black text-forest-950 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-emerald-800 font-bold truncate">Siswa Konseli</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    {{-- ======================================================================
         MAIN CONTENT AREA
         ====================================================================== --}}
    <div class="flex-1 lg:ml-72 flex flex-col min-h-screen">
        {{-- Mobile Top Bar --}}
        <header class="lg:hidden sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-emerald-100 px-4 py-3 flex items-center justify-between">
            <a href="{{ route('konseli.dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="RUANG TUMBUH" class="w-8 h-8 rounded-xl object-cover">
                <span class="font-display font-black text-forest-950 text-base">RUANG TUMBUH</span>
            </a>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-forest-950 max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-rose-600 px-2 py-1">Keluar</button>
                </form>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="max-w-5xl mx-auto w-full px-4 sm:px-6 mt-4 animate-fade-in">
            <div class="p-4 bg-emerald-50 border-2 border-emerald-200 text-emerald-800 rounded-2xl text-xs sm:text-sm font-semibold flex items-center gap-3">
                <div class="w-6 h-6 rounded-lg bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 text-xs">✓</div>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="max-w-5xl mx-auto w-full px-4 sm:px-6 mt-4 animate-fade-in">
            <div class="p-4 bg-rose-50 border-2 border-rose-200 text-rose-800 rounded-2xl text-xs sm:text-sm font-semibold flex items-center gap-3">
                <div class="w-6 h-6 rounded-lg bg-rose-600 text-white flex items-center justify-center flex-shrink-0 text-xs">✕</div>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        {{-- Workspace Content --}}
        <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pb-28 lg:pb-12">
            @yield('content')
        </main>
    </div>

    {{-- ======================================================================
         MOBILE FLOATING BOTTOM DOCK
         ====================================================================== --}}
    <nav class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-xl border-t border-slate-200 lg:hidden z-30 safe-bottom shadow-[0_-4px_24px_rgba(6,78,59,0.06)]">
        <div class="grid {{ !empty($hasLessons) ? 'grid-cols-7' : 'grid-cols-6' }} gap-0.5 px-1 py-1.5 max-w-lg mx-auto">
            <a href="{{ route('konseli.dashboard') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.dashboard') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Beranda</span>
            </a>
            <a href="{{ route('konseli.counselor.index') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.counselor.*') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Konselor</span>
            </a>
            <a href="{{ route('konseli.wellbeing.index') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.wellbeing.*') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Asesmen</span>
            </a>
            <a href="{{ route('konseli.counseling.index') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.counseling.*') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                <span>Chat</span>
            </a>
            <a href="{{ route('konseli.reflection.index') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.reflection.*') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Refleksi</span>
            </a>
            <a href="{{ route('konseli.evaluation.index') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.evaluation.*') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                <span>Evaluasi</span>
            </a>
            @if(!empty($hasLessons))
            <a href="{{ route('konseli.lessons.index') }}" class="flex flex-col items-center justify-center gap-1 min-h-[48px] rounded-xl text-[10px] font-bold {{ request()->routeIs('konseli.lessons.*') ? 'text-forest-800 bg-forest-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Materi</span>
            </a>
            @endif
        </div>
    </nav>
</div>
@endsection
