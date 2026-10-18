@extends('layouts.konseli')

@section('title', 'Hasil Instrumen Well-Being & Ide Bunuh Diri')

@section('content')
@php
    $score = $answer->total_score;
    $maxPossibleScore = \App\Models\Interpretation::max('max_score') ?? 150;
    $percentage = $maxPossibleScore > 0 ? round(($score / $maxPossibleScore) * 100) : 0;
    $kategoriLabel = $answer->type === 'pre_test' ? 'Awal Konseling (Pra-Konseling)' : 'Sesudah Konseling (Pasca-Konseling)';

    $wellBeingScore = $answer->well_being_score ?? $answer->details->filter(fn($d) => ($d->question->category ?? 'well_being') === 'well_being')->sum('score');
    $suicideIdeationScore = $answer->suicide_ideation_score ?? $answer->details->filter(fn($d) => ($d->question->category ?? '') === 'suicide_ideation')->sum('score');
@endphp

<div class="max-w-3xl mx-auto space-y-6 animate-fade-in pb-16">
    {{-- 30% Green Supportive Reassurance Card --}}
    <div class="card-forest p-7 rounded-3xl text-white shadow-lg flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-start gap-3.5">
            <div class="w-11 h-11 rounded-2xl bg-white/10 text-emerald-200 flex items-center justify-center flex-shrink-0 font-bold text-lg">
                ✦
            </div>
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-200 block">Ruang Penerimaan & Harapan</span>
                <h3 class="font-sans text-lg font-bold mt-0.5">Terima Kasih Telah Jujur Mendengarkan Dirimu</h3>
                <p class="text-xs text-emerald-100 mt-1 leading-relaxed font-light">
                    Hasil ini adalah cermin awal untuk membantumu dan konselor merawat kesehatan jiwamu secara berkelanjutan.
                </p>
            </div>
        </div>
    </div>

    {{-- 60% White Results Card --}}
    <div class="card p-7 sm:p-9 bg-white border border-slate-200 text-center relative overflow-hidden shadow-sm">
        <div class="relative z-10 space-y-6">
            <div>
                <span class="text-xs font-black bg-forest-50 text-forest-800 px-3.5 py-1 rounded-full border border-forest-200 uppercase tracking-wider">
                    {{ $kategoriLabel }}
                </span>
                <h2 class="font-sans text-2xl sm:text-3xl font-black text-slate-900 mt-3">
                    Hasil Pemetaan Well-Being & Harapan Hidup
                </h2>
                <p class="text-xs text-slate-500 mt-1 font-light">
                    Nama Konseli: <strong class="text-slate-900">{{ $answer->konseli_name }}</strong> &bull; Disimpan Pada: {{ $answer->completed_at->format('d M Y • H:i') }} WIB
                </p>
            </div>

            {{-- Circular Score Display --}}
            <div class="relative w-44 h-44 mx-auto flex items-center justify-center">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="42" stroke="#F1F5F9" stroke-width="8" fill="transparent" />
                    <circle cx="50" cy="50" r="42" stroke="url(#forestGradient)" stroke-width="8" fill="transparent"
                            stroke-dasharray="263.89"
                            stroke-dashoffset="{{ 263.89 - (263.89 * $percentage / 100) }}"
                            stroke-linecap="round" class="transition-all duration-1000 ease-out" />
                    <defs>
                        <linearGradient id="forestGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#064E3B" />
                            <stop offset="60%" stop-color="#065F46" />
                            <stop offset="100%" stop-color="#16A34A" />
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute text-center">
                    <span class="font-sans text-4xl font-black text-forest-900">{{ $score }}</span>
                    <span class="text-xs font-bold text-slate-400 block mt-0.5">dari {{ $maxPossibleScore }} Poin</span>
                </div>
            </div>

            {{-- Sub-score Breakdown --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl mx-auto">
                <div class="p-4 rounded-2xl bg-forest-50 border border-forest-200 text-left">
                    <span class="text-[11px] font-black uppercase tracking-wider text-forest-800 block">Psychological Well-Being</span>
                    <p class="font-sans text-2xl font-black text-slate-900 mt-1">{{ $wellBeingScore }} <span class="text-xs font-normal text-slate-500">/ 90 Poin</span></p>
                    <span class="text-[11px] text-slate-600">6 Dimensi Kesejahteraan Diri (Carol D. Ryff)</span>
                </div>
                <div class="p-4 rounded-2xl bg-sky-50 border border-sky-200 text-left">
                    <span class="text-[11px] font-black uppercase tracking-wider text-sky-800 block">Daya Lenting & Harapan Hidup</span>
                    <p class="font-sans text-2xl font-black text-slate-900 mt-1">{{ $suicideIdeationScore }} <span class="text-xs font-normal text-slate-500">/ 60 Poin</span></p>
                    <span class="text-[11px] text-slate-600">Ketahanan Diri & Proteksi Internal</span>
                </div>
            </div>

            {{-- Score Interpretation --}}
            <div class="p-5 bg-slate-50 border border-slate-200 rounded-3xl max-w-xl mx-auto text-left">
                <h4 class="font-sans font-bold text-sm mb-1.5 text-forest-900 flex items-center gap-1.5">
                    <span>✦</span>
                    Interpretasi & Langkah Pendampingan
                </h4>
                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-normal">
                    {{ $answer->interpretation->description ?? 'Hasil asesmenmu telah tersimpan dan siap ditinjau bersama konselor pendampingmu.' }}
                </p>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 border-t border-slate-200 flex flex-wrap items-center gap-3 justify-center print:hidden">
                <a href="{{ route('konseli.wellbeing.pdf', $answer->type) }}" target="_blank" class="w-full sm:w-auto btn-primary px-6 py-3 font-bold flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh Hasil (PDF)
                </a>
                <button type="button" onclick="window.print()" class="w-full sm:w-auto btn-secondary px-5 py-3 font-bold flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak
                </button>
                @if($answer->type === 'pre_test')
                    <a href="{{ route('konseli.counseling.index') }}" class="w-full sm:w-auto btn-sky px-6 py-3 font-bold text-center">
                        Lanjut ke Chat & Jadwal Konseling &rarr;
                    </a>
                @else
                    <a href="{{ route('konseli.evaluation.index') }}" class="w-full sm:w-auto btn-sky px-6 py-3 font-bold text-center">
                        Lihat Evaluasi Pertumbuhan &rarr;
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
