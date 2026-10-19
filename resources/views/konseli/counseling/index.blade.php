@extends('layouts.konseli')

@section('title', 'Chat & Jadwal Konseling Online - Ruang Tumbuh')

@section('content')
@php
    $konselor = $session->konselor;
    $profile = $konselor->counselorProfile;
@endphp

<div class="space-y-6 animate-fade-in pb-16" x-data="{
    chatText: '',
    insertPrompt(text) {
        this.chatText = text;
        $nextTick(() => { $refs.messageInput.focus(); });
    }
}">
    {{-- Header --}}
    <div class="border-b border-slate-200 pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <span class="text-xs font-black uppercase tracking-wider text-forest-700 block mb-1">Langkah 5 • Ruang Konseling & Janji Temu</span>
            <h2 class="font-sans text-2xl font-black text-slate-900">Ruang Chat & Penjadwalan Daring</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Diskusikan waktu luangmu dengan konselor dan ikuti sesi konseling via <strong>Google Meet / Zoom</strong>.
            </p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('konseli.reflection.index') }}" class="btn-secondary text-xs font-bold px-4 py-2">
                Langkah 6: Lembar Refleksi &rarr;
            </a>
            <a href="{{ route('konseli.evaluation.index') }}" class="btn-primary text-xs font-bold px-4 py-2">
                Evaluasi Diri
            </a>
        </div>
    </div>

    {{-- 30% Green Master Live Session Ticket (Sticky Meeting Banner) --}}
    <div class="card-forest p-6 sm:p-7 relative overflow-hidden">
        {{-- Decorative Glow Blobs --}}
        <div class="absolute -top-16 -left-16 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-lime-400/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div class="space-y-2">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20 text-emerald-200 text-[11px] font-black uppercase tracking-wider">
                        Sesi Tatap Maya • Sesi #{{ $session->session_number }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider {{ $session->status === 'scheduled' ? 'bg-emerald-400/20 border border-emerald-300/40 text-emerald-200' : 'bg-lime-400/20 border border-lime-300/40 text-lime-200' }}">
                        @if($session->status === 'scheduled')
                            ● Jadwal Aktif
                        @elseif($session->status === 'completed')
                            ✓ Sesi Selesai
                        @else
                            ⏳ Menunggu Janji Temu
                        @endif
                    </span>
                </div>

                @if($session->scheduled_at || $session->meeting_url)
                    <h3 class="font-sans text-xl sm:text-2xl font-black text-white">
                        {{ $session->scheduled_at ? $session->scheduled_at->format('d F Y • H:i') . ' WIB' : 'Jadwal Konseling Online' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-emerald-100">
                        Platform: <strong class="text-white">{{ $session->platform ?? 'Google Meet / Zoom' }}</strong> bersama <strong>{{ $konselor->name }}</strong>
                    </p>
                @else
                    <h3 class="font-sans text-lg font-black text-white">
                        Jadwal Belum Disepakati
                    </h3>
                    <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl leading-relaxed font-light">
                        Kirimkan pesan di kolom obrolan bawah kepada <strong>{{ $konselor->name }}</strong> untuk menyepakati hari dan jam sesi konseling online kamu.
                    </p>
                @endif
            </div>

            @if($session->meeting_url)
                <div class="flex flex-col sm:flex-row lg:flex-col items-stretch sm:items-center lg:items-end gap-2 flex-shrink-0">
                    {{-- 10% Sky Blue Button for Video Conference Room --}}
                    <a href="{{ $session->meeting_url }}" target="_blank" class="btn-sky px-6 py-3.5 text-xs font-black shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        Masuk Ruang {{ $session->platform ?? 'Meet / Zoom' }} &rarr;
                    </a>
                    <span class="text-[11px] text-emerald-200 font-semibold text-center lg:text-right">Buka link saat waktu sesi tiba</span>
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- Left Column (60% White Card): Konselor Profile --}}
        <div class="lg:col-span-4 space-y-5">
            <div class="card p-6 bg-white border border-slate-200 shadow-sm">
                <span class="text-[10px] font-black uppercase tracking-widest text-forest-700 block mb-3">Konselor Pendampingmu</span>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-forest-900 to-forest-800 text-white font-sans font-black flex items-center justify-center text-xl flex-shrink-0 overflow-hidden shadow-md">
                        @if($profile && $profile->photo_path && file_exists(public_path($profile->photo_path)))
                            <img src="{{ asset($profile->photo_path) }}" alt="{{ $konselor->name }}" class="w-full h-full object-cover object-top">
                        @else
                            {{ strtoupper(substr($konselor->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-sans font-bold text-slate-900 text-sm sm:text-base leading-snug">{{ $konselor->name }}</h4>
                        <p class="text-xs text-emerald-700 font-bold mt-0.5">● Konselor Pendamping</p>
                    </div>
                </div>

                @if($profile && $profile->motto)
                    <div class="mt-4 p-3.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs italic text-slate-800 leading-relaxed">
                        &ldquo;{{ $profile->motto }}&rdquo;
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-slate-200 flex items-center justify-between gap-2">
                    <a href="{{ route('konseli.counselor.index') }}" class="text-xs font-bold text-forest-800 hover:text-forest-950">
                        Ganti Konselor &rarr;
                    </a>
                    @if($profile && $profile->whatsapp_number)
                        <a href="{{ $profile->whatsapp_url }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                            WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            {{-- Tips Berbicara --}}
            <div class="card p-5 bg-slate-50 border border-slate-200 space-y-2 text-xs">
                <h5 class="font-sans font-bold text-slate-900">Petunjuk Janji Temu</h5>
                <p class="text-slate-600 leading-relaxed font-normal">
                    Sampaikan hari dan jam luangmu. Konselor akan mencocokkan waktu dan menyematkan link Google Meet / Zoom di tiket sesi di atas.
                </p>
            </div>
        </div>

        {{-- Right Column (60% White Card): Chat Box --}}
        <div class="lg:col-span-8 card bg-white border border-slate-200 flex flex-col overflow-hidden shadow-sm">
            <div class="p-5 border-b border-slate-200 bg-slate-50/70 flex items-center justify-between gap-3">
                <div>
                    <h3 class="font-sans font-bold text-slate-900 text-base">Percakapan Chat dengan {{ $konselor->name }}</h3>
                    <p class="text-xs text-slate-500">Ruang obrolan pribadi & rahasia untuk kesepakatan sesi</p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-bold">
                    ● Terhubung
                </span>
            </div>

            {{-- Messages List --}}
            <div class="p-5 space-y-3.5 max-h-[420px] min-h-[320px] overflow-y-auto bg-slate-50/50" id="chat-messages-container">
                @forelse($session->messages as $msg)
                    @php
                        $isMe = $msg->sender_id === auth()->id();
                    @endphp
                    <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] sm:max-w-[75%] rounded-3xl px-5 py-3.5 shadow-sm {{ $isMe ? 'bg-forest-800 text-white rounded-br-sm' : 'bg-white border border-slate-200 text-slate-900 rounded-bl-sm' }}">
                            <div class="flex items-center justify-between gap-3 mb-1">
                                <span class="text-[10px] font-black uppercase tracking-wider {{ $isMe ? 'text-emerald-200' : 'text-forest-800' }}">
                                    {{ $isMe ? 'Kamu' : $konselor->name }}
                                </span>
                                <span class="text-[10px] {{ $isMe ? 'text-emerald-200' : 'text-slate-400' }}">
                                    {{ $msg->created_at->format('d M • H:i') }} WIB
                                </span>
                            </div>
                            <p class="text-xs sm:text-sm leading-relaxed whitespace-pre-line">{{ $msg->message }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 px-4">
                        <div class="w-12 h-12 rounded-2xl bg-forest-50 text-forest-800 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <p class="font-sans font-bold text-slate-800 text-base">Sapa Konselor Pendampingmu</p>
                        <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto leading-relaxed">
                            Ketik pesan atau pilih salah satu pesan cepat di bawah ini untuk membuat janji konseling online.
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- Quick Prompts --}}
            <div class="px-5 pt-3 pb-2 bg-white border-t border-slate-200 flex items-center gap-2 overflow-x-auto">
                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 flex-shrink-0">Pesan Cepat:</span>
                <button type="button"
                        @click="insertPrompt('Halo Bapak/Ibu, saya ingin membuat janji sesi konseling online via Google Meet.')"
                        class="text-[11px] font-semibold px-3.5 py-1 rounded-full bg-slate-100 hover:bg-forest-50 hover:text-forest-800 text-slate-700 transition-colors whitespace-nowrap">
                    👋 Buat janji konseling
                </button>
                <button type="button"
                        @click="insertPrompt('Apakah Bapak/Ibu luang untuk sesi daring besok sore sekitar pukul 15.30 WIB?')"
                        class="text-[11px] font-semibold px-3.5 py-1 rounded-full bg-slate-100 hover:bg-forest-50 hover:text-forest-800 text-slate-700 transition-colors whitespace-nowrap">
                    📅 Tanyakan jadwal besok
                </button>
            </div>

            {{-- Message Input Form --}}
            <form action="{{ route('konseli.counseling.chat.send') }}" method="POST" class="p-4 bg-white border-t border-slate-200">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2.5">
                    <textarea x-ref="messageInput"
                              x-model="chatText"
                              name="message"
                              rows="2"
                              required
                              class="form-input flex-1 text-sm resize-none"
                              placeholder="Tulis pesan ke konselormu..."></textarea>
                    <button type="submit" class="btn-primary px-6 py-3 font-black text-xs uppercase tracking-wider flex items-center justify-center gap-1.5 self-end sm:self-stretch">
                        <span>Kirim</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('chat-messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
@endpush
@endsection
