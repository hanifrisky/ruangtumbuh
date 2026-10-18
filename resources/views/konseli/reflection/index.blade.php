@extends('layouts.konseli')

@section('title', 'Jurnal Refleksi Pasca-Sesi - Ruang Tumbuh')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    {{-- Top Hashtags (10% Sky Blue) --}}
    <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-100 text-sky-800 border border-sky-300">
            #Langkah6
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #RefleksiPascaSesi
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #KearifanLokalNusantara
        </span>
    </div>

    {{-- Header --}}
    <div class="border-b-2 border-forest-100 pb-5 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 tracking-tight uppercase">
                Jurnal Refleksi Selesai Sesi
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl font-medium">
                Tuliskan apa yang kamu rasakan, pelajari, dan rencanakan setelah menyelesaikan sesi konseling bersama <strong class="text-forest-900">{{ $session->konselor->name }}</strong>.
            </p>
        </div>
        <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary text-xs font-black px-5 py-3 flex-shrink-0 uppercase tracking-wider inline-flex items-center gap-2 shadow-sm">
            <span>Langkah 7: Asesmen Sesudah</span>
            <span>&rarr;</span>
        </a>
    </div>

    {{-- Kearifan Lokal Wisdom Ribbon (Poster Lime Badge Inspired) --}}
    <div class="p-5 sm:p-6 rounded-3xl bg-white border-2 border-forest-200 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="w-11 h-11 rounded-2xl bg-lime-200 text-forest-950 border border-lime-300 flex items-center justify-center flex-shrink-0 font-black text-xl shadow-xs">
                ✦
            </div>
            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                <span class="font-black uppercase tracking-wider text-forest-900 text-[10px] block mb-0.5">Petuah Bijak Kearifan Lokal Nusantara</span>
                <p class="font-medium text-forest-950">
                    <em>&ldquo;Suro Diro Joyodiningrat, Lebur Dening Pangastuti&rdquo;</em> — Segala kepenatan batin dan beban pikiran yang keras dapat diurai dengan kelegaan hati, penerimaan diri, dan langkah kecil yang penuh ketulusan.
                </p>
            </div>
        </div>
    </div>

    {{-- Reflection Form (60% Crisp White Card) --}}
    <div class="card p-7 sm:p-9 bg-white border-2 border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-6 border-b border-slate-100 pb-4">
            <div>
                <h3 class="font-display text-lg sm:text-xl font-black text-forest-950">Lembar Jurnal Refleksi Pribadi</h3>
                <p class="text-xs text-slate-500 mt-0.5">Jawabanmu tersimpan aman dan hanya dapat dibaca olehmu serta konselor pendampingmu.</p>
            </div>
            <span class="hidden sm:inline-block px-3 py-1 bg-forest-50 text-forest-800 text-xs font-black rounded-full border border-forest-200">
                Layanan Terstruktur
            </span>
        </div>

        <form action="{{ route('konseli.reflection.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Pertanyaan 1: REBT / Pemahaman Pikiran & Perasaan --}}
            <div class="p-5 sm:p-6 rounded-3xl bg-slate-50/70 border-2 border-forest-200 space-y-2.5">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-wider text-forest-900 bg-forest-100 px-3 py-1 rounded-full border border-forest-300">
                    Refleksi 1 • Pikiran & Emosi (REBT)
                </span>
                <label for="answer_1" class="block font-display text-sm sm:text-base font-bold text-slate-900 leading-relaxed">
                    1. Apa pemahaman baru yang kamu dapatkan tentang pikiran, perasaan, atau cara memandang masalahmu setelah sesi konseling ini?
                </label>
                <textarea id="answer_1" name="answer_1" rows="4" required class="form-input bg-white text-sm focus:border-forest-600 focus:ring-forest-600" placeholder="Contoh: Saya mulai menyadari bahwa saya tidak harus sempurna untuk merasa berharga, dan saya belajar melihat kesalahan sebagai proses belajar...">{{ old('answer_1') }}</textarea>
                <x-input-error :messages="$errors->get('answer_1')" class="mt-1" />
            </div>

            {{-- Pertanyaan 2: Kearifan Lokal & Dukungan Sosial --}}
            <div class="p-5 sm:p-6 rounded-3xl bg-slate-50/70 border-2 border-sky-200 space-y-2.5">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-wider text-sky-900 bg-sky-100 px-3 py-1 rounded-full border border-sky-300">
                    Refleksi 2 • Kearifan Budaya & Dukungan Orang Terdekat
                </span>
                <label for="answer_2" class="block font-display text-sm sm:text-base font-bold text-slate-900 leading-relaxed">
                    2. Nilai atau pelajaran apa dari pengalaman hidup, budaya, atau orang-orang yang mendukungmu yang dapat membantumu menghadapi masalah dengan lebih baik?
                </label>
                <textarea id="answer_2" name="answer_2" rows="4" required class="form-input bg-white text-sm focus:border-sky-600 focus:ring-sky-600" placeholder="Tuliskan petuah orang tua, kearifan budaya nusantara, atau perhatian sahabat yang membuatmu merasa dikuatkan...">{{ old('answer_2') }}</textarea>
                <x-input-error :messages="$errors->get('answer_2')" class="mt-1" />
            </div>

            {{-- Pertanyaan 3: Well-Being / Langkah Kecil --}}
            <div class="p-5 sm:p-6 rounded-3xl bg-slate-50/70 border-2 border-lime-200 space-y-2.5">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-wider text-forest-950 bg-lime-200 px-3 py-1 rounded-full border border-lime-400">
                    Refleksi 3 • Komitmen Nyata Merawat Diri (Well-Being)
                </span>
                <label for="answer_3" class="block font-display text-sm sm:text-base font-bold text-slate-900 leading-relaxed">
                    3. Apa satu langkah kecil yang akan kamu lakukan setelah sesi ini untuk merawat dirimu, menghadapi masalah, atau mencari dukungan ketika membutuhkannya?
                </label>
                <textarea id="answer_3" name="answer_3" rows="4" required class="form-input bg-white text-sm focus:border-forest-600 focus:ring-forest-600" placeholder="Tuliskan komitmen satu langkah kecil dan realistis untuk dirimu sendiri...">{{ old('answer_3') }}</textarea>
                <x-input-error :messages="$errors->get('answer_3')" class="mt-1" />
            </div>

            <div class="flex justify-end pt-3">
                <button type="submit" class="btn-primary px-8 py-3.5 font-black text-xs uppercase tracking-wider shadow-sm">
                    ✓ Simpan Lembar Refleksi
                </button>
            </div>
        </form>
    </div>

    {{-- Reflection History --}}
    @if($session->reflections->isNotEmpty())
        <div class="space-y-4">
            <h3 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight">Riwayat Jurnal Refleksimu ({{ $session->reflections->count() }} Catatan)</h3>
            @foreach($session->reflections->sortByDesc('submitted_at') as $idx => $ref)
                <div class="card p-6 bg-white border-2 border-slate-200 space-y-4 shadow-sm">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <span class="text-xs font-black uppercase tracking-wider text-forest-900 bg-forest-100 px-3 py-1 rounded-full border border-forest-300">
                            ✓ Refleksi Tersimpan
                        </span>
                        <span class="text-xs text-slate-500 font-bold">
                            {{ $ref->submitted_at ? $ref->submitted_at->format('d M Y • H:i') : $ref->created_at->format('d M Y • H:i') }} WIB
                        </span>
                    </div>

                    <div class="space-y-3 text-xs sm:text-sm">
                        <div class="p-4 rounded-2xl bg-forest-50/40 border border-forest-100">
                            <span class="font-black text-forest-900 block text-xs mb-1">1. Pemahaman Baru (Pikiran & Emosi):</span>
                            <p class="text-slate-700 whitespace-pre-line font-medium leading-relaxed">{{ $ref->answer_1 }}</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-sky-50/40 border border-sky-100">
                            <span class="font-black text-sky-900 block text-xs mb-1">2. Kearifan Budaya & Dukungan Orang Terdekat:</span>
                            <p class="text-slate-700 whitespace-pre-line font-medium leading-relaxed">{{ $ref->answer_2 }}</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="font-black text-forest-950 block text-xs mb-1">3. Langkah Nyata Merawat Diri:</span>
                            <p class="text-slate-700 whitespace-pre-line font-medium leading-relaxed">{{ $ref->answer_3 }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
