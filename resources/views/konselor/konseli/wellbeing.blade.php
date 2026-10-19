@extends('layouts.konselor')

@section('title', 'Laporan Diagnosa & Hasil Lengkap Asesmen Well-Being: ' . $user->name)
@section('page-title', 'Hasil Instrumen: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.konseli.session', $user) }}" class="btn-primary text-xs font-black px-4 py-2 uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
    Percakapan & Sesi
</a>
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary text-xs font-black px-4 py-2 border-2 border-slate-300 uppercase tracking-wider">&larr; Kembali</a>
@endsection

@section('content')
<div class="space-y-6 animate-fade-in pb-16" x-data="{ activeTab: '{{ $tab }}' }">

    {{-- Konseli Dossier Header Bar --}}
    <div class="card-forest p-6 sm:p-7 rounded-3xl text-white shadow-md relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-lime-200 text-forest-950 text-[10px] font-black uppercase tracking-wider border border-lime-300">
                        Dossier Asesmen Siswa
                    </span>
                    <span class="text-xs text-emerald-200 font-bold">&bull; NIS / Kelas: {{ $user->grade_class ?? '-' }}</span>
                </div>
                <h2 class="font-display font-black text-2xl sm:text-3xl text-white tracking-tight uppercase">{{ $user->name }}</h2>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 font-medium">
                    Jenis Kelamin: <strong class="text-white">{{ $user->gender ?? '-' }}</strong> &bull;
                    Asal Sekolah: <strong class="text-white">{{ $user->school_origin ?? '-' }}</strong> &bull;
                    Email: <span class="text-white">{{ $user->email }}</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('konselor.konseli.session', $user) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white/15 hover:bg-white/25 border border-white/25 text-white font-bold text-xs uppercase tracking-wider transition-all">
                    <span>Sesi Konseling & Chat</span> &rarr;
                </a>
            </div>
        </div>
    </div>

    {{-- Tab Switcher Navigation --}}
    <div class="p-1.5 sm:p-2 bg-slate-100/80 rounded-3xl border-2 border-slate-200 shadow-xs">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 sm:gap-2.5" role="tablist" aria-label="Menu Tab Asesmen Well-Being">
            {{-- Tab 1: Asesmen Awal (Pra-Konseling) --}}
            <button type="button"
                    role="tab"
                    :aria-selected="activeTab === 'pre_test'"
                    @click="activeTab = 'pre_test'"
                    :class="activeTab === 'pre_test'
                        ? 'bg-forest-900 text-white border-forest-950 shadow-md ring-4 ring-forest-800/20'
                        : 'bg-white text-slate-800 border-slate-200/90 hover:border-forest-400 hover:bg-forest-50/30 hover:shadow-sm'"
                    class="group relative flex items-center justify-between gap-3 px-4 py-3.5 sm:px-4 sm:py-3.5 rounded-2xl border-2 transition-all duration-200 text-left cursor-pointer active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-forest-600/30">
                <div class="flex items-center gap-3 min-w-0">
                    <div :class="activeTab === 'pre_test' ? 'bg-lime-400 text-forest-950' : 'bg-forest-100 text-forest-800 group-hover:bg-forest-200'"
                         class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full {{ $preTest ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                            <span class="text-[10px] font-black uppercase tracking-wider block truncate"
                                  :class="activeTab === 'pre_test' ? 'text-lime-300' : 'text-slate-500 group-hover:text-forest-700'">
                                Pra-Konseling
                            </span>
                        </div>
                        <div class="font-display font-black text-sm sm:text-base leading-tight mt-0.5 truncate"
                             :class="activeTab === 'pre_test' ? 'text-white' : 'text-slate-900 group-hover:text-forest-900'">
                            Asesmen Awal
                        </div>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    @if($preTest)
                        <span :class="activeTab === 'pre_test' ? 'bg-lime-300 text-forest-950' : 'bg-forest-50 text-forest-900 border border-forest-200'"
                              class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-black shadow-xs">
                            {{ $preTest->computed_well_being_score }}/125
                        </span>
                    @else
                        <span :class="activeTab === 'pre_test' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 border border-slate-200'"
                              class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold">
                            Belum
                        </span>
                    @endif
                </div>
            </button>

            {{-- Tab 2: Asesmen Sesudah (Pasca-Konseling) --}}
            <button type="button"
                    role="tab"
                    :aria-selected="activeTab === 'post_test'"
                    @click="activeTab = 'post_test'"
                    :class="activeTab === 'post_test'
                        ? 'bg-sky-900 text-white border-sky-950 shadow-md ring-4 ring-sky-700/20'
                        : 'bg-white text-slate-800 border-slate-200/90 hover:border-sky-400 hover:bg-sky-50/30 hover:shadow-sm'"
                    class="group relative flex items-center justify-between gap-3 px-4 py-3.5 sm:px-4 sm:py-3.5 rounded-2xl border-2 transition-all duration-200 text-left cursor-pointer active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-sky-600/30">
                <div class="flex items-center gap-3 min-w-0">
                    <div :class="activeTab === 'post_test' ? 'bg-sky-300 text-sky-950' : 'bg-sky-100 text-sky-800 group-hover:bg-sky-200'"
                         class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full {{ $postTest ? 'bg-sky-500' : 'bg-slate-300' }}"></span>
                            <span class="text-[10px] font-black uppercase tracking-wider block truncate"
                                  :class="activeTab === 'post_test' ? 'text-sky-200' : 'text-slate-500 group-hover:text-sky-700'">
                                Pasca-Konseling
                            </span>
                        </div>
                        <div class="font-display font-black text-sm sm:text-base leading-tight mt-0.5 truncate"
                             :class="activeTab === 'post_test' ? 'text-white' : 'text-slate-900 group-hover:text-sky-950'">
                            Asesmen Sesudah
                        </div>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    @if($postTest)
                        <span :class="activeTab === 'post_test' ? 'bg-sky-300 text-sky-950' : 'bg-sky-50 text-sky-900 border border-sky-200'"
                              class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-black shadow-xs">
                            {{ $postTest->computed_well_being_score }}/125
                        </span>
                    @else
                        <span :class="activeTab === 'post_test' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 border border-slate-200'"
                              class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold">
                            Belum
                        </span>
                    @endif
                </div>
            </button>

            {{-- Tab 3: Analisis Perbandingan Butir --}}
            <button type="button"
                    role="tab"
                    :aria-selected="activeTab === 'comparison'"
                    @click="activeTab = 'comparison'"
                    :class="activeTab === 'comparison'
                        ? 'bg-slate-900 text-white border-slate-950 shadow-md ring-4 ring-slate-700/20'
                        : 'bg-white text-slate-800 border-slate-200/90 hover:border-slate-400 hover:bg-slate-50 hover:shadow-sm'"
                    class="group relative flex items-center justify-between gap-3 px-4 py-3.5 sm:px-4 sm:py-3.5 rounded-2xl border-2 transition-all duration-200 text-left cursor-pointer active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-slate-600/30">
                <div class="flex items-center gap-3 min-w-0">
                    <div :class="activeTab === 'comparison' ? 'bg-lime-400 text-forest-950' : 'bg-slate-100 text-slate-700 group-hover:bg-slate-200'"
                         class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full {{ ($preTest && $postTest) ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                            <span class="text-[10px] font-black uppercase tracking-wider block truncate"
                                  :class="activeTab === 'comparison' ? 'text-slate-300' : 'text-slate-500 group-hover:text-slate-700'">
                                Komparasi Butir
                            </span>
                        </div>
                        <div class="font-display font-black text-sm sm:text-base leading-tight mt-0.5 truncate"
                             :class="activeTab === 'comparison' ? 'text-white' : 'text-slate-900 group-hover:text-slate-950'">
                            Perbandingan Butir
                        </div>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    @if($preTest && $postTest)
                        @php
                            $diffScore = $postTest->computed_well_being_score - $preTest->computed_well_being_score;
                        @endphp
                        <span :class="activeTab === 'comparison' ? 'bg-lime-300 text-forest-950' : 'bg-emerald-50 text-emerald-900 border border-emerald-200'"
                              class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-black shadow-xs">
                            {{ $diffScore >= 0 ? '+'.$diffScore : $diffScore }} Poin
                        </span>
                    @else
                        <span :class="activeTab === 'comparison' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 border border-slate-200'"
                              class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold">
                            25 Butir
                        </span>
                    @endif
                </div>
            </button>
        </div>
    </div>

    {{-- TAB 1: PRE-TEST FULL DIAGNOSIS --}}
    <div x-show="activeTab === 'pre_test'" class="space-y-6">
        @if($preTest)
            @php
                $wbScore = $preTest->computed_well_being_score;
                $suicideScore = $preTest->computed_suicide_score;
                $wbPercentage = round(($wbScore / 125) * 100);
                $wbCategory = $preTest->well_being_category;
                $wbInterp = $preTest->well_being_interpretation_text;
                $isSelective = $preTest->is_selective_priority;
                $suicideCategory = $preTest->suicide_category;
                $suicideInterp = $preTest->suicide_interpretation_text;
                $isCrisis = $preTest->is_crisis;
                $dimensions = $preTest->dimensions_breakdown;
                $aspects = $preTest->suicide_aspects_breakdown;
            @endphp

            <div class="card p-6 sm:p-9 bg-white border border-slate-200 shadow-sm rounded-3xl space-y-8">
                {{-- Header Summary & Actions --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-6">
                    <div>
                        <span class="text-xs font-black bg-forest-100 text-forest-900 px-3.5 py-1 rounded-full border border-forest-300 uppercase tracking-wider inline-block">
                            Asesmen Awal (Pra-Konseling)
                        </span>
                        <h3 class="font-sans text-2xl font-black text-slate-900 mt-2">
                            Laporan Hasil Diagnosa Klinis & Pemetaan Psikologis
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 font-medium">
                            Diselesaikan pada: <strong class="text-slate-800">{{ $preTest->completed_at ? $preTest->completed_at->format('d M Y • H:i') : '-' }} WIB</strong>
                        </p>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('konselor.konseli.wellbeing.pdf', [$user, 'pre_test']) }}" target="_blank" class="px-4 py-2.5 bg-forest-50 hover:bg-forest-100 text-forest-900 text-xs font-bold rounded-xl border border-forest-200 transition-colors inline-flex items-center gap-1.5 uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Unduh PDF
                        </a>
                        <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'pre_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Asesmen Awal ini? Konseli harus mengisi ulang dari awal.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-black rounded-xl border border-rose-200 transition-colors inline-flex items-center gap-1.5 uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Reset Hasil
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Alerts --}}
                @if($isCrisis)
                    <div class="p-4 sm:p-5 bg-rose-50 border-2 border-rose-300 rounded-2xl flex items-start gap-3.5 text-rose-900">
                        <div class="w-8 h-8 rounded-xl bg-rose-200 text-rose-800 flex items-center justify-center flex-shrink-0 font-bold text-sm">
                            ⚠
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-rose-950 uppercase tracking-wide">Peringatan Klinis: Risiko Ide Bunuh Diri Terindikasi</h4>
                            <p class="text-xs text-rose-800 mt-1 leading-relaxed">
                                Skor indikator risiko ide bunuh diri berada pada rentang tinggi ({{ $suicideScore }}/60). Konseli memerlukan pendampingan segera pada sesi konseling ini. Terapkan protokol keselamatan (safety planning) dan koordinasi rujukan bila diperlukan.
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
                        <h4 class="font-sans font-bold text-base text-slate-900 flex items-center gap-2">
                            <span class="text-forest-700">✦</span>
                            Profil 6 Dimensi Psychological Well-Being (Carol D. Ryff)
                        </h4>
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
                    <h4 class="font-sans font-bold text-base text-slate-900 flex items-center gap-2">
                        <span class="text-slate-700">✦</span>
                        Profil 4 Aspek Identifikasi Diri (Ide Bunuh Diri)
                    </h4>

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

                {{-- Item Answers for Pre-Test --}}
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between">
                        <h4 class="font-sans font-bold text-base text-slate-900">
                            Rincian Pilihan Jawaban Konseli (Asesmen Awal)
                        </h4>
                        <span class="text-xs text-slate-500 font-bold">{{ $preTest->details->count() }} Butir Terjawab</span>
                    </div>

                    <div class="space-y-3">
                        @php
                            $preDetails = $preTest->details->keyBy('question_id');
                        @endphp
                        @foreach($questions as $idx => $q)
                            @php
                                $detail = $preDetails->get($q->id);
                            @endphp
                            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-3">
                                <div class="flex items-start gap-3 min-w-0 flex-1">
                                    <span class="w-7 h-7 rounded-lg bg-forest-900 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $idx + 1 }}</span>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-900 leading-relaxed">{{ $q->text }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">{{ $q->category === 'well_being' ? 'Well-Being' : 'Ide Bunuh Diri' }}</span>
                                            @if($q->dimension)
                                                <span class="text-[10px] text-slate-400">&bull; {{ $q->dimension }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0 self-end md:self-auto">
                                    @if($detail)
                                        <span class="text-xs px-3 py-1.5 rounded-xl bg-forest-100 text-forest-950 font-bold border border-forest-300">
                                            {{ $detail->selectedOption->label ?? '-' }} ({{ $detail->score }} Poin)
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum dijawab</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card p-12 bg-white border border-slate-200 rounded-3xl text-center shadow-sm">
                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-2xl font-bold mb-4">
                    📋
                </div>
                <h4 class="font-display font-bold text-lg text-slate-800">Konseli Belum Mengisi Asesmen Awal</h4>
                <p class="text-xs text-slate-500 max-w-md mx-auto mt-1 leading-relaxed">
                    Siswa belum menyelesaikan instrumen Psychological Well-Being & Ide Bunuh Diri tahap awal. Ingatkan siswa melalui ruang percakapan terbimbing.
                </p>
                <div class="mt-5">
                    <a href="{{ route('konselor.konseli.session', $user) }}" class="btn-primary text-xs font-bold px-5 py-2.5 rounded-xl uppercase tracking-wider inline-flex items-center gap-2">
                        Buka Ruang Percakapan &rarr;
                    </a>
                </div>
            </div>
        @endif
    </div>

    {{-- TAB 2: POST-TEST FULL DIAGNOSIS --}}
    <div x-show="activeTab === 'post_test'" class="space-y-6">
        @if($postTest)
            @php
                $wbScore = $postTest->computed_well_being_score;
                $suicideScore = $postTest->computed_suicide_score;
                $wbPercentage = round(($wbScore / 125) * 100);
                $wbCategory = $postTest->well_being_category;
                $wbInterp = $postTest->well_being_interpretation_text;
                $isSelective = $postTest->is_selective_priority;
                $suicideCategory = $postTest->suicide_category;
                $suicideInterp = $postTest->suicide_interpretation_text;
                $isCrisis = $postTest->is_crisis;
                $dimensions = $postTest->dimensions_breakdown;
                $aspects = $postTest->suicide_aspects_breakdown;
            @endphp

            <div class="card p-6 sm:p-9 bg-white border border-slate-200 shadow-sm rounded-3xl space-y-8">
                {{-- Header Summary & Actions --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-6">
                    <div>
                        <span class="text-xs font-black bg-sky-100 text-sky-900 px-3.5 py-1 rounded-full border border-sky-300 uppercase tracking-wider inline-block">
                            Asesmen Sesudah (Pasca-Konseling)
                        </span>
                        <h3 class="font-sans text-2xl font-black text-slate-900 mt-2">
                            Laporan Hasil Diagnosa Klinis & Pemetaan Pasca-Konseling
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 font-medium">
                            Diselesaikan pada: <strong class="text-slate-800">{{ $postTest->completed_at ? $postTest->completed_at->format('d M Y • H:i') : '-' }} WIB</strong>
                        </p>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('konselor.konseli.wellbeing.pdf', [$user, 'post_test']) }}" target="_blank" class="px-4 py-2.5 bg-sky-50 hover:bg-sky-100 text-sky-900 text-xs font-bold rounded-xl border border-sky-200 transition-colors inline-flex items-center gap-1.5 uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Unduh PDF
                        </a>
                        <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'post_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Asesmen Sesudah ini? Konseli harus mengisi ulang dari awal.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-black rounded-xl border border-rose-200 transition-colors inline-flex items-center gap-1.5 uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Reset Hasil
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Alerts --}}
                @if($isCrisis)
                    <div class="p-4 sm:p-5 bg-rose-50 border-2 border-rose-300 rounded-2xl flex items-start gap-3.5 text-rose-900">
                        <div class="w-8 h-8 rounded-xl bg-rose-200 text-rose-800 flex items-center justify-center flex-shrink-0 font-bold text-sm">
                            ⚠
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-rose-950 uppercase tracking-wide">Peringatan Klinis Pasca-Sesi: Risiko Masih Terindikasi</h4>
                            <p class="text-xs text-rose-800 mt-1 leading-relaxed">
                                Skor indikator risiko ide bunuh diri pasca-konseling berada pada angka {{ $suicideScore }}/60. Lakukan sesi lanjutan atau rujuk ke pihak berkompeten jika diperlukan.
                            </p>
                        </div>
                    </div>
                @elseif($isSelective)
                    <div class="p-4 sm:p-5 bg-amber-50 border border-amber-300 rounded-2xl flex items-start gap-3.5 text-amber-900">
                        <div class="w-8 h-8 rounded-xl bg-amber-200 text-amber-800 flex items-center justify-center flex-shrink-0 font-bold text-sm">
                            ⚡
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-amber-950 uppercase tracking-wide">Prioritas Layanan Penguatan Tambahan</h4>
                            <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                                Skor kesejahteraan psikologis ({{ $wbScore }}/125) masih memerlukan penguatan dimensi tertentu.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Dual Executive Score Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Well-Being Card --}}
                    <div class="p-6 rounded-3xl bg-sky-50/60 border-2 border-sky-200 relative overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[11px] font-black uppercase tracking-wider text-sky-800">Psychological Well-Being (Pasca)</span>
                                <span class="text-[10px] font-black px-2.5 py-0.5 rounded-full bg-sky-800 text-white uppercase">{{ $wbCategory }}</span>
                            </div>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-sans text-4xl sm:text-5xl font-black text-sky-950">{{ $wbScore }}</span>
                                <span class="text-xs font-bold text-slate-500">/ 125 Poin</span>
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed mt-3 font-normal">
                                {{ $wbInterp }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-sky-200/80 flex items-center justify-between text-[11px] text-slate-500">
                            <span>Norma Riset: M = 91,70 (SD = 11,93)</span>
                            <span class="font-bold text-sky-900">{{ $wbPercentage }}% Tercapai</span>
                        </div>
                    </div>

                    {{-- Suicide Ideation Card --}}
                    <div class="p-6 rounded-3xl bg-slate-50 border-2 border-slate-200 relative overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[11px] font-black uppercase tracking-wider text-slate-700">Identifikasi Diri (Risiko Pasca)</span>
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
                    <h4 class="font-sans font-bold text-base text-slate-900 flex items-center gap-2">
                        <span class="text-sky-700">✦</span>
                        Profil 6 Dimensi Psychological Well-Being (Carol D. Ryff) - Pasca Konseling
                    </h4>

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
                                        <td class="py-3 px-3 text-center font-bold text-sky-900 text-sm">
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
                                            <span class="text-sky-800 italic">&bull; Rekomendasi: {{ $dim['recommendation'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- 4 Aspects of Suicide Ideation Profile --}}
                <div class="space-y-3 pt-2">
                    <h4 class="font-sans font-bold text-base text-slate-900 flex items-center gap-2">
                        <span class="text-slate-700">✦</span>
                        Profil 4 Aspek Identifikasi Diri (Ide Bunuh Diri) - Pasca Konseling
                    </h4>

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

                {{-- Item Answers for Post-Test --}}
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between">
                        <h4 class="font-sans font-bold text-base text-slate-900">
                            Rincian Pilihan Jawaban Konseli (Asesmen Sesudah)
                        </h4>
                        <span class="text-xs text-slate-500 font-bold">{{ $postTest->details->count() }} Butir Terjawab</span>
                    </div>

                    <div class="space-y-3">
                        @php
                            $postDetails = $postTest->details->keyBy('question_id');
                        @endphp
                        @foreach($questions as $idx => $q)
                            @php
                                $detail = $postDetails->get($q->id);
                            @endphp
                            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-3">
                                <div class="flex items-start gap-3 min-w-0 flex-1">
                                    <span class="w-7 h-7 rounded-lg bg-sky-900 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $idx + 1 }}</span>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-900 leading-relaxed">{{ $q->text }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">{{ $q->category === 'well_being' ? 'Well-Being' : 'Ide Bunuh Diri' }}</span>
                                            @if($q->dimension)
                                                <span class="text-[10px] text-slate-400">&bull; {{ $q->dimension }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0 self-end md:self-auto">
                                    @if($detail)
                                        <span class="text-xs px-3 py-1.5 rounded-xl bg-sky-100 text-sky-950 font-bold border border-sky-300">
                                            {{ $detail->selectedOption->label ?? '-' }} ({{ $detail->score }} Poin)
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum dijawab</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card p-12 bg-white border border-slate-200 rounded-3xl text-center shadow-sm">
                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-2xl font-bold mb-4">
                    📝
                </div>
                <h4 class="font-display font-bold text-lg text-slate-800">Konseli Belum Mengisi Asesmen Sesudah</h4>
                <p class="text-xs text-slate-500 max-w-md mx-auto mt-1 leading-relaxed">
                    Siswa belum menyelesaikan instrumen pasca-konseling (Post-Test). Asesmen ini diisi siswa setelah rangkaian sesi konseling online selesai untuk mengevaluasi perkembangan efektivitas intervensi.
                </p>
            </div>
        @endif
    </div>

    {{-- TAB 3: COMPARISON TABLE (AWAL VS SESUDAH) --}}
    <div x-show="activeTab === 'comparison'" class="space-y-6">
        @if($preTest || $postTest)
            {{-- Summary Cards Comparison --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pre-Test Mini Card --}}
                <div class="card p-6 bg-white border-2 border-forest-200 rounded-3xl shadow-sm">
                    <div class="flex items-center justify-between border-b border-forest-100 pb-3 mb-4">
                        <span class="text-xs font-black uppercase tracking-wider text-forest-800">Awal (Pra-Konseling)</span>
                        <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-forest-100 text-forest-900 font-bold">{{ $preTest ? 'Selesai' : 'Belum' }}</span>
                    </div>
                    @if($preTest)
                        <div class="space-y-2">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs text-slate-500">Skor Well-Being:</span>
                                <span class="text-lg font-black text-forest-950">{{ $preTest->computed_well_being_score }}/125 ({{ $preTest->well_being_category }})</span>
                            </div>
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs text-slate-500">Skor Ide Bunuh Diri:</span>
                                <span class="text-lg font-black {{ $preTest->is_crisis ? 'text-rose-700' : 'text-slate-800' }}">{{ $preTest->computed_suicide_score }}/60 ({{ $preTest->suicide_category }})</span>
                            </div>
                        </div>
                    @else
                        <p class="text-xs text-slate-400">Belum diisi oleh siswa.</p>
                    @endif
                </div>

                {{-- Post-Test Mini Card --}}
                <div class="card p-6 bg-white border-2 border-sky-200 rounded-3xl shadow-sm">
                    <div class="flex items-center justify-between border-b border-sky-100 pb-3 mb-4">
                        <span class="text-xs font-black uppercase tracking-wider text-sky-800">Sesudah (Pasca-Konseling)</span>
                        <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-sky-100 text-sky-900 font-bold">{{ $postTest ? 'Selesai' : 'Belum' }}</span>
                    </div>
                    @if($postTest)
                        <div class="space-y-2">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs text-slate-500">Skor Well-Being:</span>
                                <span class="text-lg font-black text-sky-950">{{ $postTest->computed_well_being_score }}/125 ({{ $postTest->well_being_category }})</span>
                            </div>
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs text-slate-500">Skor Ide Bunuh Diri:</span>
                                <span class="text-lg font-black {{ $postTest->is_crisis ? 'text-rose-700' : 'text-slate-800' }}">{{ $postTest->computed_suicide_score }}/60 ({{ $postTest->suicide_category }})</span>
                            </div>
                        </div>
                    @else
                        <p class="text-xs text-slate-400">Belum diisi oleh siswa.</p>
                    @endif
                </div>
            </div>

            {{-- Detail Questions Comparison --}}
            <div class="card p-6 sm:p-7 bg-white border-2 border-slate-200 rounded-3xl shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight">Perbandingan Butir Jawaban Konseli</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Membandingkan respon instrumen sebelum dan sesudah intervensi konseling online</p>
                    </div>
                    <span class="text-xs font-black text-slate-400">{{ $questions->count() }} Butir Instrumen</span>
                </div>

                <div class="space-y-4">
                    @php
                        $preDetails = $preTest ? $preTest->details->keyBy('question_id') : collect();
                        $postDetails = $postTest ? $postTest->details->keyBy('question_id') : collect();
                    @endphp

                    @foreach($questions as $idx => $q)
                        @php
                            $preAns = $preDetails->get($q->id);
                            $postAns = $postDetails->get($q->id);
                        @endphp
                        <div class="p-4 sm:p-5 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-start gap-3 min-w-0 flex-1">
                                <span class="w-8 h-8 rounded-xl bg-forest-900 text-white font-black text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $idx + 1 }}</span>
                                <div>
                                    <p class="text-xs sm:text-sm font-bold text-slate-800 leading-relaxed">{{ $q->text }}</p>
                                    <span class="text-[10px] text-slate-400 font-medium mt-1 block">
                                        {{ $q->category === 'well_being' ? 'Psychological Well-Being' : 'Identifikasi Diri (Ide Bunuh Diri)' }}
                                        @if($q->dimension)
                                            &bull; {{ $q->dimension }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0 w-full md:w-auto">
                                {{-- Pre answer value --}}
                                <div class="text-center bg-white border-2 border-forest-200 p-2.5 rounded-2xl flex-1 md:w-36 shadow-xs">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Awal Konseling</span>
                                    <span class="text-xs font-black text-forest-900 mt-0.5 block">
                                        @if($preAns)
                                            {{ $preAns->selectedOption->label ?? ($preAns->score . ' Poin') }}
                                            <span class="text-[10px] text-forest-600 block">({{ $preAns->score }} Poin)</span>
                                        @else
                                            <span class="text-slate-400 font-normal">-</span>
                                        @endif
                                    </span>
                                </div>

                                {{-- Post answer value --}}
                                <div class="text-center bg-white border-2 border-sky-200 p-2.5 rounded-2xl flex-1 md:w-36 shadow-xs">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Sesudah Konseling</span>
                                    <span class="text-xs font-black text-sky-800 mt-0.5 block">
                                        @if($postAns)
                                            {{ $postAns->selectedOption->label ?? ($postAns->score . ' Poin') }}
                                            <span class="text-[10px] text-sky-600 block">({{ $postAns->score }} Poin)</span>
                                        @else
                                            <span class="text-slate-400 font-normal">-</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card p-12 bg-white border border-slate-200 rounded-3xl text-center shadow-sm">
                <p class="text-xs text-slate-400">Belum ada data instrumen yang diisi oleh siswa.</p>
            </div>
        @endif
    </div>

</div>
@endsection
