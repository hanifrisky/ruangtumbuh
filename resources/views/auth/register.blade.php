<x-guest-layout>
    <div class="mb-6 space-y-2">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-forest-900 border border-emerald-300 text-xs font-black shadow-xs">
            <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
            <span>Langkah 1 • Registrasi Akun Siswa</span>
        </div>
        <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 tracking-tight">Mulai Perjalanan Bertumbuh</h2>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
            Daftarkan akunmu untuk mengakses layanan konseling online dengan pendekatan REBT & kearifan lokal.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- 1. Nama Lengkap -->
        <div>
            <label for="name" class="form-label text-forest-950">Nama Lengkap</label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                   placeholder="Nama lengkap kamu" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- 2. Jenis Kelamin (Interactive Tactile Cards) -->
        <div>
            <label class="form-label text-forest-950">Jenis Kelamin</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="flex items-center gap-3 p-3.5 min-h-[48px] rounded-2xl border-2 border-emerald-100 bg-[#FAFDF7] hover:bg-emerald-50/80 hover:border-emerald-400 cursor-pointer transition-all has-[:checked]:border-emerald-700 has-[:checked]:bg-emerald-50 has-[:checked]:shadow-xs">
                    <input type="radio"
                           name="gender"
                           value="Laki-laki"
                           {{ old('gender') === 'Laki-laki' ? 'checked' : '' }}
                           required
                           class="w-4 h-4 text-emerald-700 border-emerald-300 focus:ring-emerald-600">
                    <span class="text-xs sm:text-sm font-bold text-slate-800">Laki-laki</span>
                </label>
                <label class="flex items-center gap-3 p-3.5 min-h-[48px] rounded-2xl border-2 border-emerald-100 bg-[#FAFDF7] hover:bg-emerald-50/80 hover:border-emerald-400 cursor-pointer transition-all has-[:checked]:border-emerald-700 has-[:checked]:bg-emerald-50 has-[:checked]:shadow-xs">
                    <input type="radio"
                           name="gender"
                           value="Perempuan"
                           {{ old('gender') === 'Perempuan' ? 'checked' : '' }}
                           required
                           class="w-4 h-4 text-emerald-700 border-emerald-300 focus:ring-emerald-600">
                    <span class="text-xs sm:text-sm font-bold text-slate-800">Perempuan</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-1" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- 3. Kelas -->
            <div>
                <label for="grade_class" class="form-label text-forest-950">Kelas</label>
                <input id="grade_class"
                       type="text"
                       name="grade_class"
                       value="{{ old('grade_class') }}"
                       required
                       class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                       placeholder="Contoh: X-IPA 1 / XI-IPS 2" />
                <x-input-error :messages="$errors->get('grade_class')" class="mt-1" />
            </div>

            <!-- 4. Asal Sekolah -->
            <div>
                <label for="school_origin" class="form-label text-forest-950">Asal Sekolah</label>
                <input id="school_origin"
                       type="text"
                       name="school_origin"
                       value="{{ old('school_origin') }}"
                       required
                       class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                       placeholder="Nama sekolah asal kamu" />
                <x-input-error :messages="$errors->get('school_origin')" class="mt-1" />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <!-- 5. Username -->
            <div>
                <label for="username" class="form-label text-forest-950">Username</label>
                <input id="username"
                       type="text"
                       name="username"
                       value="{{ old('username') }}"
                       required
                       autocomplete="username"
                       class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                       placeholder="username_kamu" />
                <x-input-error :messages="$errors->get('username')" class="mt-1" />
            </div>

            <!-- 6. Email -->
            <div>
                <label for="email" class="form-label text-forest-950">Email Aktif</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                       placeholder="nama@email.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
        </div>

        <!-- 7. Password -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div>
                <label for="password" class="form-label text-forest-950">Kata Sandi</label>
                <div class="relative" x-data="{ show: false }">
                    <input id="password"
                           :type="show ? 'text' : 'password'"
                           name="password"
                           required
                           autocomplete="new-password"
                           class="form-input pr-10 focus:border-emerald-600 focus:ring-emerald-500/20"
                           placeholder="Minimal 8 karakter" />
                    <button type="button"
                            @click="show = !show"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-forest-800 transition-colors focus:outline-none p-1"
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
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div>
                <label for="password_confirmation" class="form-label text-forest-950">Ulangi Kata Sandi</label>
                <div class="relative" x-data="{ show: false }">
                    <input id="password_confirmation"
                           :type="show ? 'text' : 'password'"
                           name="password_confirmation"
                           required
                           autocomplete="new-password"
                           class="form-input pr-10 focus:border-emerald-600 focus:ring-emerald-500/20"
                           placeholder="Ketik ulang password" />
                    <button type="button"
                            @click="show = !show"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-forest-800 transition-colors focus:outline-none p-1"
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
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <!-- Privacy Assurance Pill -->
        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200/90 flex items-start gap-2.5 text-xs text-forest-950 font-medium">
            <span class="text-base flex-shrink-0">🔒</span>
            <span class="leading-relaxed">
                Seluruh data identitas dan asesmenmu dijaga kerahasiaannya dengan standar etika profesi Bimbingan & Konseling.
            </span>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-4 rounded-2xl text-base font-extrabold shadow-lg shadow-forest-800/25 hover:shadow-xl hover:scale-[1.01] transition-all">
                Daftar & Masuk ke Ruang Tumbuh &rarr;
            </button>
        </div>

        <div class="text-center mt-4 pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-600 font-medium">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-emerald-700 hover:text-forest-900 font-extrabold transition-colors ml-1 underline decoration-2 decoration-emerald-400">
                    Masuk di sini &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
