@extends('layouts.konseli')

@section('title', 'Modul Refleksi Self-Help Berfokus Solusi')

@section('content')
@php
    $materials = $tribe->materials->sortBy('order')->values();
@endphp

<div class="space-y-6 pb-16 animate-fade-in" x-data="{
    activeTab: 0,
    materialsCount: {{ $materials->count() }},
    materialQuestions: {{ json_encode($materials->map(fn($m) => $m->questions->pluck('id')->values())->values()) }},
    answers: {{ json_encode((object) $answers) }},
    savingStatus: 'idle', // 'idle', 'saving', 'saved', 'error'
    statuses: {}, // Local status per question: { [questionId]: 'saving' | 'saved' | 'error' | 'idle' }
    saveTimeouts: {}, // Local timeouts per question to support independent debouncing
    
    isMaterialComplete(idx) {
        const qIds = this.materialQuestions[idx] || [];
        if (qIds.length === 0) return false;
        return qIds.every(qId => {
            const val = this.answers ? this.answers[qId] : '';
            return val !== undefined && val !== null && String(val).trim().length > 0;
        });
    },

    saveAnswer(questionId, text) {
        this.answers = { ...this.answers, [questionId]: text };
        this.savingStatus = 'saving';
        
        if (!this.statuses) this.statuses = {};
        this.statuses = { ...this.statuses, [questionId]: 'saving' };
        
        if (!this.saveTimeouts) this.saveTimeouts = {};
        clearTimeout(this.saveTimeouts[questionId]);
        
        // Debounce / delay save by 5000ms (5 seconds)
        this.saveTimeouts[questionId] = setTimeout(() => {
            this.saveAnswerImmediately(questionId, text);
        }, 5000);
    },
    
    async saveAnswerImmediately(questionId, text) {
        if (this.saveTimeouts && this.saveTimeouts[questionId]) {
            clearTimeout(this.saveTimeouts[questionId]);
            delete this.saveTimeouts[questionId];
        }
        
        if (!this.statuses) this.statuses = {};
        this.statuses = { ...this.statuses, [questionId]: 'saving' };
        this.savingStatus = 'saving';
        
        try {
            let response = await fetch('{{ route('konseli.self-help.save') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    material_question_id: questionId,
                    answer_text: text
                })
            });
            let result = await response.json();
            if (result.success) {
                this.statuses = { ...this.statuses, [questionId]: 'saved' };
                this.savingStatus = 'saved';
                setTimeout(() => {
                    if (this.savingStatus === 'saved') this.savingStatus = 'idle';
                }, 1500);
            } else {
                this.statuses = { ...this.statuses, [questionId]: 'error' };
                this.savingStatus = 'error';
            }
        } catch (e) {
            this.statuses = { ...this.statuses, [questionId]: 'error' };
            this.savingStatus = 'error';
        }
    },
    
    handleBlur(questionId, text) {
        if (this.statuses && this.statuses[questionId] === 'saving') {
            this.saveAnswerImmediately(questionId, text);
        }
    },

    goToTab(index) {
        this.activeTab = index;
        this.$nextTick(() => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
}">
    <!-- Header with Dynamic Status -->
    <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-[11px] font-bold bg-forest-50 text-forest-800 px-3 py-1 rounded-full border border-forest-200 uppercase tracking-wider">
                    Modul Kearifan Lokal &bull; {{ $tribe->name }}
                </span>
                <h3 class="font-serif text-2xl font-normal text-ink-900 mt-2">Sesi Self-Help Berfokus Solusi (SFBC)</h3>
            </div>

            {{-- Auto-save status --}}
            <div class="flex items-center gap-2 text-xs font-semibold self-start sm:self-center">
                <template x-if="savingStatus === 'saving'">
                    <span class="inline-flex items-center gap-1.5 text-forest-700 bg-forest-50 px-3 py-1.5 rounded-full border border-forest-200">
                        <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan ke jurnal...
                    </span>
                </template>
                <template x-if="savingStatus === 'saved'">
                    <span class="inline-flex items-center gap-1 text-sage-800 bg-sage-50 px-3 py-1.5 rounded-full border border-sage-200">
                        <svg class="w-3.5 h-3.5 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Tersimpan otomatis
                    </span>
                </template>
                <template x-if="savingStatus === 'error'">
                    <span class="inline-flex items-center gap-1 text-terra-700 bg-terra-50 px-3 py-1.5 rounded-full border border-terra-200">
                        Gagal menyimpan perubahan.
                    </span>
                </template>
            </div>
        </div>

        {{-- Selected Counselor Notice --}}
        @if(auth()->user()->selectedCounselor)
            <div class="mt-5 p-4 bg-forest-50/60 border border-forest-200/80 rounded-2xl text-xs text-forest-900 flex items-start gap-3 font-normal leading-relaxed">
                <svg class="w-4 h-4 text-forest-700 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    Hasil refleksi ini dapat ditinjau oleh konselor pendampingmu: <strong class="text-forest-950 font-bold">{{ auth()->user()->selectedCounselor->name }}</strong>. Kamu dapat mendiskusikannya saat sesi temu virtual atau melalui percakapan terbimbing.
                </div>
            </div>
        @else
            <div class="mt-5 p-4 bg-terra-50 border border-terra-200 rounded-2xl text-xs text-terra-900 flex items-start gap-3 font-normal leading-relaxed">
                <svg class="w-4 h-4 text-terra-700 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <div>
                    Kamu belum memilih konselor pendamping. <a href="{{ route('konseli.counselor.index') }}" class="underline font-bold text-terra-800">Pilih Konselor</a> agar hasil eksplorasimu dapat didiskusikan dan diperkuat secara personal.
                </div>
            </div>
        @endif
    </div>

    @if($materials->isEmpty())
        <div class="card p-12 text-center bg-white border border-sand-200/80 rounded-3xl">
            <svg class="w-16 h-16 text-sand-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <h4 class="font-serif text-lg font-normal text-ink-800">Belum Ada Materi Self-Help</h4>
            <p class="text-xs text-ink-500 mt-1">Sesi modul sedang disiapkan.</p>
        </div>
    @else
        <!-- Horizontal Tabs Navigator -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin">
            @foreach($materials as $idx => $material)
                <button type="button" 
                        @click="goToTab({{ $idx }})"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full text-xs font-bold border transition-all duration-200 flex-shrink-0 active:scale-95"
                        :class="activeTab === {{ $idx }} 
                            ? 'bg-forest-800 border-forest-800 text-white shadow-sm' 
                            : (isMaterialComplete({{ $idx }}) 
                                ? 'bg-sage-50/70 border-sage-200 text-forest-900 hover:bg-sage-50' 
                                : 'bg-white border-sand-200 text-ink-500 hover:text-ink-800 hover:bg-sand-50')">
                    <span class="w-4 h-4 rounded-full inline-flex items-center justify-center flex-shrink-0 transition-colors duration-200"
                          :title="isMaterialComplete({{ $idx }}) ? 'Seluruh pertanyaan pada materi ini sudah dijawab' : 'Belum seluruh pertanyaan dijawab'"
                          :class="isMaterialComplete({{ $idx }})
                              ? (activeTab === {{ $idx }} ? 'bg-sage-400 text-forest-900' : 'bg-sage-600 text-white')
                              : (activeTab === {{ $idx }} ? 'bg-white/20 text-white/60' : 'bg-sand-200 text-sand-400')">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span>{{ $material->title }}</span>
                </button>
            @endforeach
        </div>

        <!-- Material Details & Questions Form -->
        @foreach($materials as $idx => $material)
            <div class="space-y-6" x-show="activeTab === {{ $idx }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
                
                {{-- Focus & Description Card --}}
                <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-sand-100 pb-4 mb-4">
                        <h4 class="font-serif text-xl font-normal text-ink-900">{{ $material->title }}</h4>
                        @if($material->values)
                            <span class="text-xs font-bold text-forest-700 bg-forest-50 px-3 py-1 rounded-full border border-forest-200">
                                Nilai Resiliensi: {{ $material->values }}
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-ink-600 leading-relaxed whitespace-pre-line font-light">
                        {{ $material->description ?: 'Tidak ada deskripsi pengantar.' }}
                    </p>
                </div>

                {{-- SFBC Worksheets --}}
                <div class="card p-6 sm:p-7 bg-white border border-sand-200/80 rounded-3xl shadow-sm space-y-6">
                    <h4 class="font-serif text-lg font-normal text-ink-900 border-b border-sand-100 pb-3">Lembar Eksplorasi Solusi (SFBC)</h4>
                    
                    @php
                        $groupedQuestions = $material->questions->sortBy('order')->groupBy('category');
                        $categoriesOrder = ['W', 'D', 'S', 'E', 'P'];
                        $hasQuestions = $material->questions->isNotEmpty();
                    @endphp

                    @if(!$hasQuestions)
                        <p class="text-sm text-ink-400 italic text-center py-6">Belum ada pertanyaan refleksi untuk sesi ini.</p>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($categoriesOrder as $cat)
                                @if($groupedQuestions->has($cat))
                                    @php
                                        $questions = $groupedQuestions->get($cat);
                                        if ($cat === 'W') {
                                            $bgClass = 'bg-forest-50/40 border-forest-100/70';
                                            $badgeClass = 'bg-forest-800 text-white';
                                            $labelClass = 'text-forest-900';
                                            $focusClass = 'focus:border-forest-600 focus:ring-forest-500/20';
                                            $stepBadge = '1';
                                            $labelText = 'Tahap 1: Merumuskan Harapan & Tujuan Hidup (Wants/Goals)';
                                        } elseif ($cat === 'D') {
                                            $bgClass = 'bg-sage-50/40 border-sage-100/70';
                                            $badgeClass = 'bg-sage-700 text-white';
                                            $labelClass = 'text-sage-900';
                                            $focusClass = 'focus:border-sage-600 focus:ring-sage-500/20';
                                            $stepBadge = '2';
                                            $labelText = 'Tahap 2: Menemukan Pengecualian & Kekuatan Masa Lalu (Exception)';
                                        } elseif ($cat === 'S') {
                                            $bgClass = 'bg-terra-50/40 border-terra-100/70';
                                            $badgeClass = 'bg-terra-700 text-white';
                                            $labelClass = 'text-terra-900';
                                            $focusClass = 'focus:border-terra-600 focus:ring-terra-500/20';
                                            $stepBadge = '3';
                                            $labelText = 'Tahap 3: Pelaksanaan Solusi & Tindakan Nyata (Solutions)';
                                        } elseif ($cat === 'E') {
                                            $bgClass = 'bg-sand-100/60 border-sand-200/70';
                                            $badgeClass = 'bg-ink-800 text-white';
                                            $labelClass = 'text-ink-900';
                                            $focusClass = 'focus:border-ink-600 focus:ring-ink-500/20';
                                            $stepBadge = '4';
                                            $labelText = 'Tahap 4: Skala Kemajuan Diri (Scaling Questions)';
                                        } else { // P
                                            $bgClass = 'bg-sand-50/80 border-sand-200/80';
                                            $badgeClass = 'bg-forest-700 text-white';
                                            $labelClass = 'text-forest-800';
                                            $focusClass = 'focus:border-forest-600 focus:ring-forest-500/20';
                                            $stepBadge = '5';
                                            $labelText = 'Tahap 5: Tugas & Komitmen Bertumbuh (Prescription / Tasks)';
                                        }
                                    @endphp
                                    <div class="p-5 sm:p-6 border rounded-3xl space-y-5 {{ $bgClass }} transition-all duration-200">
                                        {{-- Category Header --}}
                                        <div class="flex items-center gap-2.5 border-b border-current/10 pb-3">
                                            <span class="w-6 h-6 rounded-lg font-bold text-xs flex items-center justify-center flex-shrink-0 {{ $badgeClass }}">
                                                {{ $stepBadge }}
                                            </span>
                                            <span class="text-sm font-bold {{ $labelClass }}">
                                                {{ $labelText }}
                                            </span>
                                        </div>

                                        {{-- Questions list --}}
                                        <div class="space-y-5">
                                            @foreach($questions as $qIndex => $q)
                                                <div class="space-y-2">
                                                    <div class="flex items-start gap-2">
                                                        @if($questions->count() > 1)
                                                            <span class="text-xs font-bold text-ink-400 mt-0.5">Pertanyaan {{ $qIndex + 1 }}:</span>
                                                        @endif
                                                        <p class="text-sm font-semibold text-ink-800 leading-relaxed">{{ $q->text }}</p>
                                                    </div>
                                                    
                                                    {{-- Reflection textarea --}}
                                                    <textarea rows="4" 
                                                              @input="saveAnswer({{ $q->id }}, $event.target.value)"
                                                              @blur="handleBlur({{ $q->id }}, $event.target.value)"
                                                              class="form-input bg-white text-xs font-medium focus:outline-none focus:ring-2 {{ $focusClass }} transition-shadow duration-150 rounded-2xl" 
                                                              placeholder="Tuliskan refleksi dirimu di sini... (Tersimpan otomatis setelah 5 detik tidak mengetik atau saat berpindah kolom)">{{ $answers[$q->id] ?? '' }}</textarea>
                                                    
                                                    {{-- Local saving status --}}
                                                    <div class="flex flex-wrap items-center justify-between gap-1 min-h-[22px] mt-2 px-3 py-1.5 rounded-xl bg-white/70 border border-sand-200/70 text-[11px] font-medium text-ink-400 select-none transition-all duration-200">
                                                        <div class="flex items-center gap-1.5">
                                                            <svg class="w-3.5 h-3.5 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                                            <span>Penyimpanan Aman Aktif</span>
                                                        </div>
                                                        <div class="font-semibold">
                                                            <span x-show="statuses[{{ $q->id }}] === 'saving'" class="inline-flex items-center gap-1 text-forest-700 animate-pulse" style="display: none;">
                                                                <svg class="animate-spin h-3.5 w-3.5 text-forest-600" fill="none" viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3.5"></circle>
                                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                </svg>
                                                                Sedang menyimpan...
                                                            </span>
                                                            <span x-show="statuses[{{ $q->id }}] === 'saved'" class="inline-flex items-center gap-1 text-sage-800 bg-sage-50 px-2.5 py-0.5 rounded-full border border-sage-200" style="display: none;">
                                                                <svg class="w-3 h-3 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                                </svg>
                                                                Perubahan tersimpan
                                                            </span>
                                                            <span x-show="statuses[{{ $q->id }}] === 'error'" class="inline-flex items-center gap-1 text-terra-700 bg-terra-50 px-2.5 py-0.5 rounded-full border border-terra-200" style="display: none;">
                                                                <svg class="w-3.5 h-3.5 text-terra-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                                Gagal menyimpan
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Next Tab Navigator --}}
                <div class="flex flex-wrap justify-between items-center gap-3 pt-4">
                    <button type="button" 
                            @click="goToTab(Math.max(0, activeTab - 1))" 
                            :disabled="activeTab === 0"
                            class="btn-secondary px-5 py-2.5 text-xs font-bold uppercase tracking-wider rounded-2xl disabled:opacity-40 disabled:cursor-not-allowed">
                        &larr; Sesi Sebelumnya
                    </button>
                    <button type="button" 
                            @click="if(activeTab < materialsCount - 1) { goToTab(activeTab + 1) } else { window.location.href = '{{ route('konseli.dashboard') }}' }"
                            class="btn-primary px-6 py-2.5 text-xs font-bold uppercase tracking-wider rounded-2xl shadow-sm">
                        <span x-text="activeTab === materialsCount - 1 ? 'Selesai & Ke Beranda' : 'Sesi Berikutnya &rarr;'"></span>
                    </button>
                </div>

            </div>
        @endforeach
    @endif
</div>
@endsection
