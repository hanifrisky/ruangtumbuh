@extends('layouts.konseli')

@section('title', 'Mengisi Instrumen Well-Being & Ide Bunuh Diri')

@section('content')
@php
    $totalQuestions = $questions->count();
    $kategoriLabel = $type === 'pre_test' ? 'Awal Konseling (Pra-Konseling)' : 'Sesudah Konseling (Pasca-Konseling)';
@endphp

<div class="space-y-6 pb-16 animate-fade-in" x-data="{
    currentIndex: 0,
    totalQuestions: {{ $totalQuestions }},
    questions: {{ json_encode($questions->map(function($q) {
        return [
            'id' => $q->id,
            'text' => $q->text,
            'category' => $q->category === 'suicide_ideation' ? 'Identifikasi Diri (Ide Bunuh Diri)' : 'Psychological Well-Being (Carol D. Ryff)',
            'dimension' => $q->dimension ?? 'Well-Being',
            'options' => $q->optionGroup->items->sortBy('order')->values()->map(function($opt) {
                return [
                    'id' => $opt->id,
                    'label' => $opt->label,
                    'score' => $opt->score
                ];
            })
        ];
    })) }},
    answers: {
        @foreach($answer->details as $d)
            '{{ $d->question_id }}': {
                option_id: {{ $d->selected_option_id }},
                score: {{ $d->score }}
            },
        @endforeach
    },
    savingStatus: 'idle',
    questionStatuses: {
        @foreach($answer->details as $d)
            '{{ $d->question_id }}': 'saved',
        @endforeach
    },

    get answeredCount() {
        return Object.keys(this.answers).length;
    },

    get progressPercentage() {
        return this.totalQuestions > 0 ? Math.round((this.answeredCount / this.totalQuestions) * 100) : 0;
    },

    get allAnswered() {
        return this.answeredCount === this.totalQuestions;
    },

    selectOption(questionId, optionId, score) {
        this.answers[questionId] = { option_id: optionId, score: score };
        this.saveAnswer(questionId, optionId, score);
    },

    async saveAnswer(questionId, optionId, score) {
        this.savingStatus = 'saving';
        this.questionStatuses[questionId] = 'saving';

        try {
            let res = await fetch('{{ route('konseli.wellbeing.save', $type) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question_id: questionId,
                    selected_option_id: optionId,
                    score: score
                })
            });

            let data = await res.json();
            if (data.success) {
                this.savingStatus = 'saved';
                this.questionStatuses[questionId] = 'saved';
                setTimeout(() => {
                    if (this.savingStatus === 'saved') this.savingStatus = 'idle';
                }, 1500);
            } else {
                this.savingStatus = 'error';
                this.questionStatuses[questionId] = 'error';
            }
        } catch (e) {
            this.savingStatus = 'error';
            this.questionStatuses[questionId] = 'error';
        }
    },

    handleGridClick(q, idx) {
        this.currentIndex = idx;
    }
}">
    <!-- Header with Dynamic Progress (60% White Card with 30% Green Status) -->
    <div class="card p-6 sm:p-7 bg-white border border-slate-200 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-forest-700 bg-forest-50 px-3 py-1 rounded-full border border-forest-200">
                    {{ $kategoriLabel }}
                </span>
                <h3 class="font-sans text-xl sm:text-2xl font-black text-slate-900 mt-2">Lembar Asesmen Mandiri Remaja</h3>
            </div>

            <div class="flex items-center gap-2 text-xs font-bold self-start sm:self-center">
                <template x-if="savingStatus === 'saving'">
                    <span class="inline-flex items-center gap-1.5 text-forest-700 bg-forest-50 px-3 py-1.5 rounded-full border border-forest-200">
                        <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan otomatis...
                    </span>
                </template>
                <template x-if="savingStatus === 'saved'">
                    <span class="inline-flex items-center gap-1.5 text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-200">
                        ✓ Tersimpan
                    </span>
                </template>
                <template x-if="savingStatus === 'error'">
                    <span class="inline-flex items-center gap-1.5 text-rose-700 bg-rose-50 px-3 py-1.5 rounded-full border border-rose-200">
                        Gagal menyimpan. Ketuk ulang opsi!
                    </span>
                </template>
            </div>
        </div>

        <div class="mt-5">
            <div class="flex justify-between items-center text-xs font-bold text-slate-600 mb-2">
                <span>Progres Asesmen (<span x-text="answeredCount"></span> dari <span x-text="totalQuestions"></span> Terisi)</span>
                <span class="text-forest-800 font-black" x-text="progressPercentage + '%'">0%</span>
            </div>
            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-forest-800 to-forest-600 h-full rounded-full transition-all duration-300" :style="'width: ' + progressPercentage + '%'"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Left Side: Active Question Display with 52px+ Ergonomic Likert Cards (60% White) -->
        <div class="lg:col-span-2 card p-6 sm:p-8 bg-white border border-slate-200 shadow-sm">
            <div class="min-h-[380px] flex flex-col justify-between">
                <div>
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black text-forest-800 uppercase tracking-widest" x-text="'PERNYATAAN NO. ' + (currentIndex + 1) + ' DARI ' + totalQuestions"></span>
                        <span class="text-[11px] font-bold px-3 py-1 rounded-full bg-slate-100 text-forest-900 border border-slate-200" x-text="questions[currentIndex].dimension"></span>
                    </div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider" x-text="questions[currentIndex].category"></p>

                    <div class="my-5 p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <h4 class="font-sans font-bold text-slate-900 text-base sm:text-lg leading-relaxed" x-text="'“' + questions[currentIndex].text + '”'"></h4>
                    </div>

                    <p class="text-xs font-bold text-slate-500 mb-3">Pilihlah respon yang paling sesuai dengan kondisimu:</p>

                    <div class="space-y-3">
                        <template x-for="(opt, idx) in questions[currentIndex].options" :key="opt.id">
                            <label class="likert-option"
                                   :class="answers[questions[currentIndex].id]?.option_id === opt.id ? 'likert-option-active' : ''">
                                <div class="flex items-center gap-3.5">
                                    <input type="radio"
                                           :name="'q_' + questions[currentIndex].id"
                                           :value="opt.id"
                                           :checked="answers[questions[currentIndex].id]?.option_id === opt.id"
                                           @change="selectOption(questions[currentIndex].id, opt.id, opt.score)"
                                           class="w-5 h-5 text-forest-800 bg-white border-slate-300 focus:ring-forest-700" />
                                    <span class="text-sm font-bold text-slate-800" x-text="opt.label"></span>
                                </div>
                                <span class="w-6 h-6 rounded-full text-[11px] font-bold flex items-center justify-center transition-colors"
                                      :class="answers[questions[currentIndex].id]?.option_id === opt.id ? 'bg-forest-800 text-white' : 'bg-slate-100 text-slate-400'"
                                      x-text="idx + 1"></span>
                            </label>
                        </template>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4 mt-8 pt-6 border-t border-slate-200">
                    <button type="button"
                            @click="currentIndex = Math.max(0, currentIndex - 1)"
                            :disabled="currentIndex === 0"
                            class="btn-secondary px-5 py-2.5 disabled:opacity-40 disabled:cursor-not-allowed">
                        &laquo; Sebelumnya
                    </button>

                    <button type="button"
                            @click="if(currentIndex < totalQuestions - 1) { currentIndex++ }"
                            x-show="currentIndex < totalQuestions - 1"
                            class="btn-primary px-6 py-2.5">
                        Berikutnya &raquo;
                    </button>

                    <form action="{{ route('konseli.wellbeing.finish', $type) }}" method="POST" x-show="currentIndex === totalQuestions - 1">
                        @csrf
                        <button type="submit"
                                :disabled="!allAnswered"
                                class="btn-success px-6 py-3 font-bold disabled:opacity-40 disabled:cursor-not-allowed">
                            ✓ Simpan Hasil Asesmen
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Navigator Grid (60% White Card with 30% Green Highlights) -->
        <div class="lg:col-span-1 card p-6 bg-white border border-slate-200 space-y-5 shadow-sm">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-sans font-bold text-slate-900 text-sm">Navigasi Nomor</h4>
                    <span class="text-[11px] font-bold text-forest-800 bg-forest-50 px-2.5 py-0.5 rounded-full border border-forest-200" x-text="answeredCount + '/' + totalQuestions"></span>
                </div>

                <div class="grid grid-cols-5 sm:grid-cols-8 md:grid-cols-10 lg:grid-cols-5 gap-2">
                    <template x-for="(q, idx) in questions" :key="q.id">
                        <button type="button"
                                @click="handleGridClick(q, idx)"
                                class="relative w-full aspect-square max-w-[44px] mx-auto rounded-xl font-bold text-xs flex items-center justify-center border-2 transition-all duration-200 active:scale-95 focus:outline-none"
                                :class="{
                                    'ring-2 ring-forest-800 ring-offset-2 border-forest-800 z-10': currentIndex === idx,
                                    'bg-forest-50 border-forest-300 text-forest-800': questionStatuses[q.id] === 'saving',
                                    'bg-rose-50 border-rose-300 text-rose-600': questionStatuses[q.id] === 'error',
                                    'bg-emerald-100 border-emerald-300 text-forest-900 font-black': questionStatuses[q.id] === 'saved',
                                    'bg-slate-50 border-slate-200 text-slate-400': !questionStatuses[q.id] || questionStatuses[q.id] === 'idle'
                                }">
                            <span x-text="idx + 1"></span>
                        </button>
                    </template>
                </div>
            </div>

            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-700 leading-relaxed font-light">
                <p class="font-bold text-forest-900 mb-0.5">✦ Petunjuk Asesmen:</p>
                <p>Jawabanmu otomatis disimpan. Pastikan seluruh nomor telah terisi sebelum menyimpan hasil akhir.</p>
            </div>

            <div class="pt-2 border-t border-slate-200">
                <form action="{{ route('konseli.wellbeing.finish', $type) }}" method="POST">
                    @csrf
                    <button type="submit"
                            :disabled="!allAnswered"
                            class="w-full btn-primary py-3 text-xs font-black uppercase tracking-wider disabled:opacity-40 disabled:cursor-not-allowed">
                        Selesaikan Instrumen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
