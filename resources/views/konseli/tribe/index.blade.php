@extends('layouts.konseli')

@section('title', 'Modul Eksplorasi Diri & Self-Help - Ruang Tumbuh')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    {{-- Top Hashtags (10% Sky Blue) --}}
    <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-100 text-sky-800 border border-sky-300">
            #Langkah4
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #KearifanLokalNusantara
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #SelfHelpBerfokusSolusi
        </span>
    </div>

    {{-- Header --}}
    <div class="border-b-2 border-forest-100 pb-5">
        <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 uppercase tracking-tight">
            Modul Self-Help Berfokus Solusi
        </h2>
        <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl font-medium">
            Pilih modul kearifan lokal di bawah ini untuk memulai sesi refleksi terstruktur, membangkitkan kekuatan batin, dan merumuskan langkah nyata menuju masa depan penuh harapan.
        </p>
    </div>

    @if($tribes->isEmpty())
        <div class="card p-12 text-center bg-white border-2 border-slate-200 rounded-3xl shadow-sm">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight">Belum Ada Modul Self-Help Terdaftar</h4>
            <p class="text-xs text-slate-500 mt-1">Admin sedang menyiapkan modul penguatan kearifan lokal.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tribes as $tribe)
                @php 
                    $isSelected = $tribe->id == $selectedTribeId;
                @endphp
                <div class="card p-7 flex flex-col justify-between bg-white relative transition-all duration-300 rounded-3xl border-2 {{ $isSelected ? 'border-forest-600 ring-4 ring-forest-500/10 shadow-md' : 'border-slate-200 hover:border-forest-300 hover:shadow-sm' }}">
                    @if($isSelected)
                        <div class="absolute top-5 right-5 bg-lime-200 border border-lime-400 text-forest-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider flex items-center gap-1.5 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-forest-800 animate-pulse"></span> Modul Aktif
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center justify-between mb-4 {{ $isSelected ? 'pr-28' : '' }}">
                            <span class="bg-forest-100 text-forest-900 text-[10px] px-3 py-1 rounded-full font-black border border-forest-300 uppercase tracking-wider">
                                Kearifan Nusantara
                            </span>
                        </div>
                        
                        <h4 class="font-display text-xl font-black text-forest-950 mb-2 uppercase tracking-tight">{{ $tribe->name }}</h4>
                        <p class="text-xs text-slate-600 font-bold mb-6 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>{{ $tribe->materials_count }} Sesi Refleksi Terstruktur</span>
                        </p>
                    </div>

                    <div class="pt-5 border-t border-slate-100 mt-6">
                        @if($isSelected)
                            <a href="{{ route('konseli.self-help.show', $tribe) }}" class="w-full btn-primary py-3.5 font-black text-center block text-xs uppercase tracking-wider rounded-2xl shadow-sm">
                                Lanjutkan Sesi Self-Help &rarr;
                            </a>
                        @else
                            <form action="{{ route('konseli.tribe.select', $tribe) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full btn-secondary py-3.5 font-black text-center text-xs uppercase tracking-wider rounded-2xl border-2 border-slate-300 hover:border-forest-600 hover:text-forest-900">
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
