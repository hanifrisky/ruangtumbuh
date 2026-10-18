@extends('layouts.konseli')

@section('title', 'Hasil Lengkap Asesmen Well-Being & Ide Bunuh Diri')

@section('content')
@php
    $userObj = $answer->konseli ?? auth()->user();
    $wbScore = $answer->computed_well_being_score;
    $suicideScore = $answer->computed_suicide_score;
    $wbPercentage = round(($wbScore / 125) * 100);
    $kategoriLabel = $answer->type === 'pre_test' ? 'Awal Konseling (Pra-Konseling)' : 'Sesudah Konseling (Pasca-Konseling)';

    $wbCategory = $answer->well_being_category;
    $wbInterp = $answer->well_being_interpretation_text;
    $isSelective = $answer->is_selective_priority;

    $suicideCategory = $answer->suicide_category;
    $suicideInterp = $answer->suicide_interpretation_text;
    $isCrisis = $answer->is_crisis;

    $dimensions = $answer->dimensions_breakdown;
    $aspects = $answer->suicide_aspects_breakdown;
@endphp

<div class="max-w-4xl mx-auto space-y-6 animate-fade-in pb-16">
    {{-- Reassurance Supportive Card --}}
    <div class="card-forest p-6 sm:p-7 rounded-3xl text-white shadow-lg flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 print:hidden">
        <div class="flex items-start gap-3.5">
            <div class="w-11 h-11 rounded-2xl bg-white/10 text-emerald-200 flex items-center justify-center flex-shrink-0 font-bold text-lg">
                ✦
            </div>
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-200 block">Ruang Penerimaan & Harapan</span>
                <h3 class="font-sans text-lg font-bold mt-0.5">Terima Kasih Telah Jujur Mendengarkan Dirimu</h3>
                <p class="text-xs text-emerald-100 mt-1 leading-relaxed font-light">
                    Hasil asesmen ini adalah potret kesehatan jiwamu yang komprehensif untuk membantu langkah konseling online bersama konselormu.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2 self-end sm:self-auto flex-shrink-0">
            <button onclick="window.print()" class="px-4 py-2 bg-white/15 hover:bg-white/25 text-white text-xs font-bold rounded-xl transition-all flex items-center gap-1.5 border border-white/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak / Simpan Halaman
            </button>
            <a href="{{ route('konseli.wellbeing.pdf', $answer->type) }}" target="_blank" class="px-4 py-2 bg-emerald-400 hover:bg-emerald-300 text-forest-950 text-xs font-black rounded-xl transition-all flex items-center gap-1.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Unduh PDF Resmi
            </a>
        </div>
    </div>

    {{-- Main Printable Card --}}
    <div class="card p-6 sm:p-9 bg-white border border-slate-200 shadow-sm rounded-3xl space-y-8">
        {{-- Header Summary --}}
        <div class="text-center space-y-2 border-b border-slate-100 pb-6">
            <span class="text-xs font-black bg-forest-50 text-forest-800 px-3.5 py-1 rounded-full border border-forest-200 uppercase tracking-wider inline-block">
                {{ $kategoriLabel }}
            </span>
            <h2 class="font-sans text-2xl sm:text-3xl font-black text-slate-900">
                Laporan Hasil Pemetaan Psikologis
            </h2>
            <p class="text-xs text-slate-500 font-light">
                Konseli: <strong class="text-slate-900">{{ $answer->konseli_name }}</strong> &bull; Disimpan Pada: {{ $answer->completed_at ? $answer->completed_at->format('d M Y • H:i') : now()->format('d M Y') }} WIB
            </p>
        </div>

        {{-- Alerts --}}
        @if($isCrisis)
            <div class="p-4 sm:p-5 bg-rose-50 border-2 border-rose-300 rounded-2xl flex items-start gap-3.5 text-rose-900">
                <div class="w-8 h-8 rounded-xl bg-rose-200 text-rose-800 flex items-center justify-center flex-shrink-0 font-bold text-sm">
                    ⚠
                </div>
                <div>
                    <h4 class="font-bold text-sm text-rose-950 uppercase tracking-wide">Peringatan Klinis: Perlu Perhatian & Tindakan Segera</h4>
                    <p class="text-xs text-rose-800 mt-1 leading-relaxed">
                        Skor indikator risiko ide bunuh diri berada pada rentang tinggi ({{ $suicideScore }}/60). Konselor pendampingmu telah menerima notifikasi ini untuk segera mendampingimu. Jika kamu merasa tertekan, bicarakan segera dengan konselor melalui menu chat atau hubungi orang terdekatmu.
                    </p>
                </div>
            </div>
        @elseif($isSelective)
            <div class="p-4 sm:p-5 bg-amber-50 border border-amber-300 rounded-2xl flex items-start gap-3.5 text-amber-900">
                <div class="w-8 h-8 rounded-xl bg-amber-200 text-amber-800 flex items-center justify-center flex-shrink-0 font-bold text-sm">
                    ⚡
                </div>
                <div>
                    <h4 class="font-bold text-sm text-amber-950 uppercase tracking-wide">Prioritas Layanan Pencegahan Selektif</h4>
                    <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                        Skor kesejahteraan psikologis ({{ $wbScore }}/125) berada di bawah titik potong skrining (&le; 80). Ini menandakan kebutuhan prioritas untuk penguatan melalui konseling online dan refleksi bermuatan kearifan lokal.
                    </p>
                </div>
            </div>
        @endif

        {{-- Dual Executive Score Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Well-Being Card --}}
            <div class="p-6 rounded-3xl bg-forest-50/60 border-2 border-forest-200 relative overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-black uppercase tracking-wider text-forest-800">Psychological Well-Being</span>
                        <span class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-forest-800 text-white uppercase">{{ $wbCategory }}</span>
                    </div>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="font-sans text-4xl sm:text-5xl font-black text-forest-950">{{ $wbScore }}</span>
                        <span class="text-xs font-bold text-slate-500">/ 125 Poin</span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed mt-3 font-normal">
                        {{ $wbInterp }}
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-forest-200/80 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Norma Riset: M = 91,70 (SD = 11,93)</span>
                    <span class="font-bold text-forest-900">{{ $wbPercentage }}% Tercapai</span>
                </div>
            </div>

            {{-- Suicide Ideation Card --}}
            <div class="p-6 rounded-3xl bg-slate-50 border-2 border-slate-200 relative overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-black uppercase tracking-wider text-slate-700">Identifikasi Diri (Risiko)</span>
                        <span class="text-[10px] font-black px-2.5 py-0.5 rounded-full {{ $isCrisis ? 'bg-rose-700 text-white' : 'bg-slate-700 text-white' }} uppercase">
                            {{ $suicideCategory }}
                        </span>
                    </div>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="font-sans text-4xl sm:text-5xl font-black text-slate-900">{{ $suicideScore }}</span>
                        <span class="text-xs font-bold text-slate-500">/ 60 Poin</span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed mt-3 font-normal">
                        {{ $suicideInterp }}
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Skala Risiko: 12 (Min) – 60 (Maks)</span>
                    <span class="font-bold text-slate-900">Rerata Butir: {{ round($suicideScore / 12, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- 6 Dimensions Profile Table --}}
        <div class="space-y-3 pt-2">
            <div class="flex items-center justify-between">
                <h3 class="font-sans font-bold text-base text-slate-900 flex items-center gap-2">
                    <span class="text-forest-700">✦</span>
                    Profil 6 Dimensi Psychological Well-Being (Carol D. Ryff)
                </h3>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                            <th class="py-3 px-4">Dimensi</th>
                            <th class="py-3 px-3 text-center">Skor</th>
                            <th class="py-3 px-3 text-center">Norma M (SD)</th>
                            <th class="py-3 px-3 text-center">Kategori</th>
                            <th class="py-3 px-4">Arah Intervensi / Layanan BK</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($dimensions as $name => $dim)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3 px-4">
                                    <strong class="text-slate-900 block font-semibold">{{ $name }}</strong>
                                    <span class="text-[10px] text-slate-400">Maks {{ $dim['max_score'] }} poin</span>
                                    @if($dim['is_critical_factor'] && $dim['is_low'])
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded bg-rose-100 text-rose-800 text-[9px] font-bold">Faktor Kritis</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center font-bold text-forest-900 text-sm">
                                    {{ $dim['score'] }}
                                </td>
                                <td class="py-3 px-3 text-center text-slate-500">
                                    {{ number_format($dim['mean'], 2) }} ({{ number_format($dim['sd'], 2) }})
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                        {{ in_array($dim['category'], ['Sangat Tinggi', 'Tinggi']) ? 'bg-emerald-100 text-emerald-800' : (in_array($dim['category'], ['Rendah', 'Sangat Rendah']) ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-800') }}">
                                        {{ $dim['category'] }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-600 leading-relaxed text-[11px]">
                                    <span class="font-medium text-slate-800 block mb-0.5">{{ $dim['meaning'] }}</span>
                                    <span class="text-forest-800 italic">&bull; Rekomendasi: {{ $dim['recommendation'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 4 Aspects of Suicide Ideation Profile --}}
        <div class="space-y-3 pt-2">
            <h3 class="font-sans font-bold text-base text-slate-900 flex items-center gap-2">
                <span class="text-slate-700">✦</span>
                Profil 4 Aspek Identifikasi Diri (Ide Bunuh Diri)
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                @foreach($aspects as $name => $asp)
                    <div class="p-4 rounded-2xl border {{ $asp['is_high'] ? 'bg-rose-50/60 border-rose-200' : 'bg-slate-50 border-slate-200' }}">
                        <div class="flex items-center justify-between mb-1.5">
                            <h5 class="font-bold text-xs text-slate-900">{{ $name }}</h5>
                            <span class="text-[10px] font-black px-2 py-0.5 rounded-full {{ $asp['is_high'] ? 'bg-rose-200 text-rose-800' : 'bg-slate-200 text-slate-700' }} uppercase">
                                {{ $asp['category'] }}
                            </span>
                        </div>
                        <div class="text-base font-black {{ $asp['is_high'] ? 'text-rose-900' : 'text-slate-800' }}">
                            {{ $asp['score'] }} <span class="text-[10px] font-normal text-slate-400">/ 15</span>
                        </div>
                        <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                            {{ $asp['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="pt-6 border-t border-slate-200 flex flex-wrap items-center gap-3 justify-center print:hidden">
            <a href="{{ route('konseli.wellbeing.pdf', $answer->type) }}" target="_blank" class="w-full sm:w-auto btn-primary px-6 py-3 font-bold flex items-center justify-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Unduh Laporan Lengkap (PDF)
            </a>

            <button onclick="window.print()" class="w-full sm:w-auto btn-secondary px-6 py-3 font-bold flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak / Simpan Sebagai PDF
            </button>

            <a href="{{ route('konseli.counseling.index') }}" class="w-full sm:w-auto px-6 py-3 bg-forest-800 hover:bg-forest-900 text-white font-bold rounded-2xl flex items-center justify-center gap-2 transition-colors">
                <span>Ruang Konseling & Chat</span> &rarr;
            </a>
        </div>
    </div>
</div>
@endsection
