@extends('layouts.konseli')

@section('title', 'Evaluasi dan Tindak Lanjut - Ruang Tumbuh')

@section('content')
@php
    $diff = ($preTest && $postTest) ? ($postTest->total_score - $preTest->total_score) : null;
    $prePercent = $preTest ? min(100, round(($preTest->total_score / 150) * 100)) : 0;
    $postPercent = $postTest ? min(100, round(($postTest->total_score / 150) * 100)) : 0;
@endphp

<div class="space-y-8 animate-fade-in pb-16">
    {{-- Header --}}
    <div class="border-b border-sand-300 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <span class="text-xs font-extrabold uppercase tracking-wider text-terra-600 block mb-1">Langkah 8 Layanan Ruang Tumbuh</span>
            <h2 class="font-display text-2xl font-bold text-ink-900">Evaluasi Pertumbuhan & Catatan Tindak Lanjut</h2>
            <p class="text-xs sm:text-sm text-ink-500 mt-1">
                Rekapitulasi perkembangan <em>Psychological Well-Being</em> & <em>Ketahanan Diri</em> serta pesan tindak lanjut dari konselormu.
            </p>
        </div>
        <a href="{{ route('konseli.dashboard') }}" class="btn-secondary text-xs font-bold px-4 py-2.5 flex-shrink-0">
            &larr; Beranda
        </a>
    </div>

    {{-- Growth Comparison Bar Card --}}
    <div class="card p-7 sm:p-9 bg-white border border-sand-300 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-terra-600">Grafik Pertumbuhan Diri</span>
                <h3 class="font-display text-lg sm:text-xl font-bold text-ink-900 mt-0.5">Perbandingan Skor Awal vs Sesudah Konseling</h3>
            </div>
            @if(!is_null($diff))
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-extrabold {{ $diff >= 0 ? 'bg-sage-100 text-forest-800 border border-sage-300' : 'bg-amber-100 text-amber-800 border border-amber-300' }}">
                    {{ $diff >= 0 ? '▲ Peningkatan +' . $diff . ' Poin' : 'Perubahan ' . $diff . ' Poin' }}
                </span>
            @endif
        </div>

        <div class="space-y-4">
            {{-- Pre-test bar --}}
            <div>
                <div class="flex justify-between text-xs font-extrabold text-ink-700 mb-1.5">
                    <span>Awal Konseling (Pra-Konseling)</span>
                    <span class="text-forest-800">{{ $preTest ? $preTest->total_score . ' / 150 Poin (' . $prePercent . '%)' : 'Belum Diisi' }}</span>
                </div>
                <div class="w-full h-3 bg-sand-200 rounded-full overflow-hidden">
                    <div class="h-full bg-forest-800 rounded-full transition-all duration-700" style="width: {{ $prePercent }}%"></div>
                </div>
            </div>

            {{-- Post-test bar --}}
            <div>
                <div class="flex justify-between text-xs font-extrabold text-ink-700 mb-1.5">
                    <span>Sesudah Konseling (Pasca-Konseling)</span>
                    <span class="text-sage-600">{{ $postTest ? $postTest->total_score . ' / 150 Poin (' . $postPercent . '%)' : 'Belum Diisi' }}</span>
                </div>
                <div class="w-full h-3 bg-sand-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-forest-700 to-sage-500 rounded-full transition-all duration-700" style="width: {{ $postPercent }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Pre vs Post Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Awal Konseling --}}
        <div class="card p-6 bg-white border border-sand-300 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-extrabold uppercase tracking-wider bg-forest-50 text-forest-800 px-3 py-1 rounded-full border border-forest-200">
                        Awal Konseling
                    </span>
                    @if($preTest)
                        <span class="text-xs text-ink-400 font-bold">{{ $preTest->completed_at->format('d M Y') }}</span>
                    @endif
                </div>

                @if($preTest)
                    <div class="p-4 rounded-2xl bg-sand-50 border border-sand-200 text-center mb-4">
                        <span class="text-xs font-bold text-ink-400 uppercase">Total Skor Awal</span>
                        <p class="font-display text-3xl font-bold text-forest-900 mt-1">{{ $preTest->total_score }} <span class="text-xs font-sans font-semibold text-ink-400">/ 150</span></p>
                        <p class="text-xs text-ink-600 mt-1">
                            Well-Being: <strong>{{ $preTest->well_being_score ?? '-' }}</strong> &bull; Harapan Hidup: <strong>{{ $preTest->suicide_ideation_score ?? '-' }}</strong>
                        </p>
                    </div>
                    <p class="text-xs text-ink-600 leading-relaxed">{{ $preTest->interpretation->description ?? '' }}</p>
                @else
                    <p class="text-sm text-ink-400 py-8 text-center">Belum mengisi Instrumen Awal Konseling.</p>
                @endif
            </div>

            <div class="mt-5 pt-4 border-t border-sand-200 flex justify-between items-center">
                @if($preTest)
                    <a href="{{ route('konseli.wellbeing.pdf', 'pre_test') }}" target="_blank" class="text-xs font-bold text-forest-800 hover:text-terra-600">
                        Unduh PDF Awal &rarr;
                    </a>
                @else
                    <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary btn-sm">Isi Instrumen Awal</a>
                @endif
            </div>
        </div>

        {{-- Sesudah Konseling --}}
        <div class="card p-6 bg-white border border-sand-300 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-extrabold uppercase tracking-wider bg-terra-50 text-terra-700 px-3 py-1 rounded-full border border-terra-200">
                        Sesudah Konseling
                    </span>
                    @if($postTest)
                        <span class="text-xs text-ink-400 font-bold">{{ $postTest->completed_at->format('d M Y') }}</span>
                    @endif
                </div>

                @if($postTest)
                    <div class="p-4 rounded-2xl bg-sand-50 border border-sand-200 text-center mb-4">
                        <span class="text-xs font-bold text-ink-400 uppercase">Total Skor Sesudah</span>
                        <div class="flex items-center justify-center gap-2 mt-1">
                            <p class="font-display text-3xl font-bold text-terra-700">{{ $postTest->total_score }} <span class="text-xs font-sans font-semibold text-ink-400">/ 150</span></p>
                            @if(!is_null($diff))
                                <span class="text-xs font-extrabold px-2.5 py-0.5 rounded-full {{ $diff >= 0 ? 'bg-sage-100 text-forest-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $diff >= 0 ? '+' . $diff : $diff }} Poin
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-ink-600 mt-1">
                            Well-Being: <strong>{{ $postTest->well_being_score ?? '-' }}</strong> &bull; Harapan Hidup: <strong>{{ $postTest->suicide_ideation_score ?? '-' }}</strong>
                        </p>
                    </div>
                    <p class="text-xs text-ink-600 leading-relaxed">{{ $postTest->interpretation->description ?? '' }}</p>
                @else
                    <p class="text-sm text-ink-400 py-8 text-center">Belum mengisi Instrumen Sesudah Konseling.</p>
                @endif
            </div>

            <div class="mt-5 pt-4 border-t border-sand-200 flex justify-between items-center">
                @if($postTest)
                    <a href="{{ route('konseli.wellbeing.pdf', 'post_test') }}" target="_blank" class="text-xs font-bold text-terra-700 hover:text-forest-800">
                        Unduh PDF Sesudah &rarr;
                    </a>
                @else
                    <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary btn-sm">Isi Instrumen Sesudah</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Catatan Evaluasi & Rekomendasi Konselor --}}
    <div class="card p-7 sm:p-9 bg-gradient-to-br from-white via-sand-50 to-forest-50/30 border-2 border-forest-200">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-terra-600 block">Catatan Pendampingan</span>
                <h3 class="font-display text-lg font-bold text-ink-900">Pesan Penguatan & Rekomendasi dari Konselor</h3>
            </div>
            @if($session && $session->konselor)
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-forest-800 bg-forest-50 px-3.5 py-1.5 rounded-full border border-forest-200">
                    Konselor: {{ $session->konselor->name }}
                </span>
            @endif
        </div>

        @if($session && $session->counselor_evaluation_notes)
            <div class="p-5 rounded-3xl bg-white border border-sand-300 text-sm text-ink-800 leading-relaxed whitespace-pre-line shadow-sm">
                {{ $session->counselor_evaluation_notes }}
            </div>
        @else
            <div class="p-5 rounded-3xl bg-white/80 border border-sand-300 text-xs sm:text-sm text-ink-500 leading-relaxed">
                <p class="font-bold text-ink-800 mb-1">Menunggu Catatan Evaluasi Konselor</p>
                <p>Konselor pendampingmu sedang meninjau perkembangan skor dan lembar refleksi untuk menyusun pesan penguatan dan rekomendasi tindak lanjut.</p>
            </div>
        @endif
    </div>
</div>
@endsection
