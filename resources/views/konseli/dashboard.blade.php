@extends('layouts.konseli')

@section('title', 'Beranda Konseli - Ruang Tumbuh')

@section('content')
@php
    $user = auth()->user();
    $counselorSelected = !is_null($user->selected_counselor_id);

    $preTest = $user->wellbeingAnswers()->where('type', 'pre_test')->first();
    $preTestCompleted = $preTest && $preTest->status === 'completed';

    $activeSession = $counselorSelected
        ? \App\Models\CounselingSession::where('konseli_id', $user->id)
            ->where('konselor_id', $user->selected_counselor_id)
            ->first()
        : null;

    $hasScheduleOrChat = $activeSession && ($activeSession->scheduled_at || $activeSession->messages()->exists());
    $hasReflection = $activeSession && $activeSession->reflections()->exists();

    $postTest = $user->wellbeingAnswers()->where('type', 'post_test')->first();
    $postTestCompleted = $postTest && $postTest->status === 'completed';
    $hasEvaluation = $activeSession && !empty($activeSession->counselor_evaluation_notes);

    // Calculate progress
    $completedCount = 2; // Step 1 & 2 done
    if ($counselorSelected) $completedCount++;
    if ($preTestCompleted) $completedCount++;
    if ($hasScheduleOrChat) $completedCount++;
    if ($hasReflection) $completedCount++;
    if ($postTestCompleted) $completedCount++;
    if ($hasEvaluation) $completedCount++;
    $progressPercent = round(($completedCount / 8) * 100);
@endphp

