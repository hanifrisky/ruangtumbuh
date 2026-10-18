@extends('layouts.base')

@section('body')
<div class="flex min-h-screen bg-[#F0FDF4]/50 text-slate-800">
    {{-- Counselor Sidebar (Modern Emerald/Forest Container) --}}
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-forest-950 via-forest-900 to-emerald-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl flex flex-col justify-between overflow-y-auto border-r border-forest-900">
        <div>
            <div class="flex items-center justify-between gap-3 px-6 py-5 border-b border-white/10">
                <div class="flex items-center gap-3 min-w-0">
                    <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-10 h-10 rounded-2xl object-cover bg-white shadow-md flex-shrink-0">
                    <div class="min-w-0">
                        <h1 class="font-display font-black text-lg text-white leading-tight truncate">RUANG TUMBUH</h1>
                        <p class="text-[10px] font-black uppercase tracking-widest text-emerald-300 truncate">Panel Konselor</p>
                    </div>
                </div>
                <button type="button" onclick="toggleKonselorSidebar()" class="lg:hidden p-1.5 text-emerald-200 hover:text-white rounded-lg transition-colors" aria-label="Tutup Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="mt-4 px-3 space-y-1.5 pb-4">
                <a href="{{ route('konselor.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('konselor.dashboard') ? 'bg-gradient-to-r from-emerald-600 to-forest-800 text-white shadow-md shadow-emerald-900/30 font-extrabold' : 'text-emerald-100 hover:bg-forest-900 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Dashboard Konseling</span>
                </a>
                <a href="{{ route('konselor.lessons.index') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('konselor.lessons.*') ? 'bg-gradient-to-r from-emerald-600 to-forest-800 text-white shadow-md shadow-emerald-900/30 font-extrabold' : 'text-emerald-100 hover:bg-forest-900 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Manajemen Materi</span>
                </a>
                <a href="{{ route('konselor.profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('konselor.profile.edit') ? 'bg-gradient-to-r from-emerald-600 to-forest-800 text-white shadow-md shadow-emerald-900/30 font-extrabold' : 'text-emerald-100 hover:bg-forest-900 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil Saya</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-white/10 bg-forest-950/60">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl bg-forest-800 text-white font-black flex items-center justify-center text-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-emerald-300 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold text-rose-300 hover:bg-rose-950/40 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area (60% White) --}}
    <div class="flex-1 min-w-0 lg:ml-64">
        {{-- Top Bar --}}
        <header class="sticky top-0 z-20 bg-white/95 backdrop-blur-md border-b border-slate-200 px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    <button type="button" onclick="toggleKonselorSidebar()" class="lg:hidden p-2 rounded-xl hover:bg-slate-100 transition-colors flex-shrink-0" aria-label="Buka Menu">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h2 class="font-sans text-base sm:text-xl font-black text-slate-900 truncate">@yield('page-title', 'Dashboard Konselor')</h2>
                </div>
                <div class="flex items-center flex-wrap gap-2 flex-shrink-0">
                    @yield('header-actions')
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs sm:text-sm font-semibold flex items-center gap-2 animate-fade-in">
            <span>✓ {{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs sm:text-sm font-semibold flex items-center gap-2 animate-fade-in">
            <span>✕ {{ session('error') }}</span>
        </div>
        @endif

        {{-- Content --}}
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>
</div>

{{-- Overlay --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-forest-950/50 backdrop-blur-sm z-20 hidden lg:hidden" onclick="toggleKonselorSidebar()"></div>

<script>
    function toggleKonselorSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        if (!sidebar || !overlay) return;
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>
@endsection
