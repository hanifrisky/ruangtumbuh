@extends('layouts.konselor')

@section('title', 'Dashboard Konseling - Ruang Tumbuh')
@section('page-title', 'Studio Konselor Ruang Tumbuh')

@section('content')
@php
    $totalKonseli = $konseliList->total();
    $scheduledCount = $konseliList->getCollection()->filter(fn($k) => $k->active_session && $k->active_session->meeting_url)->count();
    $crisisCount = $konseliList->getCollection()->filter(fn($k) => ($k->pre_test && $k->pre_test->is_crisis) || ($k->post_test && $k->post_test->is_crisis))->count();
    $priorityCount = $konseliList->getCollection()->filter(fn($k) => ($k->unread_messages_count ?? 0) > 0 || ($k->pre_test && $k->pre_test->is_selective_priority))->count();
@endphp

<div class="space-y-6 animate-fade-in">
    {{-- 30% Green Counselor Header Banner (Inspired by Poster Bottom Section) --}}
    <div class="card-forest p-6 sm:p-8">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-emerald-200 text-xs font-bold uppercase tracking-wider mb-2">
            Panel Konselor Ahli BK FIP Universitas Negeri Malang
        </span>
        <h3 class="font-sans text-xl sm:text-2xl font-black text-white">Selamat Datang, {{ auth()->user()->name }}</h3>
        <p class="text-xs sm:text-sm text-emerald-100 mt-1 max-w-3xl leading-relaxed font-light">
            Pantau perkembangan konseli secara berkala, prioritaskan siswa dengan indikator krisis ide bunuh diri atau skor well-being rendah (&le; 80), dan atur jadwal konseling daring.
        </p>
    </div>

    {{-- Ringkasan Hari Ini (60% White Base Cards) --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="card p-5 bg-white border border-slate-200 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-forest-50 text-forest-800 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-500 block">Konseli Terdaftar</span>
                <p class="font-sans text-2xl font-black text-slate-900">{{ $totalKonseli }} <span class="text-xs font-normal text-slate-400">Siswa</span></p>
            </div>
        </div>

        <div class="card p-5 bg-white border border-slate-200 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-forest-800 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-500 block">Jadwal Sesi Aktif</span>
                <p class="font-sans text-2xl font-black text-forest-800">{{ $scheduledCount }} <span class="text-xs font-normal text-slate-400">Pertemuan</span></p>
            </div>
        </div>

        <div class="card p-5 bg-white border border-slate-200 flex items-center gap-4 shadow-sm {{ $crisisCount > 0 ? 'border-rose-400 bg-rose-50/30' : '' }}">
            <div class="w-12 h-12 rounded-2xl {{ $crisisCount > 0 ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center flex-shrink-0">
                <span class="text-lg font-black">⚠</span>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-500 block">Peringatan Krisis</span>
                <p class="font-sans text-2xl font-black {{ $crisisCount > 0 ? 'text-rose-700' : 'text-slate-900' }}">{{ $crisisCount }} <span class="text-xs font-normal text-slate-400">Siswa</span></p>
            </div>
        </div>

        <div class="card p-5 bg-white border border-slate-200 flex items-center gap-4 shadow-sm {{ $priorityCount > 0 ? 'border-amber-300 bg-amber-50/20' : '' }}">
            <div class="w-12 h-12 rounded-2xl {{ $priorityCount > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-500 block">Prioritas Skrining (&le; 80)</span>
                <p class="font-sans text-2xl font-black {{ $priorityCount > 0 ? 'text-amber-800' : 'text-slate-900' }}">{{ $priorityCount }} <span class="text-xs font-normal text-slate-400">Konseli</span></p>
            </div>
        </div>
    </div>

    {{-- Table of Counselors' Students (60% White Card) --}}
    <div class="card bg-white border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-200 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h4 class="font-sans font-bold text-slate-900 text-base sm:text-lg">Daftar Konseli yang Didampingi</h4>
                <p class="text-xs text-slate-500 mt-0.5 font-light">Pantau status pengerjaan instrumen dan jadwal tatap muka daring</p>
            </div>
            <span class="bg-forest-50 text-forest-800 text-xs px-3.5 py-1 rounded-full font-bold border border-forest-200 whitespace-nowrap">
                {{ $konseliList->total() }} Konseli Terdaftar
            </span>
        </div>

        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200">
            <form action="{{ route('konselor.dashboard') }}" method="GET" class="flex flex-col sm:flex-row items-center justify-end gap-3 w-full">
                @if(request('per_page'))
                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                @endif
                <div class="relative w-full sm:w-80">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari siswa, email, atau sekolah..."
                           class="w-full form-input bg-white py-2.5 text-xs font-semibold" />
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <button type="submit" class="btn-primary text-xs px-5 py-2.5 font-bold">
                        Cari
                    </button>
                    @if(request()->filled('search') || request()->filled('per_page'))
                        <a href="{{ route('konselor.dashboard') }}" class="btn-secondary text-xs px-4 py-2.5 font-bold">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if($konseliList->isEmpty())
            <div class="text-center py-16">
                <h4 class="font-sans font-bold text-slate-800 text-lg">Belum Ada Konseli</h4>
                <p class="text-sm text-slate-500 mt-1 font-light">Saat ini belum ada konseli yang memilih Anda sebagai pendamping.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[780px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-bold border-b border-slate-200 text-left">
                            <th class="py-4 px-6">Identitas Konseli</th>
                            <th class="py-4 px-4 text-center whitespace-nowrap">Awal Konseling</th>
                            <th class="py-4 px-4 text-center whitespace-nowrap">Sesudah Konseling</th>
                            <th class="py-4 px-4 text-center whitespace-nowrap">Status Jadwal & Refleksi</th>
                            <th class="py-4 px-6 w-80 text-center whitespace-nowrap">Aksi Konselor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm">
                        @foreach($konseliList as $konseli)
                            @php
                                $isCrisis = ($konseli->pre_test && $konseli->pre_test->is_crisis) || ($konseli->post_test && $konseli->post_test->is_crisis);
                                $isPriority = ($konseli->pre_test && $konseli->pre_test->is_selective_priority);
                            @endphp
                            <tr class="text-slate-700 hover:bg-slate-50/60 transition-colors {{ $isCrisis ? 'bg-rose-50/40' : ($isPriority ? 'bg-amber-50/30' : '') }}">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <h5 class="font-sans font-bold text-slate-900 text-sm">{{ $konseli->name }}</h5>
                                        @if($isCrisis)
                                            <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 border border-rose-300 animate-pulse">
                                                ⚠ Krisis
                                            </span>
                                        @elseif($isPriority)
                                            <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-300">
                                                Prioritas (&le; 80)
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5 font-medium">
                                        {{ $konseli->gender ?? '-' }} &bull; Kelas {{ $konseli->grade_class ?? '-' }} &bull; {{ $konseli->school_origin ?? '-' }}
                                    </p>
                                    <p class="text-[11px] text-slate-400 font-light">{{ $konseli->email }}</p>
                                </td>
                                <td class="text-center px-4">
                                    @if($konseli->pre_test && $konseli->pre_test->status === 'completed')
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-xs font-bold text-forest-800 bg-forest-50 border border-forest-200 px-2.5 py-0.5 rounded-full">
                                                WB: {{ $konseli->pre_test->well_being_score ?? $konseli->pre_test->total_score }}/125
                                            </span>
                                            <span class="text-[11px] font-bold {{ $konseli->pre_test->is_crisis ? 'text-rose-700 bg-rose-50 border border-rose-200' : 'text-slate-600 bg-slate-100' }} px-2 py-0.5 rounded-full">
                                                Ide: {{ $konseli->pre_test->suicide_ideation_score ?? '-' }}/60
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum mengisi</span>
                                    @endif
                                </td>
                                <td class="text-center px-4">
                                    @if($konseli->post_test && $konseli->post_test->status === 'completed')
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full">
                                                WB: {{ $konseli->post_test->well_being_score ?? $konseli->post_test->total_score }}/125
                                            </span>
                                            <span class="text-[11px] font-bold {{ $konseli->post_test->is_crisis ? 'text-rose-700 bg-rose-50 border border-rose-200' : 'text-slate-600 bg-slate-100' }} px-2 py-0.5 rounded-full">
                                                Ide: {{ $konseli->post_test->suicide_ideation_score ?? '-' }}/60
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum mengisi</span>
                                    @endif
                                </td>
                                <td class="text-center whitespace-nowrap px-4">
                                    <div class="flex flex-col items-center gap-1">
                                        @if($konseli->active_session && $konseli->active_session->meeting_url)
                                            <span class="text-[11px] font-bold text-sky-800 bg-sky-50 border border-sky-200 px-2.5 py-0.5 rounded-full">
                                                ● {{ $konseli->active_session->platform ?? 'Meet/Zoom' }} Aktif
                                            </span>
                                        @else
                                            <span class="text-[11px] font-bold text-slate-500 bg-slate-100 border border-slate-200 px-2.5 py-0.5 rounded-full">
                                                Belum Dijadwalkan
                                            </span>
                                        @endif
                                        <span class="text-[11px] text-slate-500">
                                            Refleksi: <strong>{{ $konseli->active_session->reflections_count ?? 0 }} Sesi</strong>
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6">
                                    <div class="flex flex-col gap-1.5 justify-center">
                                        <a href="{{ route('konselor.konseli.session', $konseli) }}" class="btn-primary text-xs py-2 text-center flex items-center justify-center gap-1.5 font-bold">
                                            <span>Kelola Sesi & Chat</span>
                                            @if(($konseli->unread_messages_count ?? 0) > 0)
                                                <span class="px-2 py-0.5 rounded-full bg-sky-500 text-white font-black text-[10px]">
                                                    {{ $konseli->unread_messages_count }} Baru
                                                </span>
                                            @endif
                                        </a>
                                        <a href="{{ route('konselor.konseli.wellbeing', $konseli) }}" class="btn-secondary text-xs py-1.5 text-center font-bold">
                                            Hasil Asesmen & PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
