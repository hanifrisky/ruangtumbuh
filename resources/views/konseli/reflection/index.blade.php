@extends('layouts.konseli')

@section('title', 'Jurnal Refleksi Pasca-Sesi - Ruang Tumbuh')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    {{-- Header --}}
    <div class="border-b border-sand-300 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <span class="text-xs font-extrabold uppercase tracking-wider text-terra-600 block mb-1">Langkah 6 Layanan Ruang Tumbuh</span>
            <h2 class="font-display text-2xl font-bold text-ink-900">Jurnal Refleksi Selesai Sesi</h2>
            <p class="text-xs sm:text-sm text-ink-500 mt-1">
                Tuliskan apa yang kamu rasakan, pelajari, dan rencanakan setelah menyelesaikan sesi konseling bersama <strong>{{ $session->konselor->name }}</strong>.
            </p>
        </div>
        <a href="{{ route('konseli.wellbeing.index') }}" class="btn-primary text-xs font-extrabold px-4 py-2.5 flex-shrink-0">
            Langkah 7: Asesmen Sesudah &rarr;
        </a>
    </div>

    {{-- Kearifan Lokal Wisdom Ribbon --}}
    <div class="p-5 rounded-3xl bg-amber-50/90 border-2 border-amber-200/90 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-2xl bg-amber-500/15 text-amber-800 flex items-center justify-center flex-shrink-0 font-bold text-lg">
                ✦
            </div>
            <div class="text-xs sm:text-sm text-amber-950 leading-relaxed">
                <span class="font-extrabold uppercase tracking-wider text-amber-800 text-[10px] block">Nilai Kearifan Lokal Nusantara</span>
                <p class="mt-0.5">
                    <em>&ldquo;Suro Diro Joyodiningrat, Lebur Dening Pangastuti&rdquo;</em> — Segala kepenatan batin dan beban pikiran yang keras dapat diurai dengan kelegaan hati, penerimaan diri, dan langkah kecil yang penuh ketulusan.
                </p>
            </div>
        </div>
    </div>

    {{-- Reflection Form --}}
    <div class="card p-7 sm:p-9 bg-white border border-sand-300">
        <h3 class="font-display text-lg sm:text-xl font-bold text-ink-900 mb-1">Lembar Jurnal Refleksi Pribadi</h3>
        <p class="text-xs text-ink-500 mb-6">Jawabanmu tersimpan aman dan hanya dapat dibaca olehmu serta konselor pendampingmu.</p>

        <form action="{{ route('konseli.reflection.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Pertanyaan 1: REBT / Pemahaman Pikiran & Perasaan --}}
            <div class="p-5 sm:p-6 rounded-3xl bg-forest-50/50 border-2 border-forest-100 space-y-2.5">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider text-forest-800 bg-forest-100/90 px-3 py-0.5 rounded-full">
                    Refleksi 1 • Pikiran & Emosi (REBT)
                </span>
                <label for="answer_1" class="block font-display text-sm sm:text-base font-bold text-ink-900 leading-relaxed">
                    1. Apa pemahaman baru yang kamu dapatkan tentang pikiran, perasaan, atau cara memandang masalahmu setelah sesi konseling ini?
                </label>
                <textarea id="answer_1" name="answer_1" rows="4" required class="form-input bg-white text-sm" placeholder="Contoh: Saya mulai menyadari bahwa saya tidak harus sempurna untuk merasa berharga, dan saya belajar melihat kesalahan sebagai proses belajar...">{{ old('answer_1') }}</textarea>
                <x-input-error :messages="$errors->get('answer_1')" class="mt-1" />
            </div>

            {{-- Pertanyaan 2: Kearifan Lokal & Dukungan Sosial --}}
            <div class="p-5 sm:p-6 rounded-3xl bg-amber-50/50 border-2 border-amber-100 space-y-2.5">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider text-amber-800 bg-amber-100/90 px-3 py-0.5 rounded-full">
                    Refleksi 2 • Kearifan Budaya & Dukungan Orang Terdekat
                </span>
                <label for="answer_2" class="block font-display text-sm sm:text-base font-bold text-ink-900 leading-relaxed">
                    2. Nilai atau pelajaran apa dari pengalaman hidup, budaya, atau orang-orang yang mendukungmu yang dapat membantumu menghadapi masalah dengan lebih baik?
                </label>
                <textarea id="answer_2" name="answer_2" rows="4" required class="form-input bg-white text-sm" placeholder="Tuliskan petuah orang tua, kearifan budaya nusantara, atau perhatian sahabat yang membuatmu merasa dikuatkan...">{{ old('answer_2') }}</textarea>
                <x-input-error :messages="$errors->get('answer_2')" class="mt-1" />
            </div>

            {{-- Pertanyaan 3: Well-Being / Langkah Kecil --}}
            <div class="p-5 sm:p-6 rounded-3xl bg-sand-100/60 border-2 border-sand-300 space-y-2.5">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider text-terra-700 bg-terra-100/80 px-3 py-0.5 rounded-full">
                    Refleksi 3 • Komitmen Nyata Merawat Diri (Well-Being)
                </span>
                <label for="answer_3" class="block font-display text-sm sm:text-base font-bold text-ink-900 leading-relaxed">
                    3. Apa satu langkah kecil yang akan kamu lakukan setelah sesi ini untuk merawat dirimu, menghadapi masalah, atau mencari dukungan ketika membutuhkannya?
                </label>
                <textarea id="answer_3" name="answer_3" rows="4" required class="form-input bg-white text-sm" placeholder="Tuliskan komitmen satu langkah kecil dan realistis untuk dirimu sendiri...">{{ old('answer_3') }}</textarea>
                <x-input-error :messages="$errors->get('answer_3')" class="mt-1" />
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-primary px-8 py-3.5 font-extrabold text-xs uppercase tracking-wider">
                    ✓ Simpan Lembar Refleksi
                </button>
            </div>
        </form>
    </div>

    {{-- Reflection History --}}
    @if($session->reflections->isNotEmpty())
        <div class="space-y-4">
            <h3 class="font-display text-lg font-bold text-ink-900">Riwayat Jurnal Refleksimu ({{ $session->reflections->count() }} Catatan)</h3>
            @foreach($session->reflections->sortByDesc('submitted_at') as $idx => $ref)
                <div class="card p-6 bg-white border-2 border-sand-300 space-y-4">
                    <div class="flex items-center justify-between border-b border-sand-200 pb-3">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-forest-800 bg-forest-50 px-3 py-1 rounded-full border border-forest-200">
                            ✓ Refleksi Tersimpan
                        </span>
                        <span class="text-xs text-ink-400 font-bold">
                            {{ $ref->submitted_at ? $ref->submitted_at->format('d M Y • H:i') : $ref->created_at->format('d M Y • H:i') }} WIB
                        </span>
                    </div>
                    <div class="space-y-3 text-xs sm:text-sm">
                        <div>
                            <p class="font-bold text-ink-800">1. Pemahaman baru tentang pikiran & perasaan:</p>
                            <p class="text-ink-600 mt-1 bg-sand-50 p-3.5 rounded-2xl border border-sand-200 whitespace-pre-line leading-relaxed">{{ $ref->answer_1 }}</p>
                        </div>
                        <div>
                            <p class="font-bold text-ink-800">2. Nilai budaya & dukungan sosial penguat:</p>
                            <p class="text-ink-600 mt-1 bg-sand-50 p-3.5 rounded-2xl border border-sand-200 whitespace-pre-line leading-relaxed">{{ $ref->answer_2 }}</p>
                        </div>
                        <div>
                            <p class="font-bold text-ink-800">3. Komitmen langkah kecil ke depan:</p>
                            <p class="text-ink-600 mt-1 bg-sand-50 p-3.5 rounded-2xl border border-sand-200 whitespace-pre-line leading-relaxed">{{ $ref->answer_3 }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
