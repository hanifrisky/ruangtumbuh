@extends('layouts.konselor')

@section('title', 'Manajemen Materi Pembelajaran')
@section('page-title', 'Manajemen Lesson')

@section('header-actions')
<a href="{{ route('konselor.lessons.create') }}" class="btn-primary text-xs font-bold px-4 py-2 flex items-center gap-2">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Buat Lesson
</a>
@endsection

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-sand-200/80 overflow-hidden">
    <div class="p-6 border-b border-sand-100">
        <h3 class="font-serif text-xl font-normal text-ink-900">Daftar Modul & Pembelajaran</h3>
        <p class="text-ink-500 text-xs sm:text-sm mt-1 font-light">Kelola materi psikoedukasi, video, dan panduan resiliensi untuk konseli.</p>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full min-w-[640px] text-left border-collapse">
            <thead>
                <tr class="bg-sand-50/70 text-ink-600 text-xs uppercase tracking-wider font-bold border-b border-sand-200">
                    <th class="px-6 py-4">Judul Lesson</th>
                    <th class="px-6 py-4 whitespace-nowrap">Kategori / Tag</th>
                    <th class="px-6 py-4">Pembuat</th>
                    <th class="px-6 py-4 whitespace-nowrap">Jumlah Bagian</th>
                    <th class="px-6 py-4 text-right whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sand-100 text-xs sm:text-sm">
                @forelse($lessons as $lesson)
                <tr class="hover:bg-sand-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-ink-900">{{ $lesson->title }}</div>
                        <div class="text-[11px] text-ink-400 mt-0.5">{{ $lesson->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($lesson->tag)
                            <span class="px-3 py-1 bg-forest-50 border border-forest-200 text-forest-800 text-xs font-bold rounded-full whitespace-nowrap">{{ $lesson->tag }}</span>
                        @else
                            <span class="text-ink-300">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-ink-700">{{ $lesson->creator->name ?? 'Sistem' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 bg-sand-100 text-ink-700 text-xs font-bold rounded-xl whitespace-nowrap">{{ $lesson->sections_count }} Section</span>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('konselor.lessons.edit', $lesson) }}" class="p-2 text-forest-700 hover:bg-forest-50 rounded-xl transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('konselor.lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lesson ini? Semua media terkait akan dihapus.')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-terra-600 hover:bg-terra-50 rounded-xl transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-ink-400 font-light">
                        Belum ada materi pembelajaran yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
