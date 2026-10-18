@extends('layouts.konseli')

@section('title', 'Evaluasi dan Tindak Lanjut - Ruang Tumbuh')

@section('content')
@php
    $diff = ($preTest && $postTest) ? ($postTest->total_score - $preTest->total_score) : null;
    $prePercent = $preTest ? min(100, round(($preTest->total_score / 150) * 100)) : 0;
    $postPercent = $postTest ? min(100, round(($postTest->total_score / 150) * 100)) : 0;
@endphp

<div class="space-y-8 animate-fade-in pb-16">
    {{-- Top Hashtags (10% Sky Blue) --}}
    <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-100 text-sky-800 border border-sky-300">
            #Langkah8
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #EvaluasiPertumbuhan
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #TindakLanjutKonseling
        </span>
    </div>

    {{-- Header --}}
    <div class="border-b-2 border-forest-100 pb-5 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 tracking-tight uppercase">
                Evaluasi Pertumbuhan & Tindak Lanjut
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl font-medium">
                Rekapitulasi perkembangan <em>Psychological Well-Being</em> & <em>Ketahanan Diri</em> serta arahan penguatan dari konselor pendampingmu.
            </p>
        </div>
        <a href="{{ route('konseli.dashboard') }}" class="btn-secondary text-xs font-black px-5 py-3 flex-shrink-0 uppercase tracking-wider inline-flex items-center gap-2 border-2 border-slate-300">
            <span>&larr;</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    {{-- Growth Comparison Bar Card (60% White Card) --}}
    <div class="card p-7 sm:p-9 bg-white border-2 border-slate-200 space-y-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-sky-700">Grafik Komparasi Hasil</span>
                <h3 class="font-display text-lg sm:text-xl font-black text-forest-950 mt-0.5 uppercase tracking-tight">Perbandingan Skor Awal vs Sesudah Konseling</h3>
            </div>
            @if(!is_null($diff))
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider {{ $diff >= 0 ? 'bg-forest-100 text-forest-900 border border-forest-300' : 'bg-amber-100 text-amber-900 border border-amber-300' }}">
                    {{ $diff >= 0 ? '▲ Peningkatan +' . $diff . ' Poin' : 'Perubahan ' . $diff . ' Poin' }}
                </span>
            @endif
        </div>

        <div class="space-y-5">
            {{-- Pre-test bar --}}
            <div>
                <div class="flex justify-between text-xs font-black text-slate-700 mb-1.5">
                    <span>Awal Konseling (Pra-Konseling)</span>
                    <span class="text-forest-900">{{ $preTest ? $preTest->total_score . ' / 150 Poin (' . $prePercent . '%)' : 'Belum Diisi' }}</span>
                </div>
                <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-forest-700 rounded-full transition-all duration-700" style="width: {{ $prePercent }}%"></div>
                </div>
            </div>

            {{-- Post-test bar --}}
            <div>
                <div class="flex justify-between text-xs font-black text-slate-700 mb-1.5">
                    <span>Sesudah Konseling (Pasca-Konseling)</span>
                    <span class="text-sky-700">{{ $postTest ? $postTest->total_score . ' / 150 Poin (' . $postPercent . '%)' : 'Belum Diisi' }}</span>
                </div>
                <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-sky-600 rounded-full transition-all duration-700" style="width: {{ $postPercent }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Pre vs Post Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Awal Konseling (Forest Green Accent) --}}
        <div class="card p-6 sm:p-7 bg-white border-2 border-forest-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-black uppercase tracking-wider bg-forest-100 text-forest-900 px-3.5 py-1 rounded-full border border-forest-300">
                        Awal Konseling
                    </span>
                    @if($preTest)
                        <span class="text-xs text-slate-500 font-bold">{{ $preTest->completed_at->format('d M Y') }}</span>
                    @endif
                </div>

                @if($preTest)
                    <div class="p-5 rounded-2xl bg-forest-50/50 border border-forest-200 text-center mb-4">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Skor Awal</span>
                        <p class="font-display text-4xl font-black text-forest-950 mt-1">{{ $preTest->total_score }} <span class="text-xs font-sans font-bold text-slate-400">/ 150</span></p>
                        <p class="text-xs text-slate-600 mt-2 font-medium">
                            Well-Being: <strong class="text-forest-900">{{ $preTest->well_being_score ?? '-' }}</strong> &bull; Harapan Hidup: <strong class="text-forest-900">{{ $preTest->suicide_ideation_score ?? '-' }}</strong>
                        </p>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed font-medium">{{ $preTest->interpretation->description ?? '' }}</p>
                @else
                    <p class="text-sm text-slate-400 py-8 text-center font-medium">Belum mengisi Instrumen Awal Konseling.</p>
                @endif
            </div>

            <div class="mt-5 pt-4 border-t border-slate-100 flex justify-between items-center">
                @if($preTest)
                    <a href="{{ route('konseli.wellbeing.pdf', 'pre_test') }}" target="_blank" class="text-xs font-black text-forest-800 hover:text-forest-950 uppercase tracking-wider inline-flex items-center gap-1">
                        <span>Unduh PDF Awal</span>
                        <span>&rarr;</span>
                    </a>
                @else
                    <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary text-xs py-2 px-4 font-black uppercase tracking-wider">Isi Instrumen Awal</a>
                @endif
            </div>
        </div>

        {{-- Sesudah Konseling (Sky Blue Accent) --}}
        <div class="card p-6 sm:p-7 bg-white border-2 border-sky-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-black uppercase tracking-wider bg-sky-100 text-sky-900 px-3.5 py-1 rounded-full border border-sky-300">
                        Sesudah Konseling
                    </span>
                    @if($postTest)
                        <span class="text-xs text-slate-500 font-bold">{{ $postTest->completed_at->format('d M Y') }}</span>
                    @endif
                </div>

                @if($postTest)
                    <div class="p-5 rounded-2xl bg-sky-50/50 border border-sky-200 text-center mb-4">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Skor Sesudah</span>
                        <div class="flex items-center justify-center gap-2 mt-1">
                            <p class="font-display text-4xl font-black text-sky-950">{{ $postTest->total_score }} <span class="text-xs font-sans font-bold text-slate-400">/ 150</span></p>
                            @if(!is_null($diff))
                                <span class="text-xs font-black px-2.5 py-1 rounded-full {{ $diff >= 0 ? 'bg-forest-100 text-forest-900' : 'bg-amber-100 text-amber-900' }}">
                                    {{ $diff >= 0 ? '+' . $diff : $diff }} Poin
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-600 mt-2 font-medium">
                            Well-Being: <strong class="text-sky-900">{{ $postTest->well_being_score ?? '-' }}</strong> &bull; Harapan Hidup: <strong class="text-sky-900">{{ $postTest->suicide_ideation_score ?? '-' }}</strong>
                        </p>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed font-medium">{{ $postTest->interpretation->description ?? '' }}</p>
                @else
                    <p class="text-sm text-slate-400 py-8 text-center font-medium">Belum mengisi Instrumen Sesudah Konseling.</p>
                @endif
            </div>

            <div class="mt-5 pt-4 border-t border-slate-100 flex justify-between items-center">
                @if($postTest)
                    <a href="{{ route('konseli.wellbeing.pdf', 'post_test') }}" target="_blank" class="text-xs font-black text-sky-800 hover:text-sky-950 uppercase tracking-wider inline-flex items-center gap-1">
                        <span>Unduh PDF Sesudah</span>
                        <span>&rarr;</span>
                    </a>
                @else
                    <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary text-xs py-2 px-4 font-black uppercase tracking-wider">Isi Instrumen Sesudah</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Catatan Evaluasi & Rekomendasi Konselor (Goyang Green Card Style) --}}
    <div class="card p-7 sm:p-9 bg-white border-2 border-forest-300 shadow-sm rounded-3xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5 border-b border-forest-100 pb-4">
            <div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-lime-200 text-forest-950 border border-lime-300">
                    Tindak Lanjut Konselor
                </span>
                <h3 class="font-display text-lg sm:text-xl font-black text-forest-950 mt-1 uppercase tracking-tight">Pesan Penguatan & Rekomendasi Pendampingan</h3>
            </div>
            @if($session && $session->konselor)
                <span class="inline-flex items-center gap-1.5 text-xs font-black text-forest-900 bg-forest-100 px-3.5 py-1.5 rounded-full border border-forest-300">
                    Konselor: {{ $session->konselor->name }}
                </span>
            @endif
        </div>

        @if($session && $session->counselor_evaluation_notes)
            <div class="p-6 rounded-2xl bg-forest-50/50 border-2 border-forest-200 text-sm text-forest-950 leading-relaxed whitespace-pre-line font-medium shadow-xs">
                {{ $session->counselor_evaluation_notes }}
            </div>
        @else
            <div class="p-6 rounded-2xl bg-slate-50 border-2 border-slate-200 text-xs sm:text-sm text-slate-500 leading-relaxed">
                <p class="font-black text-slate-800 mb-1">Menunggu Catatan Evaluasi Konselor</p>
                <p class="font-medium">Konselor pendampingmu sedang meninjau perkembangan skor dan lembar refleksi untuk menyusun pesan penguatan dan rekomendasi tindak lanjut.</p>
            </div>
        @endif
    </div>
</div>
@endsection
