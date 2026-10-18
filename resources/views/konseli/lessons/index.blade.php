@extends('layouts.konseli')
@section('title', 'Materi Pembelajaran Resiliensi')
@section('page-title', 'Pembelajaran')

@section('content')
<div class="space-y-8 animate-fade-in pb-16">
    <div class="border-b border-sand-200 pb-5">
        <span class="text-[11px] font-bold uppercase tracking-wider text-forest-700 block mb-1">Edukasi Ketangguhan Jiwa</span>
        <h1 class="font-serif text-2xl sm:text-3xl font-normal text-ink-900">Materi Pembelajaran & Panduan Bertumbuh</h1>
        <p class="text-ink-600 mt-2 text-sm sm:text-base max-w-2xl font-light">Jelajahi berbagai materi edukasi, tips, dan panduan yang telah dirancang khusus untuk memantik ketangguhan (resiliensi) dan kekuatan batinmu.</p>
    </div>

    {{-- Search Bar --}}
    <div class="pt-1 pb-2">
        <form action="{{ route('konseli.lessons.index') }}" method="GET">
            <div class="flex items-center gap-3 max-w-2xl">
                <div class="relative flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari materi pembelajaran, tips, atau tema..."
                        class="w-full h-12 px-5 rounded-2xl border-2 border-sand-300 bg-white text-sm text-ink-900 placeholder-ink-400 focus:outline-none focus:border-forest-700 focus:ring-4 focus:ring-sage-500/20 transition shadow-sm"
                    >
                </div>
                <button
                    type="submit"
                    class="h-12 px-6 rounded-2xl btn-primary text-xs font-bold uppercase tracking-wider shadow-sm whitespace-nowrap"
                >
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Lessons Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($lessons as $lesson)
            <a href="{{ route('konseli.lessons.show', $lesson) }}" class="group bg-white rounded-3xl border border-sand-200/80 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="aspect-video w-full bg-sand-100 relative overflow-hidden">
                    <img src="{{ $lesson->thumbnail }}" alt="{{ $lesson->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-forest-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="font-serif text-lg font-normal text-ink-900 line-clamp-2 mb-3 group-hover:text-forest-700 transition-colors">{{ $lesson->title }}</h3>
                    
                    @if($lesson->tag)
                    <div class="mt-auto flex items-center justify-between text-xs text-ink-500 font-medium pt-3 border-t border-sand-100">
                        <div class="flex items-center gap-1.5">
                            <span class="px-2.5 py-0.5 rounded-full bg-forest-50 border border-forest-200 text-forest-800 text-[11px] font-bold">
                                {{ $lesson->tag }}
                            </span>
                        </div>
                        <span class="text-xs font-bold text-forest-700 group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </div>
                    @endif
                </div>
            </a>
        @empty
            <div class="col-span-full py-20 text-center card bg-white border border-sand-200/80 rounded-3xl p-12">
                <div class="w-16 h-16 bg-sand-100 rounded-full flex items-center justify-center mx-auto mb-4 text-sand-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="font-serif text-lg font-normal text-ink-800 mb-1">Tidak ada materi ditemukan</h3>
                <p class="text-xs text-ink-500">Coba kata kunci lain atau periksa kembali nanti.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8 pb-8">
        {{ $lessons->links() }}
    </div>
</div>
@endsection