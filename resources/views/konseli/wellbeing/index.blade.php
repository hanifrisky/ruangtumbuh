@extends('layouts.konseli')

@section('title', 'Instrumen Well-Being & Ide Bunuh Diri')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    <div class="border-b border-slate-200 pb-4">
        <span class="text-xs font-black uppercase tracking-wider text-forest-700 block mb-1">Asesmen Kesejahteraan Psikologis</span>
        <h2 class="font-sans text-2xl font-black text-slate-900">Instrumen Well-Being & Ide Bunuh Diri</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Pilih kategori pengisian: <strong>Awal Konseling</strong> (sebelum sesi daring) atau <strong>Sesudah Konseling</strong> (setelah menyelesaikan sesi konseling daring).
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Card 1: Awal Konseling (Pre-Test) (60% White Card with 30% Green Action) --}}
        <div class="card p-7 bg-white relative overflow-hidden flex flex-col justify-between border-2 {{ $preTest && $preTest->status === 'completed' ? 'border-emerald-300' : 'border-slate-200' }}">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-forest-50 text-forest-800 text-xs px-3 py-1 rounded-full font-bold border border-forest-200 uppercase tracking-wider">
                        Kategori: Awal Konseling
                    </span>
                    @if($preTest)
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full border {{ $preTest->status === 'completed' ? 'text-forest-800 bg-emerald-100 border-emerald-300' : 'text-amber-800 bg-amber-50 border-amber-200' }}">
                            {{ $preTest->status === 'completed' ? '✓ Selesai' : 'Draf Disimpan' }}
                        </span>
                    @else
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 border border-slate-200 px-3 py-0.5 rounded-full">Belum Diisi</span>
                    @endif
                </div>

                <h3 class="font-sans font-bold text-slate-900 text-xl mb-2">Instrumen Awal Konseling (Pra-Konseling)</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6 font-normal">
                    Diisi sebelum sesi konseling daring untuk memetakan 6 dimensi <em>Psychological Well-Being</em> (Carol D. Ryff) dan deteksi dini perlindungan diri.
                </p>

                @if($preTest)
                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl mb-6 space-y-1.5 text-xs text-slate-600">
                        <div class="flex justify-between gap-2">
                            <span>Nama Konseli:</span>
                            <span class="font-bold text-slate-900">{{ $preTest->konseli_name }}</span>
                        </div>
                        @if($preTest->status === 'completed')
                            <div class="flex justify-between gap-2">
                                <span>Total Skor:</span>
                                <span class="font-bold text-forest-800">{{ $preTest->total_score }} Poin</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span>Tanggal Selesai:</span>
                                <span class="font-medium text-slate-700">{{ $preTest->completed_at->format('d M Y • H:i') }} WIB</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-200 mt-6">
                @if(!$preTest)
                    <form action="{{ route('konseli.wellbeing.start', 'pre_test') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name_pre" class="form-label text-xs">Nama Lengkap Konseli</label>
                            <input type="text" id="name_pre" name="konseli_name" value="{{ auth()->user()->name }}" required class="form-input" />
                            <input type="hidden" name="kategori" value="Awal Konseling">
                        </div>
                        <button type="submit" class="w-full btn-primary py-3 font-black uppercase tracking-wider text-xs">
                            Mulai Pengisian Awal Konseling &rarr;
                        </button>
                    </form>
                @elseif($preTest->status === 'draft')
                    <a href="{{ route('konseli.wellbeing.show', 'pre_test') }}" class="w-full btn-primary py-3 font-black text-xs uppercase tracking-wider text-center block">
                        Lanjutkan Pengisian Awal &rarr;
                    </a>
                @else
                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="{{ route('konseli.wellbeing.result', 'pre_test') }}" class="btn-secondary py-2.5 font-bold text-center text-xs">
                            Lihat Hasil
                        </a>
                        <a href="{{ route('konseli.wellbeing.pdf', 'pre_test') }}" target="_blank" class="btn-primary py-2.5 font-bold text-center text-xs flex items-center justify-center gap-1.5">
                            Unduh PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Card 2: Sesudah Konseling (Post-Test) (60% White Card with 10% Sky Blue Action) --}}
        <div class="card p-7 bg-white relative overflow-hidden flex flex-col justify-between border-2 {{ !$canTakePostTest ? 'opacity-70 bg-slate-50/50 border-slate-200' : ($postTest && $postTest->status === 'completed' ? 'border-sky-300' : 'border-slate-200') }}">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-sky-50 text-sky-800 text-xs px-3 py-1 rounded-full font-bold border border-sky-200 uppercase tracking-wider">
                        Kategori: Sesudah Konseling
                    </span>
                    @if($postTest)
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full border {{ $postTest->status === 'completed' ? 'text-forest-800 bg-emerald-100 border-emerald-300' : 'text-amber-800 bg-amber-50 border-amber-200' }}">
                            {{ $postTest->status === 'completed' ? '✓ Selesai' : 'Draf Disimpan' }}
                        </span>
                    @else
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 border border-slate-200 px-3 py-0.5 rounded-full">Belum Diisi</span>
                    @endif
                </div>

                <h3 class="font-sans font-bold text-slate-900 text-xl mb-2">Instrumen Sesudah Konseling (Pasca-Konseling)</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6 font-normal">
                    Diisi sesudah sesi konseling daring dan refleksi untuk mengevaluasi peningkatan kesejahteraan psikologis dan pemulihan diri.
                </p>

                @if($postTest)
                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl mb-6 space-y-1.5 text-xs text-slate-600">
                        <div class="flex justify-between gap-2">
                            <span>Nama Konseli:</span>
                            <span class="font-bold text-slate-900">{{ $postTest->konseli_name }}</span>
                        </div>
                        @if($postTest->status === 'completed')
                            <div class="flex justify-between gap-2">
                                <span>Total Skor:</span>
                                <span class="font-bold text-forest-800">{{ $postTest->total_score }} Poin</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span>Tanggal Selesai:</span>
                                <span class="font-medium text-slate-700">{{ $postTest->completed_at->format('d M Y • H:i') }} WIB</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-200 mt-6">
                @if(!$canTakePostTest)
                    <div class="text-center p-3.5 bg-slate-100 rounded-2xl border border-slate-200 text-slate-500 text-xs font-semibold">
                        Selesaikan instrumen <strong>Awal Konseling</strong> terlebih dahulu
                    </div>
                @else
                    @if(!$postTest)
                        <form action="{{ route('konseli.wellbeing.start', 'post_test') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="name_post" class="form-label text-xs">Nama Lengkap Konseli</label>
                                <input type="text" id="name_post" name="konseli_name" value="{{ auth()->user()->name }}" required class="form-input" />
                                <input type="hidden" name="kategori" value="Sesudah Konseling">
                            </div>
                            <button type="submit" class="w-full btn-sky py-3 font-black uppercase tracking-wider text-xs">
                                Mulai Pengisian Sesudah Konseling &rarr;
                            </button>
                        </form>
                    @elseif($postTest->status === 'draft')
                        <a href="{{ route('konseli.wellbeing.show', 'post_test') }}" class="w-full btn-sky py-3 font-black text-xs uppercase tracking-wider text-center block">
                            Lanjutkan Pengisian Sesudah &rarr;
                        </a>
                    @else
                        <div class="grid grid-cols-2 gap-2.5">
                            <a href="{{ route('konseli.wellbeing.result', 'post_test') }}" class="btn-secondary py-2.5 font-bold text-center text-xs">
                                Lihat Hasil
                            </a>
                            <a href="{{ route('konseli.wellbeing.pdf', 'post_test') }}" target="_blank" class="btn-primary py-2.5 font-bold text-center text-xs flex items-center justify-center gap-1.5">
                                Unduh PDF
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
