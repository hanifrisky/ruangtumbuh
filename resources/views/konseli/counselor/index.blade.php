@extends('layouts.konseli')

@section('title', 'Pilih Konselor - Ruang Tumbuh')

@section('content')
<div class="space-y-6 animate-fade-in pb-16" x-data="{
    searchQuery: '',
    confirmModal: false,
    targetCounselorId: null,
    targetCounselorName: '',
    targetFormUrl: '',
    openConfirm(id, name, url) {
        this.targetCounselorId = id;
        this.targetCounselorName = name;
        this.targetFormUrl = url;
        this.confirmModal = true;
    }
}">
    {{-- Header Banner in 30% Deep Green --}}
    <div class="card-forest p-7 sm:p-9 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="space-y-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-emerald-200 text-xs font-bold uppercase tracking-wider">
                    Langkah 3 • Direktori 12 Konselor Ahli
                </span>
                <h2 class="font-sans text-2xl sm:text-3xl font-black text-white tracking-tight">
                    Pilih Konselor Pendamping Kamu
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl leading-relaxed font-light">
                    Pilihlah konselor yang membuatmu merasa nyaman untuk bercerita. Seluruh konselor Ruang Tumbuh adalah akademisi dan praktisi Bimbingan & Konseling profesional yang siap mendampingimu.
                </p>
            </div>
            @if($selectedCounselorId)
                <a href="{{ route('konseli.counseling.index') }}" class="btn-sky py-3 px-6 text-xs flex-shrink-0 font-bold">
                    Buka Chat & Jadwal &rarr;
                </a>
            @endif
        </div>

        {{-- Search Bar --}}
        <div class="mt-6 pt-5 border-t border-white/15 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="relative flex-1 max-w-md">
                <input type="text"
                       x-model="searchQuery"
                       placeholder="Cari nama konselor atau pesan penguat..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white/15 border border-white/20 text-white placeholder-emerald-200 text-xs sm:text-sm focus:bg-white focus:text-slate-900 focus:placeholder-slate-400 focus:outline-none transition-all" />
                <svg class="w-4 h-4 text-emerald-200 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <span class="text-xs font-bold text-emerald-200">
                12 Konselor Profesional BK FIP UM Tersedia
            </span>
        </div>
    </div>

    @if($counselors->isEmpty())
        <div class="card p-12 text-center bg-white border border-slate-200">
            <h4 class="font-sans text-lg font-bold text-slate-800">Belum Ada Konselor Aktif</h4>
            <p class="text-sm text-slate-500 mt-1">Silakan hubungi administrator Ruang Tumbuh.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($counselors as $index => $counselor)
                @php
                    $profile = $counselor->counselorProfile;
                    $isSelected = $counselor->id == $selectedCounselorId;
                    $photoUrl = null;
                    if ($profile && $profile->photo_path) {
                        if (file_exists(public_path($profile->photo_path))) {
                            $photoUrl = asset($profile->photo_path);
                        } elseif (file_exists(public_path('storage/' . $profile->photo_path))) {
                            $photoUrl = asset('storage/' . $profile->photo_path);
                        }
                    }
                    $searchText = strtolower($counselor->name . ' ' . ($profile->motto ?? '') . ' ' . ($profile->description ?? ''));
                @endphp
                {{-- 60% White Card with Green Active State --}}
                <div x-show="!searchQuery || '{{ addslashes($searchText) }}'.includes(searchQuery.toLowerCase())"
                     class="card p-6 flex flex-col justify-between bg-white relative transition-all duration-300 hover:-translate-y-1 border-2 {{ $isSelected ? 'border-forest-700 ring-4 ring-forest-700/10' : 'border-slate-200 hover:border-forest-500' }}">

                    @if($isSelected)
                        <div class="absolute top-4 right-4 inline-flex items-center gap-1 bg-forest-800 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                            ✓ Konselor Pilihanmu
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-forest-900 to-forest-800 border-2 border-slate-200 overflow-hidden flex-shrink-0 flex items-center justify-center font-sans font-black text-white text-xl shadow-md">
                                @if($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="Foto {{ $counselor->name }}" class="w-full h-full object-cover object-top">
                                @else
                                    {{ strtoupper(substr(preg_replace('/^(Prof\.|Dr\.|M\.|Muh\.)\s*/i', '', $counselor->name), 0, 2)) }}
                                @endif
                            </div>
                            <div class="min-w-0 {{ $isSelected ? 'pr-28' : '' }}">
                                <span class="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-forest-800 bg-forest-50 px-2 py-0.5 rounded-md border border-forest-200 mb-1">
                                    Konselor #{{ $profile->order_number ?? ($index + 1) }}
                                </span>
                                <h4 class="font-sans font-bold text-slate-900 text-sm sm:text-base leading-snug">{{ $counselor->name }}</h4>
                                <p class="text-[11px] font-bold text-emerald-700 mt-0.5 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Siap Mendampingi</span>
                                </p>
                            </div>
                        </div>

                        @if($profile && $profile->motto)
                            <div class="mt-4 p-3.5 bg-slate-50 rounded-2xl border border-slate-200 text-xs italic text-slate-800 leading-relaxed">
                                <span class="font-black text-forest-800 not-italic block text-[10px] uppercase tracking-wider mb-0.5">Pesan Penguat:</span>
                                &ldquo;{{ $profile->motto }}&rdquo;
                            </div>
                        @endif

                        @if($profile && $profile->description)
                            <p class="text-xs text-slate-600 mt-3.5 leading-relaxed font-normal whitespace-pre-line">
                                {{ $profile->description }}
                            </p>
                        @endif
                    </div>

                    <div class="space-y-2 mt-6 pt-4 border-t border-slate-200">
                        @if($isSelected)
                            <a href="{{ route('konseli.counseling.index') }}" class="w-full btn-success py-3 text-xs font-black uppercase tracking-wider text-center block">
                                Buka Chat & Jadwal Sesi &rarr;
                            </a>
                        @else
                            <button type="button"
                                    @click="openConfirm({{ $counselor->id }}, '{{ addslashes($counselor->name) }}', '{{ route('konseli.counselor.select', $counselor) }}')"
                                    class="w-full btn-primary py-3 text-xs font-black uppercase tracking-wider text-center">
                                Pilih Konselor Ini
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Confirmation Modal --}}
    <div x-show="confirmModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-forest-950/70 backdrop-blur-sm animate-fade-in"
         @keydown.escape.window="confirmModal = false">
        <div @click.outside="confirmModal = false"
             class="w-full max-w-md bg-white rounded-3xl border border-slate-200 p-6 sm:p-7 shadow-2xl animate-slide-up">
            <div class="w-12 h-12 rounded-2xl bg-forest-50 text-forest-800 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-sans text-lg font-bold text-slate-900">Konfirmasi Pemilihan Konselor</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed font-normal">
                Apakah kamu ingin memilih <strong class="text-forest-900" x-text="targetCounselorName"></strong> sebagai konselor pendampingmu di Ruang Tumbuh?
            </p>
            <div class="mt-6 flex items-center justify-end gap-2.5">
                <button type="button" @click="confirmModal = false" class="btn-secondary py-2.5 px-4 text-xs font-bold">
                    Batal
                </button>
                <form :action="targetFormUrl" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary py-2.5 px-5 text-xs font-bold">
                        Ya, Pilih & Lanjutkan &rarr;
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
