@extends('layouts.konselor')

@section('title', 'Manajemen Sesi Konseling - ' . $user->name)
@section('page-title', 'Sesi Konseling Online: ' . $user->name)

@section('header-actions')
<a href="{{ route('konselor.konseli.wellbeing', $user) }}" class="btn-primary text-xs font-bold px-4 py-2">Hasil Instrumen</a>
<a href="{{ route('konselor.dashboard') }}" class="btn-secondary text-xs font-bold px-4 py-2">&larr; Kembali</a>
@endsection

@section('content')
<div class="space-y-8 animate-fade-in pb-16" x-data="{
    replyText: '',
    insertReply(text) {
        this.replyText = text;
        $nextTick(() => { $refs.replyInput.focus(); });
    }
}">
    {{-- Identitas Konseli & Ringkasan Skor --}}
    <div class="card-forest p-6 sm:p-8 rounded-3xl relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-sm">
        <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-sand-200 text-[11px] font-bold uppercase tracking-wider mb-2">
                Profil Konseli Dampingan
            </span>
            <h3 class="font-serif text-2xl sm:text-3xl font-normal text-white">{{ $user->name }}</h3>
            <p class="text-xs sm:text-sm text-sand-200/90 mt-2 font-light">
                Jenis Kelamin: <strong class="text-white">{{ $user->gender ?? '-' }}</strong> &bull;
                Kelas: <strong class="text-white">{{ $user->grade_class ?? '-' }}</strong> &bull;
                Asal Sekolah: <strong class="text-white">{{ $user->school_origin ?? '-' }}</strong> &bull;
                Email: <span class="text-white">{{ $user->email }}</span>
            </p>
        </div>
        <div class="flex flex-wrap gap-3 flex-shrink-0 relative z-10">
            <div class="px-5 py-3 rounded-2xl bg-white/10 border border-white/15 text-center">
                <span class="text-[10px] font-bold uppercase tracking-wider text-sand-300 block">Awal Konseling</span>
                <span class="text-base font-extrabold text-white mt-0.5 block">{{ $preTest ? $preTest->total_score . ' Poin' : 'Belum' }}</span>
            </div>
            <div class="px-5 py-3 rounded-2xl bg-white/10 border border-white/15 text-center">
                <span class="text-[10px] font-bold uppercase tracking-wider text-sage-200 block">Sesudah Konseling</span>
                <span class="text-base font-extrabold text-white mt-0.5 block">{{ $postTest ? $postTest->total_score . ' Poin' : 'Belum' }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- Left Column (5 cols): Form Jadwal & Link Google Meet / Zoom (FR-06) --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm">
                <span class="text-[11px] font-bold uppercase tracking-wider text-forest-700 block mb-1">Manajemen Jadwal Pertemuan</span>
                <h4 class="font-serif text-lg font-normal text-ink-900 mb-4">Atur Jadwal & Tautan Video Virtual</h4>

                <form action="{{ route('konselor.konseli.session.schedule', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="form-label text-xs">Sesi Ke-</label>
                            <input type="number" name="session_number" min="1" max="20" value="{{ old('session_number', $session->session_number ?? 1) }}" required class="form-input text-sm" />
                        </div>
                        <div>
                            <label class="form-label text-xs">Platform Video</label>
                            <select name="platform" required class="form-input text-sm">
                                <option value="Google Meet" {{ old('platform', $session->platform) === 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
                                <option value="Zoom" {{ old('platform', $session->platform) === 'Zoom' ? 'selected' : '' }}>Zoom</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="form-label text-xs">Tanggal & Waktu Sesi Konseling</label>
                        <input type="datetime-local"
                               name="scheduled_at"
                               value="{{ old('scheduled_at', $session->scheduled_at ? $session->scheduled_at->format('Y-m-d\TH:i') : '') }}"
                               required
                               class="form-input text-sm" />
                    </div>

                    <div>
                        <label class="form-label text-xs">Tautan / Link Google Meet atau Zoom</label>
                        <input type="url"
                               name="meeting_url"
                               value="{{ old('meeting_url', $session->meeting_url) }}"
                               required
                               placeholder="https://meet.google.com/xxx-xxxx-xxx atau https://zoom.us/j/..."
                               class="form-input text-sm" />
                    </div>

                    <div>
                        <label class="form-label text-xs">Status Sesi</label>
                        <select name="status" required class="form-input text-sm">
                            <option value="scheduled" {{ old('status', $session->status) === 'scheduled' ? 'selected' : '' }}>Terjadwal (Tampilkan ke Konseli)</option>
                            <option value="completed" {{ old('status', $session->status) === 'completed' ? 'selected' : '' }}>Selesai Dilaksanakan</option>
                            <option value="pending" {{ old('status', $session->status) === 'pending' ? 'selected' : '' }}>Menunggu Kesepakatan</option>
                            <option value="cancelled" {{ old('status', $session->status) === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full btn-primary py-3.5 text-xs font-bold uppercase tracking-wider rounded-2xl">
                        ✓ Simpan Jadwal & Tautan Meet/Zoom
                    </button>
                </form>

                @if($session->meeting_url)
                    <div class="mt-5 pt-5 border-t border-sand-100">
                        <a href="{{ $session->meeting_url }}" target="_blank" class="w-full btn-terra py-3.5 text-xs font-bold uppercase tracking-wider text-center block rounded-2xl">
                            🎥 Buka Ruang {{ $session->platform ?? 'Google Meet / Zoom' }}
                        </a>
                    </div>
                @endif
            </div>

            {{-- Form Evaluasi & Tindak Lanjut Konselor (FR-08) --}}
            <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm">
                <span class="text-[11px] font-bold uppercase tracking-wider text-sage-700 block mb-1">Langkah 8 • Evaluasi & Tindak Lanjut</span>
                <h4 class="font-serif text-lg font-normal text-ink-900 mb-3">Catatan Evaluasi & Rekomendasi Konselor</h4>

                <form action="{{ route('konselor.konseli.session.evaluation', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <textarea name="counselor_evaluation_notes" rows="4" class="form-input text-sm" placeholder="Tuliskan pesan penguatan, evaluasi perkembangan Well-Being, penurunan Ide Bunuh Diri, serta rencana tindak lanjut untuk konseli...">{{ old('counselor_evaluation_notes', $session->counselor_evaluation_notes) }}</textarea>
                    </div>
                    <button type="submit" class="w-full btn-primary py-3.5 text-xs font-bold uppercase tracking-wider rounded-2xl">
                        Simpan Catatan Evaluasi
                    </button>
                </form>
            </div>
        </div>

        {{-- Right Column (7 cols): Chat Room & Refleksi Pasca-Sesi --}}
        <div class="lg:col-span-7 space-y-6">
            {{-- Chat Box (FR-05) --}}
            <div class="card bg-white border border-sand-200/80 rounded-3xl shadow-sm flex flex-col overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-sand-100 bg-sand-50/70 flex items-center justify-between">
                    <div>
                        <h4 class="font-serif text-lg font-normal text-ink-900">Ruang Percakapan Terbimbing</h4>
                        <p class="text-xs text-ink-500 mt-0.5">Diskusikan kesepakatan jadwal dan harapan sesi bersama {{ $user->name }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-forest-50 border border-forest-200 text-forest-800 text-[11px] font-bold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-forest-600 animate-pulse"></span> Sesi Terbuka
                    </span>
                </div>

                <div class="p-5 sm:p-6 space-y-4 max-h-[420px] min-h-[300px] overflow-y-auto bg-sand-50/40">
                    @forelse($session->messages as $msg)
                        @php
                            $isMe = $msg->sender_id === auth()->id();
                        @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[82%] rounded-2xl px-4 py-3 shadow-sm {{ $isMe ? 'bg-forest-800 text-white rounded-br-none' : 'bg-white border border-sand-200 text-ink-800 rounded-bl-none' }}">
                                <div class="flex items-center justify-between gap-3 mb-1.5">
                                    <span class="text-[10px] font-bold uppercase tracking-wider {{ $isMe ? 'text-sage-200' : 'text-forest-700' }}">
                                        {{ $isMe ? 'Anda (Konselor)' : $user->name }}
                                    </span>
                                    <span class="text-[10px] {{ $isMe ? 'text-sand-300' : 'text-ink-400' }}">
                                        {{ $msg->created_at->format('d M • H:i') }} WIB
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm leading-relaxed whitespace-pre-line">{{ $msg->message }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xs text-ink-400">Belum ada percakapan dengan konseli ini. Mulai dengan menyapa konseli menggunakan balasan cepat di bawah.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Quick Reply Chips for Counselor --}}
                <div class="px-5 pt-3 pb-2.5 bg-white border-t border-sand-100 flex items-center gap-2 overflow-x-auto">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-ink-400 flex-shrink-0">Pintasan Pesan:</span>
                    <button type="button"
                            @click="insertReply('Halo! Terima kasih sudah mengisi instrumen awal. Apakah kamu luang untuk sesi konseling online via Google Meet besok sore?')"
                            class="text-[11px] font-medium px-3.5 py-1.5 rounded-full bg-sand-100 hover:bg-forest-50 hover:text-forest-800 text-ink-700 transition-colors whitespace-nowrap border border-sand-200/60">
                        👋 Sapa & tawarkan jadwal
                    </button>
                    <button type="button"
                            @click="insertReply('Baik, jadwal dan tautan Google Meet sudah saya sematkan di halaman konselingmu ya. Sampai jumpa di sesi kita!')"
                            class="text-[11px] font-medium px-3.5 py-1.5 rounded-full bg-sand-100 hover:bg-forest-50 hover:text-forest-800 text-ink-700 transition-colors whitespace-nowrap border border-sand-200/60">
                        ✅ Konfirmasi link Meet telah disematkan
                    </button>
                </div>

                <form action="{{ route('konselor.konseli.session.chat', $user) }}" method="POST" class="p-4 sm:p-5 bg-white border-t border-sand-100">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3">
                        <textarea x-ref="replyInput"
                                  x-model="replyText"
                                  name="message"
                                  rows="2"
                                  required
                                  class="form-input flex-1 text-sm resize-none rounded-2xl"
                                  placeholder="Balas pesan konseli dengan hangat dan menenangkan..."></textarea>
                        <button type="submit" class="btn-primary px-6 py-3 font-bold text-xs uppercase tracking-wider rounded-2xl sm:self-end">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Hasil Instrumen Refleksi Pasca-Sesi (FR-07) --}}
            <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-sand-100 pb-3">
                    <h4 class="font-serif text-lg font-normal text-ink-900">Hasil Refleksi Diri Pasca-Sesi</h4>
                    <span class="px-2.5 py-0.5 rounded-full bg-sand-100 text-ink-600 text-xs font-bold">{{ $session->reflections->count() }} Lembar</span>
                </div>

                @forelse($session->reflections->sortByDesc('submitted_at') as $ref)
                    <div class="p-5 sm:p-6 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-4 text-xs sm:text-sm">
                        <div class="flex justify-between items-center border-b border-sand-200/70 pb-3">
                            <span class="font-bold text-forest-800 bg-forest-50 px-3 py-1 rounded-full border border-forest-200 text-xs">
                                ✓ Refleksi Selesai Sesi
                            </span>
                            <span class="text-xs font-medium text-ink-400">{{ $ref->submitted_at ? $ref->submitted_at->format('d M Y • H:i') : '' }} WIB</span>
                        </div>
                        <div>
                            <p class="font-bold text-ink-900">1. Pemahaman baru tentang pikiran, perasaan, atau cara memandang masalah:</p>
                            <p class="text-ink-600 mt-1 leading-relaxed">{{ $ref->answer_1 }}</p>
                        </div>
                        <div>
                            <p class="font-bold text-ink-900">2. Nilai pengalaman hidup, budaya (kearifan lokal), atau dukungan sosial:</p>
                            <p class="text-ink-600 mt-1 leading-relaxed">{{ $ref->answer_2 }}</p>
                        </div>
                        <div>
                            <p class="font-bold text-ink-900">3. Langkah kecil yang akan dilakukan setelah sesi:</p>
                            <p class="text-ink-600 mt-1 leading-relaxed">{{ $ref->answer_3 }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-ink-400 py-6 text-center">Konseli belum mengisi Instrumen Refleksi Pasca-Sesi.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
