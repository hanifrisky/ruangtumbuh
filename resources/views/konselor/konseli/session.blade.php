@extends('layouts.konselor')

@section('title', 'Manajemen Sesi Konseling - ' . $user->name)
@section('page-title', 'Sesi Konseling Online: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.konseli.wellbeing', $user) }}" class="btn-primary text-xs font-black px-4 py-2 uppercase tracking-wider">Hasil Instrumen</a>
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary text-xs font-black px-4 py-2 border-2 border-slate-300 uppercase tracking-wider">&larr; Kembali</a>
@endsection

@section('content')
<div class="space-y-8 animate-fade-in pb-16" x-data="{
    replyText: '',
    insertReply(text) {
        this.replyText = text;
        $nextTick(() => { $refs.replyInput.focus(); });
    }
}">
    {{-- Top Hashtags (10% Sky Blue) --}}
    <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-100 text-sky-800 border border-sky-300">
            #KonselingOnline
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #GoogleMeetZoom
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200">
            #PendampinganKonseli
        </span>
    </div>

    {{-- Identitas Konseli & Ringkasan Skor (30% Forest Green Poster Card) --}}
    <div class="p-6 sm:p-8 rounded-3xl bg-forest-950 text-white relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-md border-2 border-forest-900">
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-lime-200 text-forest-950 text-[10px] font-black uppercase tracking-wider mb-2 border border-lime-300">
                Profil Konseli Dampingan
            </span>
            <h3 class="font-display font-black text-2xl sm:text-3xl text-white tracking-tight uppercase">{{ $user->name }}</h3>
            <p class="text-xs sm:text-sm text-slate-300 mt-2 font-medium">
                Jenis Kelamin: <strong class="text-white">{{ $user->gender ?? '-' }}</strong> &bull;
                Kelas: <strong class="text-white">{{ $user->grade_class ?? '-' }}</strong> &bull;
                Asal Sekolah: <strong class="text-white">{{ $user->school_origin ?? '-' }}</strong> &bull;
                Email: <span class="text-white">{{ $user->email }}</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3 flex-shrink-0 relative z-10">
            <a href="{{ route('konselor.konseli.wellbeing', ['user' => $user, 'tab' => 'pre_test']) }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/25 text-center transition-all hover:scale-[1.03] group" title="Klik untuk melihat detail diagnosa Asesmen Awal">
                <span class="text-[10px] font-black uppercase tracking-wider text-slate-300 block group-hover:text-white">Asesmen Awal</span>
                <span class="text-base font-black text-white mt-0.5 block">{{ $preTest ? ($preTest->well_being_score ?? $preTest->total_score) . '/125' : 'Belum' }}</span>
                @if($preTest)
                    <span class="text-[10px] text-emerald-200 block mt-0.5 font-bold">Ide: {{ $preTest->suicide_ideation_score ?? '-' }}/60 &rarr;</span>
                @else
                    <span class="text-[10px] text-slate-400 block mt-0.5">Belum diisi</span>
                @endif
            </a>
            <a href="{{ route('konselor.konseli.wellbeing', ['user' => $user, 'tab' => 'post_test']) }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/25 text-center transition-all hover:scale-[1.03] group" title="Klik untuk melihat detail diagnosa Asesmen Sesudah">
                <span class="text-[10px] font-black uppercase tracking-wider text-lime-300 block group-hover:text-lime-200">Asesmen Sesudah</span>
                <span class="text-base font-black text-lime-200 mt-0.5 block">{{ $postTest ? ($postTest->well_being_score ?? $postTest->total_score) . '/125' : 'Belum' }}</span>
                @if($postTest)
                    <span class="text-[10px] text-lime-200 block mt-0.5 font-bold">Ide: {{ $postTest->suicide_ideation_score ?? '-' }}/60 &rarr;</span>
                @else
                    <span class="text-[10px] text-slate-400 block mt-0.5">Belum diisi</span>
                @endif
            </a>
            <a href="{{ route('konselor.konseli.wellbeing', $user) }}" class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-lime-300 hover:bg-lime-200 text-forest-950 font-black text-xs uppercase tracking-wider shadow-sm transition-all hover:scale-[1.02]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Lihat Detail Diagnosa & Butir &rarr;</span>
            </a>
        </div>
    </div>

    {{-- Crisis / Priority Alert Banner for Counselor --}}
    @php
        $sessionCrisis = ($preTest && $preTest->is_crisis) || ($postTest && $postTest->is_crisis);
        $sessionPriority = ($preTest && $preTest->is_selective_priority);
    @endphp
    @if($sessionCrisis)
        <div class="p-4 sm:p-5 rounded-2xl bg-rose-50 border-2 border-rose-400 text-rose-950 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xs">
            <div class="flex items-start gap-3">
                <span class="w-8 h-8 rounded-xl bg-rose-200 text-rose-800 flex items-center justify-center flex-shrink-0 font-bold text-sm">⚠</span>
                <div>
                    <h5 class="font-bold text-sm text-rose-900 uppercase tracking-wide">Peringatan Klinis: Risiko Ide Bunuh Diri Terindikasi</h5>
                    <p class="text-xs text-rose-800 mt-0.5 leading-relaxed">
                        Konseli memerlukan pendampingan segera pada sesi ini. Terapkan protokol keselamatan (*safety planning*) dan koordinasi rujukan bila diperlukan.
                    </p>
                </div>
            </div>
            <a href="{{ route('konselor.konseli.wellbeing', $user) }}" class="px-4 py-2 bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs rounded-xl whitespace-nowrap self-start sm:self-auto transition-colors">
                Tinjau Rincian Asesmen &rarr;
            </a>
        </div>
    @elseif($sessionPriority)
        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-300 text-amber-950 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
            <div>
                <strong class="font-bold text-amber-900">Prioritas Skrining Selektif:</strong>
                <span>Skor Well-Being konseli (&le; 80) menandakan kebutuhan penguatan pada dimensi penerimaan diri, otonomi, atau relasi.</span>
            </div>
            <a href="{{ route('konselor.konseli.wellbeing', $user) }}" class="text-xs font-bold text-amber-900 underline whitespace-nowrap">
                Lihat Profil Dimensi
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- Left Column (5 cols): Form Jadwal & Link Google Meet / Zoom (FR-06) --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="card p-6 sm:p-7 bg-white border-2 border-slate-200 rounded-3xl shadow-sm">
                <span class="text-[11px] font-black uppercase tracking-wider text-forest-800 block mb-1">Manajemen Jadwal Pertemuan</span>
                <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight mb-4">Atur Jadwal & Tautan Video</h4>

                <form action="{{ route('konselor.konseli.session.schedule', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="form-label text-xs font-bold text-slate-700">Sesi Ke-</label>
                            <input type="number" name="session_number" min="1" max="20" value="{{ old('session_number', $session->session_number ?? 1) }}" required class="form-input text-sm focus:border-forest-600 focus:ring-forest-600" />
                        </div>
                        <div>
                            <label class="form-label text-xs font-bold text-slate-700">Platform Video</label>
                            <select name="platform" required class="form-input text-sm focus:border-forest-600 focus:ring-forest-600">
                                <option value="Google Meet" {{ old('platform', $session->platform) === 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
                                <option value="Zoom" {{ old('platform', $session->platform) === 'Zoom' ? 'selected' : '' }}>Zoom</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="form-label text-xs font-bold text-slate-700">Tanggal & Waktu Sesi Konseling</label>
                        <input type="datetime-local"
                               name="scheduled_at"
                               value="{{ old('scheduled_at', $session->scheduled_at ? $session->scheduled_at->format('Y-m-d\TH:i') : '') }}"
                               required
                               class="form-input text-sm focus:border-forest-600 focus:ring-forest-600" />
                    </div>

                    <div>
                        <label class="form-label text-xs font-bold text-slate-700">Tautan / Link Google Meet atau Zoom</label>
                        <input type="url"
                               name="meeting_url"
                               value="{{ old('meeting_url', $session->meeting_url) }}"
                               required
                               placeholder="https://meet.google.com/xxx-xxxx-xxx atau https://zoom.us/j/..."
                               class="form-input text-sm focus:border-forest-600 focus:ring-forest-600" />
                    </div>

                    <div>
                        <label class="form-label text-xs font-bold text-slate-700">Status Sesi</label>
                        <select name="status" required class="form-input text-sm focus:border-forest-600 focus:ring-forest-600">
                            <option value="scheduled" {{ old('status', $session->status) === 'scheduled' ? 'selected' : '' }}>Terjadwal (Tampilkan ke Konseli)</option>
                            <option value="completed" {{ old('status', $session->status) === 'completed' ? 'selected' : '' }}>Selesai Dilaksanakan</option>
                            <option value="pending" {{ old('status', $session->status) === 'pending' ? 'selected' : '' }}>Menunggu Kesepakatan</option>
                            <option value="cancelled" {{ old('status', $session->status) === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full btn-primary py-3.5 text-xs font-black uppercase tracking-wider rounded-2xl shadow-sm">
                        ✓ Simpan Jadwal & Tautan Meet/Zoom
                    </button>
                </form>

                @if($session->meeting_url)
                    <div class="mt-5 pt-5 border-t border-slate-100">
                        <a href="{{ $session->meeting_url }}" target="_blank" class="w-full btn-sky py-3.5 text-xs font-black uppercase tracking-wider text-center block rounded-2xl shadow-sm">
                            🎥 Buka Ruang {{ $session->platform ?? 'Google Meet / Zoom' }}
                        </a>
                    </div>
                @endif
            </div>

            {{-- Form Evaluasi & Tindak Lanjut Konselor (FR-08) --}}
            <div class="card p-6 sm:p-7 bg-white border-2 border-forest-300 rounded-3xl shadow-sm">
                <span class="text-[11px] font-black uppercase tracking-wider text-forest-800 block mb-1">Langkah 8 • Evaluasi & Tindak Lanjut</span>
                <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight mb-3">Catatan Evaluasi Konselor</h4>

                <form action="{{ route('konselor.konseli.session.evaluation', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <textarea name="counselor_evaluation_notes" rows="4" class="form-input text-sm focus:border-forest-600 focus:ring-forest-600" placeholder="Tuliskan pesan penguatan, evaluasi perkembangan Well-Being, penurunan Ide Bunuh Diri, serta rencana tindak lanjut untuk konseli...">{{ old('counselor_evaluation_notes', $session->counselor_evaluation_notes) }}</textarea>
                    </div>
                    <button type="submit" class="w-full btn-primary py-3.5 text-xs font-black uppercase tracking-wider rounded-2xl shadow-sm">
                        Simpan Catatan Evaluasi
                    </button>
                </form>
            </div>
        </div>

        {{-- Right Column (7 cols): Chat Room & Refleksi Pasca-Sesi --}}
        <div class="lg:col-span-7 space-y-6">
            {{-- Chat Box (FR-05) --}}
            <div class="card bg-white border-2 border-slate-200 rounded-3xl shadow-sm flex flex-col overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div>
                        <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight">Ruang Percakapan Terbimbing</h4>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium">Diskusikan kesepakatan jadwal dan harapan sesi bersama {{ $user->name }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('konselor.konseli.wellbeing', $user) }}" class="px-3 py-1.5 rounded-full bg-forest-50 hover:bg-forest-100 border border-forest-200 text-forest-900 text-xs font-bold transition-colors inline-flex items-center gap-1.5 shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Hasil Instrumen
                        </a>
                        <span class="px-3 py-1 rounded-full bg-forest-100 border border-forest-300 text-forest-900 text-[11px] font-black flex items-center gap-1.5 uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-forest-600 animate-pulse"></span> Sesi Terbuka
                        </span>
                    </div>
                </div>

                <div class="p-5 sm:p-6 space-y-4 max-h-[420px] min-h-[300px] overflow-y-auto bg-slate-50/50" id="chat-messages-container">
                    @forelse($session->messages as $msg)
                        @php
                            $isMe = (int) $msg->sender_id === (int) auth()->id();
                        @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[82%] rounded-2xl px-4 py-3 shadow-sm {{ $isMe ? 'bg-forest-950 text-white rounded-br-none' : 'bg-white border-2 border-slate-200 text-slate-800 rounded-bl-none' }}">
                                <div class="flex items-center justify-between gap-3 mb-1.5">
                                    <span class="text-[10px] font-black uppercase tracking-wider {{ $isMe ? 'text-lime-300' : 'text-forest-800' }}">
                                        {{ $isMe ? 'Anda (Konselor)' : $user->name }}
                                    </span>
                                    <span class="text-[10px] {{ $isMe ? 'text-slate-300' : 'text-slate-400' }}">
                                        {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M • H:i') }} WIB
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm leading-relaxed whitespace-pre-line font-medium">{{ $msg->message }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xs text-slate-400 font-medium">Belum ada percakapan dengan konseli ini. Mulai dengan menyapa konseli menggunakan balasan cepat di bawah.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Quick Reply Chips for Counselor (10% Sky Blue Accents) --}}
                <div class="px-5 pt-3 pb-2.5 bg-white border-t border-slate-100 flex items-center gap-2 overflow-x-auto">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 flex-shrink-0">Pintasan Pesan:</span>
                    <button type="button"
                            @click="insertReply('Halo! Terima kasih sudah mengisi instrumen awal. Apakah kamu luang untuk sesi konseling online via Google Meet besok sore?')"
                            class="text-[11px] font-bold px-3.5 py-1.5 rounded-full bg-sky-50 hover:bg-sky-100 text-sky-800 transition-colors whitespace-nowrap border border-sky-200">
                        👋 Sapa & tawarkan jadwal
                    </button>
                    <button type="button"
                            @click="insertReply('Baik, jadwal dan tautan Google Meet sudah saya sematkan di halaman konselingmu ya. Sampai jumpa di sesi kita!')"
                            class="text-[11px] font-bold px-3.5 py-1.5 rounded-full bg-forest-50 hover:bg-forest-100 text-forest-800 transition-colors whitespace-nowrap border border-forest-200">
                        ✅ Konfirmasi link Meet telah disematkan
                    </button>
                </div>

                <form action="{{ route('konselor.konseli.session.chat', $user) }}" method="POST" class="p-4 sm:p-5 bg-white border-t border-slate-100">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3">
                        <textarea x-ref="replyInput"
                                  x-model="replyText"
                                  name="message"
                                  rows="2"
                                  required
                                  class="form-input flex-1 text-sm resize-none rounded-2xl focus:border-forest-600 focus:ring-forest-600"
                                  placeholder="Balas pesan konseli dengan hangat dan menenangkan..."></textarea>
                        <button type="submit" class="btn-primary px-6 py-3 font-black text-xs uppercase tracking-wider rounded-2xl sm:self-end shadow-sm">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Hasil Instrumen Refleksi Pasca-Sesi (FR-07) --}}
            <div class="card p-6 sm:p-7 bg-white border-2 border-slate-200 rounded-3xl shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h4 class="font-display text-lg font-black text-forest-950 uppercase tracking-tight">Hasil Refleksi Diri Pasca-Sesi</h4>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-xs font-black">{{ $session->reflections->count() }} Lembar</span>
                </div>

                @forelse($session->reflections->sortByDesc('submitted_at') as $ref)
                    <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 border-2 border-slate-200 space-y-4 text-xs sm:text-sm">
                        <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                            <span class="font-black text-forest-900 bg-forest-100 px-3 py-1 rounded-full border border-forest-300 text-xs uppercase tracking-wider">
                                ✓ Refleksi Selesai Sesi
                            </span>
                            <span class="text-xs font-bold text-slate-500">{{ $ref->submitted_at ? $ref->submitted_at->timezone('Asia/Jakarta')->format('d M Y • H:i') : '' }} WIB</span>
                        </div>
                        <div>
                            <p class="font-black text-forest-950">1. Pemahaman baru tentang pikiran, perasaan, atau cara memandang masalah:</p>
                            <p class="text-slate-700 mt-1 leading-relaxed font-medium">{{ $ref->answer_1 }}</p>
                        </div>
                        <div>
                            <p class="font-black text-forest-950">2. Nilai pengalaman hidup, budaya (kearifan lokal), atau dukungan sosial:</p>
                            <p class="text-slate-700 mt-1 leading-relaxed font-medium">{{ $ref->answer_2 }}</p>
                        </div>
                        <div>
                            <p class="font-black text-forest-950">3. Langkah kecil yang akan dilakukan setelah sesi:</p>
                            <p class="text-slate-700 mt-1 leading-relaxed font-medium">{{ $ref->answer_3 }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 py-6 text-center font-medium">Konseli belum mengisi Instrumen Refleksi Pasca-Sesi.</p>
                @endforelse
            </div>
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
