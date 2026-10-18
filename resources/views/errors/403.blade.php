@extends('layouts.base')

@section('title', '403 Akses Dibatasi - Ruang Tumbuh')

@section('body')
<div class="min-h-screen flex items-center justify-center bg-[#FAF7F2] text-ink-900 relative overflow-hidden px-4 select-none">
    
    {{-- Botanical Glow Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-sage-200/40 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-sand-300/40 rounded-full blur-3xl"></div>
    </div>

    {{-- Content Container --}}
    <div class="max-w-md w-full bg-white border border-sand-200 shadow-xl rounded-3xl p-8 sm:p-10 text-center relative z-10 animate-slide-up">
        
        {{-- Brand Logo --}}
        <div class="flex justify-center mb-6">
            <a href="/" class="flex flex-col items-center gap-2 group">
                <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-12 h-12 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform duration-300">
                <span class="font-serif text-sm font-bold text-ink-800 tracking-wider">RUANG TUMBUH</span>
            </a>
        </div>

        {{-- Icon / Graphic --}}
        <div class="relative w-24 h-24 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 bg-terra-100 rounded-full blur-lg opacity-70"></div>
            <div class="absolute inset-0 bg-sand-50 rounded-full border border-sand-200 shadow-inner flex items-center justify-center">
                <svg class="w-10 h-10 text-terra-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>

        {{-- Error Number --}}
        <h1 class="font-serif text-6xl font-normal text-forest-800 tracking-tight mb-2">
            403
        </h1>
        
        {{-- Short Title --}}
        <h2 class="font-serif text-xl font-normal text-ink-900 mb-2">
            Halaman Dibatasi
        </h2>

        {{-- Error Message --}}
        <p class="text-ink-500 text-sm leading-relaxed mb-8 font-light px-2">
            {{ $exception->getMessage() ?: 'Akun Anda tidak memiliki hak akses untuk membuka halaman ini.' }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 items-stretch justify-center">
            <a href="/" class="btn-primary py-3.5 px-6 font-bold text-xs uppercase tracking-wider rounded-2xl text-center">
                Ke Beranda
            </a>
            <button onclick="window.history.length > 1 ? window.history.back() : window.location.href='/'" class="btn-secondary py-3.5 px-6 font-bold text-xs uppercase tracking-wider rounded-2xl">
                Kembali
            </button>
        </div>

    </div>
</div>
@endsection
