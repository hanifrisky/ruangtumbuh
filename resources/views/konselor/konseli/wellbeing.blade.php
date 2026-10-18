@extends('layouts.konselor')

@section('title', 'Hasil Instrumen Well-Being & Ide Bunuh Diri')
@section('page-title', 'Hasil Instrumen: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.konseli.session', $user) }}" class="btn-primary text-xs font-black px-4 py-2 uppercase tracking-wider">Percakapan & Sesi</a>
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary text-xs font-black px-4 py-2 border-2 border-slate-300 uppercase tracking-wider">&larr; Kembali</a>
@endsection

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    {{-- Top Hashtags (10% Sky Blue) --}}
    <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-100 text-sky-800 border border-sky-300">
            #RekapInstrumen
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #WellBeingRemaja
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #CegahIdeBunuhDiri
        </span>
    </div>
    
    {{-- Comparison Grid (60% Crisp White Cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Pre-Test Card (Forest Green Accent) --}}
        <div class="card p-6 sm:p-7 bg-white border-2 border-forest-200 rounded-3xl shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-5 border-b border-forest-100 pb-3">
                    <h3 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight">Awal Konseling (Pra-Konseling)</h3>
                    <span class="bg-forest-100 text-forest-900 text-[10px] px-3 py-1 rounded-full border border-forest-300 font-black uppercase tracking-wider">Awal</span>
                </div>

                @if($preTest)
                        <div class="p-5 bg-forest-50/50 border border-forest-200 rounded-2xl text-center">
                            <span class="text-[10px] font-black text-slate-500 block uppercase tracking-widest">Skor Total Awal</span>
                            <span class="text-4xl font-black text-forest-950 block mt-1">{{ $preTest->well_being_score ?? $preTest->total_score }} Poin</span>
                            <div class="flex items-center justify-center gap-2 mt-2">
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-forest-100 text-forest-900 border border-forest-300">
                                    WB: {{ $preTest->well_being_category }} ({{ $preTest->well_being_score ?? '-' }}/125)
                                </span>
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-bold {{ $preTest->is_crisis ? 'bg-rose-100 text-rose-900 border border-rose-300' : 'bg-slate-100 text-slate-800' }}">
                                    Ide Bunuh Diri: {{ $preTest->suicide_category }} ({{ $preTest->suicide_ideation_score ?? '-' }}/60)
                                </span>
                            </div>
                            @if($preTest->is_crisis)
                                <div class="mt-2 text-xs font-black text-rose-700 bg-rose-50 border border-rose-200 rounded-lg p-1.5">
                                    ⚠ PERINGATAN KRISIS: Butir inti / skor risiko tinggi!
                                </div>
                            @elseif($preTest->is_selective_priority)
                                <div class="mt-2 text-xs font-bold text-amber-800 bg-amber-50 border border-amber-200 rounded-lg p-1.5">
                                    ⚡ Prioritas Pencegahan Selektif (Skor WB &le; 80)
                                </div>
                            @endif
                            <span class="text-[11px] text-slate-400 font-bold block mt-2">Selesai: {{ $preTest->completed_at ? $preTest->completed_at->format('d M Y H:i') : '-' }} WIB</span>
                        </div>
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                            <span class="text-[10px] font-black text-forest-800 uppercase tracking-widest block mb-1">Interpretasi Hasil</span>
                            <p class="text-xs text-slate-700 leading-relaxed font-medium">{{ $preTest->interpretation->description ?? $preTest->well_being_interpretation_text }}</p>
                        </div>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                            <a href="{{ route('konselor.konseli.wellbeing.pdf', [$user, 'pre_test']) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-forest-800 bg-forest-50 hover:bg-forest-100 rounded-xl border border-forest-200 transition-colors uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Unduh PDF
                            </a>
                            <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'pre_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Awal Konseling ini? Konseli harus mengisi ulang dari awal.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-black text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl border border-rose-200 transition-colors uppercase tracking-wider">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Reset
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-slate-400 font-medium text-sm">
                        Konseli belum menyelesaikan Instrumen Awal Konseling.
                    </div>
                @endif
            </div>
        </div>

        {{-- Post-Test Card (Sky Blue Accent) --}}
        <div class="card p-6 sm:p-7 bg-white border-2 border-sky-200 rounded-3xl shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-5 border-b border-sky-100 pb-3">
                    <h3 class="font-display text-lg font-black text-sky-950 uppercase tracking-tight">Sesudah Konseling (Pasca-Konseling)</h3>
                    <span class="bg-sky-100 text-sky-900 text-[10px] px-3 py-1 rounded-full border border-sky-300 font-black uppercase tracking-wider">Sesudah</span>
                </div>

                @if($postTest)
                        <div class="p-5 bg-sky-50/50 border border-sky-200 rounded-2xl text-center">
                            <span class="text-[10px] font-black text-slate-500 block uppercase tracking-widest">Skor Total Sesudah</span>
                            <span class="text-4xl font-black text-sky-950 block mt-1">{{ $postTest->well_being_score ?? $postTest->total_score }} Poin</span>
                            <div class="flex items-center justify-center gap-2 mt-2">
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-sky-100 text-sky-900 border border-sky-300">
                                    WB: {{ $postTest->well_being_category }} ({{ $postTest->well_being_score ?? '-' }}/125)
                                </span>
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-bold {{ $postTest->is_crisis ? 'bg-rose-100 text-rose-900 border border-rose-300' : 'bg-slate-100 text-slate-800' }}">
                                    Ide Bunuh Diri: {{ $postTest->suicide_category }} ({{ $postTest->suicide_ideation_score ?? '-' }}/60)
                                </span>
                            </div>
                            @if($postTest->is_crisis)
                                <div class="mt-2 text-xs font-black text-rose-700 bg-rose-50 border border-rose-200 rounded-lg p-1.5">
                                    ⚠ PERINGATAN KRISIS: Butir inti / skor risiko tinggi!
                                </div>
                            @elseif($postTest->is_selective_priority)
                                <div class="mt-2 text-xs font-bold text-amber-800 bg-amber-50 border border-amber-200 rounded-lg p-1.5">
                                    ⚡ Prioritas Pencegahan Selektif (Skor WB &le; 80)
                                </div>
                            @endif
                            <span class="text-[11px] text-slate-400 font-bold block mt-2">Selesai: {{ $postTest->completed_at ? $postTest->completed_at->format('d M Y H:i') : '-' }} WIB</span>
                        </div>
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                            <span class="text-[10px] font-black text-sky-800 uppercase tracking-widest block mb-1">Interpretasi Hasil</span>
                            <p class="text-xs text-slate-700 leading-relaxed font-medium">{{ $postTest->interpretation->description ?? $postTest->well_being_interpretation_text }}</p>
                        </div>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                            <a href="{{ route('konselor.konseli.wellbeing.pdf', [$user, 'post_test']) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-sky-800 bg-sky-50 hover:bg-sky-100 rounded-xl border border-sky-200 transition-colors uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Unduh PDF
                            </a>
                            <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'post_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Post-Test ini? Konseli harus mengisi ulang dari awal.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-black text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl border border-rose-200 transition-colors uppercase tracking-wider">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Reset
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-slate-400 font-medium text-sm">
                        Konseli belum menyelesaikan Post-Test.
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Detail Questions Analysis --}}
    @if($preTest || $postTest)
        <div class="card p-6 sm:p-7 bg-white border-2 border-slate-200 rounded-3xl shadow-sm">
            <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight border-b border-slate-100 pb-3 mb-6">Analisis Perbandingan Butir Jawaban</h4>
            
            <div class="space-y-4">
                @php
                    $questions = \App\Models\Question::orderBy('order')->get();
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
                            <p class="text-sm font-bold text-slate-800 leading-relaxed">{{ $q->text }}</p>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0 w-full md:w-auto">
                            {{-- Pre answer value --}}
                            <div class="text-center bg-white border-2 border-forest-200 p-2.5 rounded-2xl flex-1 md:w-28 shadow-xs">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Awal</span>
                                <span class="text-xs font-black text-forest-900 mt-0.5 block">
                                    {{ $preAns ? $preAns->score . ' Poin' : '-' }}
                                </span>
                            </div>

                            {{-- Post answer value --}}
                            <div class="text-center bg-white border-2 border-sky-200 p-2.5 rounded-2xl flex-1 md:w-28 shadow-xs">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Sesudah</span>
                                <span class="text-xs font-black text-sky-800 mt-0.5 block">
                                    {{ $postAns ? $postAns->score . ' Poin' : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
