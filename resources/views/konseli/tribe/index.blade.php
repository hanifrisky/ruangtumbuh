@extends('layouts.konseli')

@section('title', 'Modul Eksplorasi Diri & Self-Help')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    <div class="border-b border-sand-200 pb-5">
        <span class="text-[11px] font-bold uppercase tracking-wider text-forest-700 block mb-1">Kearifan Lokal & Resiliensi Remaja</span>
        <h2 class="font-serif text-2xl sm:text-3xl font-normal text-ink-900">Modul Self-Help Berfokus Solusi</h2>
        <p class="text-sm text-ink-600 mt-1 max-w-2xl font-light">Pilih modul kearifan lokal di bawah ini untuk memulai sesi refleksi terstruktur, membangkitkan kekuatan batin, dan merumuskan langkah nyata menuju masa depan penuh harapan.</p>
    </div>

    @if($tribes->isEmpty())
        <div class="card p-12 text-center bg-white border border-sand-200/80 rounded-3xl">
            <svg class="w-16 h-16 text-sand-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <h4 class="font-serif text-lg font-normal text-ink-800">Belum Ada Modul Self-Help Terdaftar</h4>
            <p class="text-xs text-ink-500 mt-1">Admin sedang menyiapkan modul penguatan kearifan lokal.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tribes as $tribe)
                @php 
                    $isSelected = $tribe->id == $selectedTribeId;
                @endphp
                <div class="card p-7 flex flex-col justify-between bg-white relative transition-all duration-300 rounded-3xl border {{ $isSelected ? 'border-forest-600 ring-2 ring-forest-500/20 shadow-md' : 'border-sand-200/80 hover:border-sand-300 hover:shadow-sm' }}">
                    @if($isSelected)
                        <div class="absolute top-5 right-5 bg-forest-700 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-sage-300 animate-pulse"></span> Modul Aktif
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center justify-between mb-4 {{ $isSelected ? 'pr-24' : '' }}">
                            <span class="bg-forest-50 text-forest-800 text-[11px] px-3 py-1 rounded-full font-bold border border-forest-200 uppercase tracking-wider">
                                Kearifan Lokal
                            </span>
                        </div>
                        
                        <h4 class="font-serif text-xl font-normal text-ink-900 mb-2">{{ $tribe->name }}</h4>
                        <p class="text-xs text-ink-500 font-medium mb-6 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>{{ $tribe->materials_count }} Sesi Refleksi Terstruktur</span>
                        </p>
                    </div>

                    <div class="pt-5 border-t border-sand-100 mt-6">
                        @if($isSelected)
                            <a href="{{ route('konseli.self-help.show', $tribe) }}" class="w-full btn-primary py-3.5 font-bold text-center block text-xs uppercase tracking-wider rounded-2xl shadow-sm">
                                Lanjutkan Sesi Self-Help &rarr;
                            </a>
                        @else
                            <form action="{{ route('konseli.tribe.select', $tribe) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full btn-secondary py-3.5 font-bold text-center text-xs uppercase tracking-wider rounded-2xl">
                                    Pilih & Mulai Modul Ini
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
