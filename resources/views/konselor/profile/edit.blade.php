@extends('layouts.konselor')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
@php $profile = $user->counselorProfile; @endphp
<div class="max-w-xl mx-auto space-y-6 animate-fade-in pb-16">
    <div class="card p-6 sm:p-8 bg-white border border-sand-200/80 rounded-3xl shadow-sm">
        <div class="border-b border-sand-100 pb-4 mb-6">
            <span class="text-[11px] font-bold uppercase tracking-wider text-forest-700 block mb-1">Identitas Praktisi</span>
            <h3 class="font-serif text-2xl font-normal text-ink-900">Pengaturan Profil Konselor</h3>
        </div>

        <form action="{{ route('konselor.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <h4 class="font-serif text-base font-normal text-ink-900 border-b border-sand-100 pb-2">1. Akun Login</h4>

                <!-- Name -->
                <div>
                    <label for="name" class="form-label text-xs font-bold uppercase tracking-wider text-ink-700">Nama Lengkap & Gelar</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}" 
                           required 
                           class="form-input rounded-2xl" 
                           placeholder="Nama lengkap beserta gelar akademis..." />
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password change block -->
                <div class="space-y-4 p-5 bg-sand-50/70 border border-sand-200/80 rounded-2xl">
                    <div>
                        <h4 class="text-xs font-bold text-ink-800 uppercase tracking-wider">Ubah Kata Sandi</h4>
                        <p class="text-[11px] text-ink-500 font-light mt-0.5">Biarkan kosong jika tidak ingin mengubah kata sandi.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="form-label text-xs">Kata Sandi Baru</label>
                            <div class="relative" x-data="{ show: false }">
                                <input type="password" 
                                       id="password" 
                                       :type="show ? 'text' : 'password'"
                                       name="password" 
                                       class="form-input bg-white text-xs w-full pr-10 rounded-xl" 
                                       placeholder="••••••••" />
                                <button type="button" 
                                        @click="show = !show" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 hover:text-ink-600 focus:outline-none p-1 transition-colors"
                                        title="Tampilkan/Sembunyikan Kata Sandi">
                                    <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.69 9.69a3 3 0 004.62 4.62M4.93 4.93l14.14 14.14" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="form-label text-xs">Konfirmasi Kata Sandi</label>
                            <div class="relative" x-data="{ show: false }">
                                <input type="password" 
                                       id="password_confirmation" 
                                       :type="show ? 'text' : 'password'"
                                       name="password_confirmation" 
                                       class="form-input bg-white text-xs w-full pr-10 rounded-xl" 
                                       placeholder="••••••••" />
                                <button type="button" 
                                        @click="show = !show" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 hover:text-ink-600 focus:outline-none p-1 transition-colors"
                                        title="Tampilkan/Sembunyikan Kata Sandi">
                                    <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.69 9.69a3 3 0 004.62 4.62M4.93 4.93l14.14 14.14" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-5 pt-4 border-t border-sand-100">
                <h4 class="font-serif text-base font-normal text-ink-900 border-b border-sand-100 pb-2">2. Data Profil Konselor</h4>

                <!-- Motto -->
                <div>
                    <label for="motto" class="form-label text-xs font-bold uppercase tracking-wider text-ink-700">Motto Hidup / Konseling</label>
                    <input type="text" 
                           id="motto" 
                           name="motto" 
                           value="{{ old('motto', $profile->motto ?? '') }}" 
                           class="form-input rounded-2xl" 
                           placeholder="Motto yang akan dipajang di kartu profil Anda..." />
                    @error('motto')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp_number" class="form-label text-xs font-bold uppercase tracking-wider text-ink-700">Nomor WhatsApp</label>
                    <input type="text" 
                           id="whatsapp_number" 
                           name="whatsapp_number" 
                           value="{{ old('whatsapp_number', $profile->whatsapp_number ?? '') }}" 
                           class="form-input rounded-2xl" 
                           placeholder="Contoh: 08123456789" />
                    @error('whatsapp_number')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="form-label text-xs font-bold uppercase tracking-wider text-ink-700">Foto Profil</label>
                    @if($profile && $profile->photo_path)
                        <div class="mb-3 flex items-center gap-3">
                            <div class="w-14 h-14 rounded-2xl border border-sand-200 overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $profile->photo_path) }}" alt="Foto profil" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs text-ink-400">Foto profil saat ini terpasang. Unggah berkas baru jika ingin memperbarui.</span>
                        </div>
                    @endif
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/*"
                           class="form-input bg-white rounded-2xl" />
                    <p class="text-ink-400 text-xs mt-1">Format: JPG/PNG/WebP, maksimal 2MB</p>
                    @error('photo')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="form-label text-xs font-bold uppercase tracking-wider text-ink-700">Deskripsi Diri & Keahlian</label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="form-input rounded-2xl" 
                              placeholder="Deskripsi diri, keahlian, atau fokus bimbingan Anda...">{{ old('description', $profile->description ?? '') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-sand-100 flex justify-end">
                <button type="submit" class="btn-primary w-full sm:w-auto px-8 py-3 text-xs font-bold uppercase tracking-wider rounded-2xl shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
