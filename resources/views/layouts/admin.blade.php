@extends('layouts.base')

@section('body')
<div class="flex min-h-screen bg-[#F0FDF4]/50">
    {{-- Sidebar (Modern Playful Emerald/Forest Admin) --}}
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-emerald-100 text-slate-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-sm flex flex-col justify-between overflow-y-auto">
        <div>
            <div class="flex items-center justify-between gap-3 px-6 py-5 border-b border-emerald-100">
                <div class="flex items-center gap-3 min-w-0">
                    <img src="{{ asset('image/logo-mark.png') }}?v=2" alt="RUANG TUMBUH" class="w-10 h-10 rounded-2xl object-cover shadow-sm border border-emerald-100 flex-shrink-0">
                    <div class="min-w-0">
                        <h1 class="font-display font-black text-lg text-forest-950 leading-tight truncate">RUANG TUMBUH</h1>
                        <p class="text-[10px] font-black text-emerald-700 uppercase tracking-wider truncate">Panel Admin</p>
                    </div>
                </div>
                <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-slate-600 hover:bg-emerald-50 rounded-xl transition-colors" aria-label="Tutup Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="mt-4 px-3 space-y-1 pb-4">
                <a href="{{ route('admin.dashboard') }}" class="nav-rail-item {{ request()->routeIs('admin.dashboard') ? 'active !bg-gradient-to-r !from-emerald-600 !to-forest-800 !text-white shadow-md shadow-emerald-700/20' : 'hover:!bg-emerald-50 hover:!text-emerald-900' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.option-groups.index') }}" class="nav-rail-item {{ request()->routeIs('admin.option-groups.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    Grup Pilihan
                </a>
                <a href="{{ route('admin.questions.index') }}" class="nav-rail-item {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Instrumen Well-Being
                </a>
                <a href="{{ route('admin.interpretations.index') }}" class="nav-rail-item {{ request()->routeIs('admin.interpretations.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                    Interpretasi Skor
                </a>
                <a href="{{ route('admin.counselors.index') }}" class="nav-rail-item {{ request()->routeIs('admin.counselors.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Konselor
                </a>
                <a href="{{ route('admin.tribes.index') }}" class="nav-rail-item {{ request()->routeIs('admin.tribes.*', 'admin.tribes.materials.*', 'admin.materials.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Modul Self-Help
                </a>
                <a href="{{ route('admin.lessons.index') }}" class="nav-rail-item {{ request()->routeIs('admin.lessons.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Manajemen Lesson
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-rail-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen User
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-sand-100 bg-sand-50/70">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-2xl bg-forest-800 text-white flex items-center justify-center text-sm font-bold shadow-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-ink-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-ink-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold text-terra-600 bg-terra-50 hover:bg-terra-100 rounded-xl transition-colors border border-terra-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 min-w-0 lg:ml-64">
        {{-- Top bar --}}
        <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-lg border-b border-sand-200 px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden p-2 rounded-xl hover:bg-sand-100 transition-colors flex-shrink-0" aria-label="Buka Menu">
                        <svg class="w-5 h-5 text-ink-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h2 class="font-serif text-lg sm:text-xl font-normal text-ink-900 truncate">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center flex-wrap gap-2 flex-shrink-0">
                    @yield('header-actions')
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4 p-4 bg-forest-50 border border-forest-200 text-forest-800 rounded-2xl text-sm flex items-center gap-2 animate-fade-in">
            <svg class="w-5 h-5 flex-shrink-0 text-forest-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-4 p-4 bg-terra-50 border border-terra-200 text-terra-800 rounded-2xl text-sm flex items-center gap-2 animate-fade-in">
            <svg class="w-5 h-5 flex-shrink-0 text-terra-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        {{-- Content --}}
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>
</div>

{{-- Overlay for mobile & tablet sidebar --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-ink-950/40 backdrop-blur-sm z-20 hidden lg:hidden" onclick="toggleAdminSidebar()"></div>

<script>
    function toggleAdminSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        if (!sidebar || !overlay) return;
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>
@endsection
