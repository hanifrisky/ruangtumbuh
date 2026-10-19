@extends('layouts.konseli')

@section('title', 'Evaluasi dan Tindak Lanjut - Ruang Tumbuh')

@section('content')
@php
    $preWb = $preTest ? $preTest->computed_well_being_score : null;
    $postWb = $postTest ? $postTest->computed_well_being_score : null;
    $wbDiff = (!is_null($preWb) && !is_null($postWb)) ? ($postWb - $preWb) : null;
    $preWbPercent = $preWb ? min(100, round(($preWb / 125) * 100)) : 0;
    $postWbPercent = $postWb ? min(100, round(($postWb / 125) * 100)) : 0;

    $preSuicide = $preTest ? $preTest->computed_suicide_score : null;
    $postSuicide = $postTest ? $postTest->computed_suicide_score : null;
    $suicideDiff = (!is_null($preSuicide) && !is_null($postSuicide)) ? ($postSuicide - $preSuicide) : null;

    $preDims = $preTest ? $preTest->dimensions_breakdown : [];
    $postDims = $postTest ? $postTest->dimensions_breakdown : [];

    $preAspects = $preTest ? $preTest->suicide_aspects_breakdown : [];
    $postAspects = $postTest ? $postTest->suicide_aspects_breakdown : [];
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
                Rekapitulasi perkembangan <em>Psychological Well-Being</em> (Carol D. Ryff) & <em>Identifikasi Diri</em> serta arahan penguatan dari konselor pendampingmu.
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
                <span class="text-[10px] font-black uppercase tracking-widest text-forest-700">Grafik Komparasi Hasil</span>
                <h3 class="font-display text-lg sm:text-xl font-black text-forest-950 mt-0.5 uppercase tracking-tight">Perbandingan Skor Psychological Well-Being (25–125)</h3>
            </div>
            @if(!is_null($wbDiff))
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider {{ $wbDiff >= 0 ? 'bg-forest-100 text-forest-900 border border-forest-300' : 'bg-amber-100 text-amber-900 border border-amber-300' }}">
                    {{ $wbDiff >= 0 ? '▲ Peningkatan +' . $wbDiff . ' Poin' : 'Perubahan ' . $wbDiff . ' Poin' }}
                </span>
            @endif
        </div>

        <div class="space-y-5">
            {{-- Pre-test bar --}}
            <div>
                <div class="flex justify-between text-xs font-black text-slate-700 mb-1.5">
                    <span>Awal Konseling (Pra-Konseling)</span>
                    <span class="text-forest-900">{{ $preTest ? $preWb . ' / 125 Poin (' . $preTest->well_being_category . ')' : 'Belum Diisi' }}</span>
                </div>
                <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-forest-700 rounded-full transition-all duration-700" style="width: {{ $preWbPercent }}%"></div>
                </div>
            </div>

            {{-- Post-test bar --}}
            <div>
                <div class="flex justify-between text-xs font-black text-slate-700 mb-1.5">
                    <span>Sesudah Konseling (Pasca-Konseling)</span>
                    <span class="text-sky-700">{{ $postTest ? $postWb . ' / 125 Poin (' . $postTest->well_being_category . ')' : 'Belum Diisi' }}</span>
                </div>
                <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-sky-600 rounded-full transition-all duration-700" style="width: {{ $postWbPercent }}%"></div>
                </div>
            </div>
        </div>

        {{-- Suicide Ideation Comparison Banner --}}
        @if($preTest && $postTest)
            <div class="mt-6 p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-500">Evaluasi Risiko Ide Bunuh Diri (Skala 12–60)</span>
                    <div class="flex items-center gap-4 mt-1">
                        <span class="text-xs text-slate-700">Awal: <strong>{{ $preSuicide }}/60</strong> ({{ $preTest->suicide_category }})</span>
                        <span class="text-slate-400">&rarr;</span>
                        <span class="text-xs text-slate-700">Sesudah: <strong>{{ $postSuicide }}/60</strong> ({{ $postTest->suicide_category }})</span>
                    </div>
                </div>
                <div>
                    @if(!is_null($suicideDiff))
                        @if($suicideDiff < 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                ✓ Risiko Menurun {{ abs($suicideDiff) }} Poin (Positif)
                            </span>
                        @elseif($suicideDiff === 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                Tingkat Risiko Stabil
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                Perhatian: Perlu Pemantauan Lanjutan
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        @endif
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
                        <span class="text-xs text-slate-500 font-bold">{{ $preTest->completed_at ? $preTest->completed_at->format('d M Y') : '-' }}</span>
                    @endif
                </div>

                @if($preTest)
                    <div class="p-5 rounded-2xl bg-forest-50/50 border border-forest-200 text-center mb-4">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Kesejahteraan Psikologis Awal</span>
                        <p class="font-display text-4xl font-black text-forest-950 mt-1">{{ $preWb }} <span class="text-xs font-sans font-bold text-slate-400">/ 125</span></p>
                        <p class="text-xs text-slate-600 mt-2 font-medium">
                            Kategori: <strong class="text-forest-900">{{ $preTest->well_being_category }}</strong> &bull; Ide Bunuh Diri: <strong class="text-forest-900">{{ $preSuicide }}/60 ({{ $preTest->suicide_category }})</strong>
                        </p>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed font-medium">{{ $preTest->well_being_interpretation_text }}</p>
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
                        <span class="text-xs text-slate-500 font-bold">{{ $postTest->completed_at ? $postTest->completed_at->format('d M Y') : '-' }}</span>
                    @endif
                </div>

                @if($postTest)
                    <div class="p-5 rounded-2xl bg-sky-50/50 border border-sky-200 text-center mb-4">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Kesejahteraan Psikologis Sesudah</span>
                        <div class="flex items-center justify-center gap-2 mt-1">
                            <p class="font-display text-4xl font-black text-sky-950">{{ $postWb }} <span class="text-xs font-sans font-bold text-slate-400">/ 125</span></p>
                            @if(!is_null($wbDiff))
                                <span class="text-xs font-black px-2.5 py-1 rounded-full {{ $wbDiff >= 0 ? 'bg-forest-100 text-forest-900' : 'bg-amber-100 text-amber-900' }}">
                                    {{ $wbDiff >= 0 ? '+' . $wbDiff : $wbDiff }} Poin
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-600 mt-2 font-medium">
                            Kategori: <strong class="text-sky-900">{{ $postTest->well_being_category }}</strong> &bull; Ide Bunuh Diri: <strong class="text-sky-900">{{ $postSuicide }}/60 ({{ $postTest->suicide_category }})</strong>
                        </p>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed font-medium">{{ $postTest->well_being_interpretation_text }}</p>
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

    {{-- Komparasi 6 Dimensi Well-Being & 4 Aspek Ide Bunuh Diri (Bila Keduanya Terisi) --}}
    @if($preTest && $postTest)
        <div class="card p-7 sm:p-9 bg-white border-2 border-slate-200 shadow-sm rounded-3xl space-y-6">
            <h3 class="font-display font-black text-lg text-slate-900 uppercase tracking-tight flex items-center gap-2">
                <span class="text-forest-700">✦</span>
                Perubahan Detail 6 Dimensi Psychological Well-Being
            </h3>

            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
                            <th class="py-3 px-4">Dimensi</th>
                            <th class="py-3 px-3 text-center">Skor Awal</th>
                            <th class="py-3 px-3 text-center">Skor Sesudah</th>
                            <th class="py-3 px-3 text-center">Perubahan</th>
                            <th class="py-3 px-4">Status & Penguatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($preDims as $name => $dim)
                            @php
                                $postDimScore = $postDims[$name]['score'] ?? 0;
                                $postDimCat = $postDims[$name]['category'] ?? '-';
                                $dimDelta = $postDimScore - $dim['score'];
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3 px-4">
                                    <strong class="text-slate-900 block font-semibold">{{ $name }}</strong>
                                    <span class="text-[10px] text-slate-400">Maks {{ $dim['max_score'] }} Poin</span>
                                </td>
                                <td class="py-3 px-3 text-center font-bold text-slate-700">
                                    {{ $dim['score'] }} ({{ $dim['category'] }})
                                </td>
                                <td class="py-3 px-3 text-center font-bold text-forest-900">
                                    {{ $postDimScore }} ({{ $postDimCat }})
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-black {{ $dimDelta >= 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $dimDelta >= 0 ? '+' . $dimDelta : $dimDelta }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-600 text-[11px] leading-relaxed">
                                    {{ $postDims[$name]['recommendation'] ?? $dim['recommendation'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

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
