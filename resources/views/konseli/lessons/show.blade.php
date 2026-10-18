@extends('layouts.konseli')

@section('title', $lesson->title)
@section('page-title', 'Membaca Pembelajaran')

@section('content')
<div class="max-w-3xl mx-auto pb-20 animate-fade-in">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-ink-500 font-medium mb-6">
        <a href="{{ route('konseli.lessons.index') }}" class="hover:text-forest-700 transition-colors">Pembelajaran</a>
        <svg class="w-3.5 h-3.5 text-sand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-ink-800 font-bold truncate" aria-current="page">{{ $lesson->title }}</span>
    </nav>

    {{-- Header --}}
    <header class="mb-10 text-center">
        @if($lesson->tag)
            <span class="inline-block px-3.5 py-1 bg-forest-50 border border-forest-200 text-forest-800 text-xs font-bold rounded-full mb-4">
                {{ $lesson->tag }}
            </span>
        @endif
        <h1 class="font-serif text-2xl sm:text-3xl md:text-4xl font-normal text-ink-900 leading-tight mb-4">{{ $lesson->title }}</h1>
        <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1 text-xs text-ink-500 font-medium">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Oleh: <strong>{{ $lesson->creator->name ?? 'Tim Konselor Ruang Tumbuh' }}</strong></span>
            </div>
            <div class="hidden sm:block w-1 h-1 bg-sand-300 rounded-full"></div>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-sand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Diterbitkan: {{ $lesson->created_at->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </header>

    {{-- Sections Content --}}
    <article class="space-y-8 bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-sm border border-sand-200/80">
        @forelse($lesson->sections as $section)
            <div class="lesson-section">
                @if($section->type === 'text')
                    <div class="prose prose-stone sm:prose-lg max-w-none break-words prose-headings:font-serif prose-headings:font-normal prose-a:text-forest-700 prose-img:rounded-2xl text-ink-800 leading-relaxed font-light">
                        {!! nl2br(e($section->content_text)) !!}
                    </div>
                
                @elseif($section->type === 'image')
                    @if($section->file_path)
                        <figure class="my-6">
                            <img src="{{ asset('storage/' . $section->file_path) }}" alt="Gambar" class="w-full h-auto rounded-3xl shadow-sm border border-sand-200/80">
                        </figure>
                    @endif
                
                @elseif($section->type === 'video')
                    @if($section->file_path)
                        <div class="my-6 aspect-video bg-forest-950 rounded-3xl overflow-hidden shadow-sm relative">
                            <video controls class="w-full h-full object-cover">
                                <source src="{{ asset('storage/' . $section->file_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video ini.
                            </video>
                        </div>
                    @endif

                @elseif($section->type === 'youtube')
                    @if($section->content_text)
                        @php
                            $youtubeUrl = $section->content_text;
                            preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $match);
                            $youtubeId = $match[1] ?? null;
                        @endphp
                        
                        <div class="my-6 aspect-video bg-sand-100 rounded-3xl overflow-hidden shadow-sm relative border border-sand-200">
                            @if($youtubeId)
                                <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-ink-400 text-xs">
                                    Format tautan YouTube tidak valid.
                                </div>
                            @endif
                        </div>
                    @endif
                
                @elseif($section->type === 'pdf')
                    @if($section->file_path)
                        <div class="my-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-5 bg-sand-50/70 border border-sand-200 rounded-2xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-terra-100 text-terra-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-ink-900 text-sm">Dokumen Panduan PDF</h4>
                                        <p class="text-xs text-ink-500 font-light">Klik untuk melihat atau mengunduh dokumen pelengkap.</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $section->file_path) }}" target="_blank" class="btn-secondary text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-xl whitespace-nowrap">
                                    Buka Dokumen
                                </a>
                            </div>
                        </div>
                    @endif
                
                @elseif($section->type === 'link')
                    @if($section->link_url)
                        <div class="my-6">
                            <a href="{{ $section->link_url }}" target="_blank" class="block p-5 bg-sand-50/70 hover:bg-sand-100/70 border border-sand-200 rounded-2xl transition-all group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-forest-100 text-forest-700 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-ink-900 text-sm group-hover:text-forest-700 transition-colors">{{ $section->link_title ?: 'Tautan Eksternal' }}</h4>
                                            <p class="text-xs text-ink-500 truncate max-w-[200px] sm:max-w-xs font-light">{{ $section->link_url }}</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-forest-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-sand-100 text-sand-400 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <h3 class="font-serif text-lg font-normal text-ink-800">Materi Masih Kosong</h3>
                <p class="text-ink-500 text-xs mt-1">Belum ada konten yang disematkan pada materi ini.</p>
            </div>
        @endforelse
    </article>
</div>
@endsection