<div class="space-y-8 animate-fade-in">
    {{-- Modern Energetic Green Welcome Banner --}}
    <div class="relative overflow-hidden p-8 sm:p-10 rounded-[2.5rem] bg-gradient-to-br from-forest-950 via-forest-900 to-emerald-950 text-white border-2 border-emerald-500/20 shadow-2xl shadow-forest-950/20">
        {{-- Decorative Wavy Glow Blobs --}}
        <div class="absolute -top-16 -left-16 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-lime-400/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3.5 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-emerald-200 text-xs font-black uppercase tracking-wider">
                    <span class="w-2.5 h-2.5 rounded-full bg-lime-400 animate-pulse"></span>
                    <span>Ruang Konseling & Pertumbuhan Diri Remaja</span>
                </div>
                <h2 class="font-display font-black text-3xl sm:text-4xl text-white tracking-tight leading-tight">
                    Selamat Datang, {{ $user->name }}! 🌱
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100 leading-relaxed font-normal">
                    Setiap tunas memiliki waktunya sendiri untuk bertumbuh. Di ruang ini, ceritamu didengar dengan penuh empati, aman, dan tanpa penghakiman.
                </p>
                <div class="pt-1">
                    <span class="inline-flex items-center gap-2 text-xs italic text-lime-200 bg-white/10 px-4 py-2 rounded-2xl border border-white/15">
                        &ldquo;Urip Iku Urup — Hidupmu bermakna dan kamu tidak pernah sendirian.&rdquo;
                    </span>
                </div>
            </div>

            {{-- Progress Gauge --}}
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/20 flex flex-col items-center justify-center text-center flex-shrink-0 shadow-lg">
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-200 mb-1">Perjalanan Layanan</span>
                <div class="text-4xl font-display font-black text-white">
                    {{ $completedCount }}<span class="text-lg text-emerald-300 font-sans">/8</span>
                </div>
                <span class="text-xs font-black text-lime-300 mt-1 bg-forest-900/60 px-3 py-1 rounded-full border border-lime-300/30">{{ $progressPercent }}% Selesai</span>
            </div>
        </div>
    </div>

    {{-- Live Session Ticket Card (10% Blue Accent Ticket) --}}
    @if($activeSession && $activeSession->meeting_url)
        <div class="card p-6 bg-gradient-to-r from-sky-50 via-white to-emerald-50 border-2 border-sky-300 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-600 text-white flex items-center justify-center flex-shrink-0 shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sky-800 bg-sky-100 px-2.5 py-0.5 rounded-full border border-sky-200">
                        ● Sesi Konseling Terjadwal
                    </span>
                    <h4 class="font-sans text-lg font-bold text-slate-900">
                        {{ $activeSession->scheduled_at ? $activeSession->scheduled_at->format('d F Y • H:i') . ' WIB' : 'Sesi Aktif' }}
                    </h4>
                    <p class="text-xs text-slate-600">
                        Platform: <strong>{{ $activeSession->platform ?? 'Google Meet / Zoom' }}</strong> bersama <strong>{{ $activeSession->konselor->name ?? 'Konselor' }}</strong>
                    </p>
                </div>
            </div>
            <a href="{{ $activeSession->meeting_url }}" target="_blank" class="btn-sky py-3 px-6 text-xs w-full sm:w-auto text-center flex-shrink-0">
                Masuk Ruang Sesi &rarr;
            </a>
        </div>
    @endif

    {{-- Interactive 8-Step Service Journey Cards (60% White Base) --}}
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-forest-700 block">Jalur Bertumbuh</span>
                <h3 class="font-sans text-xl font-black text-slate-900">Tahapan Layanan Ruang Tumbuh</h3>
            </div>
            <span class="text-xs font-bold text-slate-500">Langkah 1 & 2 telah terselesaikan</span>
        </div>

        <div class="grid grid-cols-1 gap-4">
            {{-- Langkah 3: Pilih Konselor --}}
            <div class="card p-6 flex items-start gap-4 border-2 {{ $counselorSelected ? 'border-emerald-200 bg-emerald-50/20' : 'border-forest-600 ring-4 ring-forest-600/10' }}">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 font-sans font-black text-sm {{ $counselorSelected ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-700' }}">
                    {{ $counselorSelected ? '✓' : '3' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2">
                        <h4 class="font-sans text-base font-bold text-slate-900">Langkah 3: Memilih Konselor Pendamping</h4>
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ $counselorSelected ? 'bg-emerald-100 text-forest-800 border border-emerald-300' : 'bg-slate-100 text-slate-700' }}">
                            {{ $counselorSelected ? 'Selesai Dipilih' : 'Tahap Saat Ini' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        @if($counselorSelected && $user->selectedCounselor)
                            Konselor pendampingmu: <strong class="text-slate-900">{{ $user->selectedCounselor->name }}</strong>.
                        @else
                            Tersedia 12 konselor profesional BK FIP UM yang siap mendampingimu.
                        @endif
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2.5">
                        <a href="{{ route('konseli.counselor.index') }}" class="{{ $counselorSelected ? 'btn-secondary' : 'btn-primary' }} text-xs px-4 py-2">
                            {{ $counselorSelected ? 'Lihat / Ganti Konselor' : 'Pilih Konselor Sekarang' }}
                        </a>
                        @if($counselorSelected)
                            <a href="{{ route('konseli.counseling.index') }}" class="btn-primary text-xs px-4 py-2">
                                Buka Ruang Chat &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Langkah 4: Asesmen Awal --}}
            <div class="card p-6 flex items-start gap-4 border-2 {{ $preTestCompleted ? 'border-emerald-200 bg-emerald-50/20' : ($counselorSelected ? 'border-forest-600 ring-4 ring-forest-600/10' : 'border-slate-200') }}">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 font-sans font-black text-sm {{ $preTestCompleted ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-700' }}">
                    {{ $preTestCompleted ? '✓' : '4' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2">
                        <h4 class="font-sans text-base font-bold text-slate-900">Langkah 4: Instrumen Well-Being & Ide Bunuh Diri (Awal)</h4>
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ $preTestCompleted ? 'bg-emerald-100 text-forest-800 border border-emerald-300' : 'bg-slate-100 text-slate-700' }}">
                            {{ $preTestCompleted ? 'Selesai (' . $preTest->total_score . ' Poin)' : 'Belum Selesai' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        Pemetaan 6 dimensi kesejahteraan psikologis dan daya lenting awal diri sebelum sesi konseling daring.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2.5">
                        <a href="{{ route('konseli.wellbeing.index') }}" class="{{ $preTestCompleted ? 'btn-secondary' : 'btn-primary' }} text-xs px-4 py-2">
                            {{ $preTestCompleted ? 'Lihat Hasil Asesmen' : 'Mulai Pengisian Instrumen' }}
                        </a>
                        @if($preTestCompleted)
                            <a href="{{ route('konseli.wellbeing.pdf', 'pre_test') }}" target="_blank" class="btn-primary text-xs px-4 py-2">
                                Unduh Hasil (PDF)
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Langkah 5: Chat & Jadwal Meet/Zoom --}}
            <div class="card p-6 flex items-start gap-4 border-2 {{ $hasScheduleOrChat ? 'border-emerald-200 bg-emerald-50/20' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 font-sans font-black text-sm {{ $hasScheduleOrChat ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-700' }}">
                    {{ $hasScheduleOrChat ? '✓' : '5' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2">
                        <h4 class="font-sans text-base font-bold text-slate-900">Langkah 5: Penjadwalan Konseling (Chat & Link Meet/Zoom)</h4>
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ ($activeSession && $activeSession->meeting_url) ? 'bg-sky-100 text-sky-800 border border-sky-300' : 'bg-slate-100 text-slate-700' }}">
                            {{ ($activeSession && $activeSession->meeting_url) ? 'Jadwal Aktif' : 'Ruang Chat' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        Kirim pesan kepada konselormu untuk menyepakati waktu dan ikuti sesi konseling daring melalui Google Meet atau Zoom.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2.5">
                        <a href="{{ route('konseli.counseling.index') }}" class="btn-primary text-xs px-4 py-2">
                            Buka Chat & Lihat Jadwal
                        </a>
                    </div>
                </div>
            </div>

            {{-- Langkah 6: Lembar Refleksi --}}
            <div class="card p-6 flex items-start gap-4 border-2 {{ $hasReflection ? 'border-emerald-200 bg-emerald-50/20' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 font-sans font-black text-sm {{ $hasReflection ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-700' }}">
                    {{ $hasReflection ? '✓' : '6' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2">
                        <h4 class="font-sans text-base font-bold text-slate-900">Langkah 6: Mengisi Instrumen Refleksi Selesai Sesi</h4>
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ $hasReflection ? 'bg-emerald-100 text-forest-800 border border-emerald-300' : 'bg-slate-100 text-slate-700' }}">
                            {{ $hasReflection ? 'Refleksi Tersimpan' : 'Belum Diisi' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        Tuliskan pemahaman baru, nilai budaya nusantara penguat diri, dan satu komitmen langkah kecil pasca sesi konseling.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('konseli.reflection.index') }}" class="{{ $hasReflection ? 'btn-secondary' : 'btn-primary' }} text-xs px-4 py-2">
                            {{ $hasReflection ? 'Lihat / Tambah Refleksi' : 'Isi Lembar Refleksi' }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Langkah 7: Asesmen Sesudah --}}
            <div class="card p-6 flex items-start gap-4 border-2 {{ $postTestCompleted ? 'border-emerald-200 bg-emerald-50/20' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 font-sans font-black text-sm {{ $postTestCompleted ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-700' }}">
                    {{ $postTestCompleted ? '✓' : '7' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2">
                        <h4 class="font-sans text-base font-bold text-slate-900">Langkah 7: Mengisi Instrumen Well-Being (Sesudah Konseling)</h4>
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ $postTestCompleted ? 'bg-emerald-100 text-forest-800 border border-emerald-300' : 'bg-slate-100 text-slate-700' }}">
                            {{ $postTestCompleted ? 'Selesai (' . $postTest->total_score . ' Poin)' : 'Menunggu Sesi' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        Evaluasi perkembangan kesejahteraan psikologis dan pemulihan dirimu setelah mengikuti rangkaian konseling.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2.5">
                        <a href="{{ route('konseli.wellbeing.index') }}" class="{{ $postTestCompleted ? 'btn-secondary' : 'btn-primary' }} text-xs px-4 py-2">
                            {{ $postTestCompleted ? 'Lihat Hasil Sesudah Konseling' : 'Buka Asesmen Sesudah' }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Langkah 8: Evaluasi dan Tindak Lanjut --}}
            <div class="card p-6 flex items-start gap-4 border-2 {{ $hasEvaluation ? 'border-emerald-200 bg-emerald-50/20' : 'border-slate-200' }}">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 font-sans font-black text-sm {{ $hasEvaluation ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-700' }}">
                    {{ $hasEvaluation ? '✓' : '8' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2">
                        <h4 class="font-sans text-base font-bold text-slate-900">Langkah 8: Evaluasi dan Rencana Tindak Lanjut</h4>
                        <span class="text-xs font-bold px-3 py-0.5 rounded-full {{ $hasEvaluation ? 'bg-emerald-100 text-forest-800 border border-emerald-300' : 'bg-slate-100 text-slate-700' }}">
                            {{ $hasEvaluation ? 'Catatan Tersedia' : 'Rekap Pertumbuhan' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        Lihat perbandingan skor awal vs akhir serta catatan penguatan dan rekomendasi tindak lanjut dari konselor pendampingmu.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('konseli.evaluation.index') }}" class="btn-primary text-xs px-4 py-2">
                            Lihat Rekap Pertumbuhan &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
