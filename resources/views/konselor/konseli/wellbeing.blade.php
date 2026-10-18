@extends('layouts.konselor')

@section('title', 'Hasil Instrumen Well-Being & Ide Bunuh Diri')
@section('page-title', 'Hasil Instrumen: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.konseli.session', $user) }}" class="btn-primary text-xs font-bold px-4 py-2">Percakapan & Sesi</a>
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary text-xs font-bold px-4 py-2">&larr; Kembali</a>
@endsection

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    
    {{-- Comparison Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Pre-Test Card --}}
        <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-5 border-b border-sand-100 pb-3">
                    <h3 class="font-serif text-lg font-normal text-ink-900">Awal Konseling (Pra-Konseling)</h3>
                    <span class="bg-forest-50 text-forest-800 text-[11px] px-3 py-1 rounded-full border border-forest-200 font-bold uppercase tracking-wider">Awal</span>
                </div>

                @if($preTest)
                    <div class="space-y-4">
                        <div class="p-5 bg-sand-50/70 border border-sand-200 rounded-2xl text-center">
                            <span class="text-[11px] font-bold text-ink-400 block uppercase tracking-wider">Skor Total</span>
                            <span class="text-4xl font-extrabold text-forest-800 block mt-1">{{ $preTest->total_score }} Poin</span>
                            <span class="text-xs text-ink-600 font-medium block mt-2">Well-Being: <strong>{{ $preTest->well_being_score ?? '-' }}</strong> | Ide Bunuh Diri: <strong>{{ $preTest->suicide_ideation_score ?? '-' }}</strong></span>
                            <span class="text-[11px] text-ink-400 font-normal block mt-1">Selesai: {{ $preTest->completed_at->format('d M Y H:i') }} WIB</span>
                        </div>
                        <div class="p-4 bg-sand-100/50 border border-sand-200 rounded-2xl">
                            <span class="text-[10px] font-bold text-forest-700 uppercase tracking-widest block mb-1">Interpretasi Hasil</span>
                            <p class="text-xs text-ink-700 leading-relaxed">{{ $preTest->interpretation->description ?? 'Tidak ditemukan deskripsi.' }}</p>
                        </div>
                        <div class="pt-2 border-t border-sand-100 flex justify-end">
                            <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'pre_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Awal Konseling ini? Konseli harus mengisi ulang dari awal.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-terra-600 bg-terra-50 hover:bg-terra-100 hover:text-terra-700 rounded-xl border border-terra-200 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Reset Awal Konseling
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-ink-400 font-light text-sm">
                        Konseli belum menyelesaikan Instrumen Awal Konseling.
                    </div>
                @endif
            </div>
        </div>

        {{-- Post-Test Card --}}
        <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-5 border-b border-sand-100 pb-3">
                    <h3 class="font-serif text-lg font-normal text-ink-900">Sesudah Konseling (Pasca-Konseling)</h3>
                    <span class="bg-sage-50 text-sage-800 text-[11px] px-3 py-1 rounded-full border border-sage-200 font-bold uppercase tracking-wider">Sesudah</span>
                </div>

                @if($postTest)
                    <div class="space-y-4">
                        <div class="p-5 bg-sand-50/70 border border-sand-200 rounded-2xl text-center">
                            <span class="text-[11px] font-bold text-ink-400 block uppercase tracking-wider">Skor Total</span>
                            <span class="text-4xl font-extrabold text-sage-700 block mt-1">{{ $postTest->total_score }} Poin</span>
                            <span class="text-xs text-ink-600 font-medium block mt-2">Well-Being: <strong>{{ $postTest->well_being_score ?? '-' }}</strong> | Ide Bunuh Diri: <strong>{{ $postTest->suicide_ideation_score ?? '-' }}</strong></span>
                            <span class="text-[11px] text-ink-400 font-normal block mt-1">Selesai: {{ $postTest->completed_at->format('d M Y H:i') }} WIB</span>
                        </div>
                        <div class="p-4 bg-sand-100/50 border border-sand-200 rounded-2xl">
                            <span class="text-[10px] font-bold text-sage-700 uppercase tracking-widest block mb-1">Interpretasi Hasil</span>
                            <p class="text-xs text-ink-700 leading-relaxed">{{ $postTest->interpretation->description ?? 'Tidak ditemukan deskripsi.' }}</p>
                        </div>
                        <div class="pt-2 border-t border-sand-100 flex justify-end">
                            <form action="{{ route('konselor.konseli.wellbeing.reset', [$user, 'post_test']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset hasil Post-Test ini? Konseli harus mengisi ulang dari awal.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-terra-600 bg-terra-50 hover:bg-terra-100 hover:text-terra-700 rounded-xl border border-terra-200 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Reset Post-Test
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-ink-400 font-light text-sm">
                        Konseli belum menyelesaikan Post-Test.
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Detail Questions Analysis --}}
    @if($preTest || $postTest)
        <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm">
            <h4 class="font-serif text-lg font-normal text-ink-900 border-b border-sand-100 pb-3 mb-6">Analisis Perbandingan Butir Jawaban</h4>
            
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
                    <div class="p-4 sm:p-5 bg-sand-50/60 border border-sand-200/80 rounded-2xl flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-3 min-w-0 flex-1">
                            <span class="w-7 h-7 rounded-xl bg-forest-800 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $idx + 1 }}</span>
                            <p class="text-sm font-semibold text-ink-800 leading-relaxed">{{ $q->text }}</p>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0 w-full md:w-auto">
                            {{-- Pre answer value --}}
                            <div class="text-center bg-white border border-sand-200/80 p-2.5 rounded-2xl flex-1 md:w-28 shadow-sm">
                                <span class="text-[10px] font-bold text-ink-400 uppercase tracking-widest block">Awal</span>
                                <span class="text-xs font-bold text-forest-700 mt-1 block">
                                    {{ $preAns ? $preAns->score . ' Poin' : '-' }}
                                </span>
                            </div>

                            {{-- Post answer value --}}
                            <div class="text-center bg-white border border-sand-200/80 p-2.5 rounded-2xl flex-1 md:w-28 shadow-sm">
                                <span class="text-[10px] font-bold text-ink-400 uppercase tracking-widest block">Sesudah</span>
                                <span class="text-xs font-bold text-sage-700 mt-1 block">
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
