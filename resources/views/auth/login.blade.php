<x-guest-layout>
    <div class="mb-6">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-forest-50 border border-forest-200 text-forest-800 text-[11px] font-extrabold uppercase tracking-wider mb-2">
            Langkah 2 • Akses Ruang Pribadi
        </span>
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-ink-900">Selamat Datang Kembali</h2>
        <p class="text-xs sm:text-sm text-ink-500 mt-1 leading-relaxed">
            Masuk dengan <strong>Email</strong> atau <strong>Username</strong> akun Ruang Tumbuh kamu untuk melanjutkan sesi pendampingan.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address or Username -->
        <div>
            <label for="email" class="form-label">Email atau Username</label>
            <input id="email"
                   type="text"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username"
                   class="form-input"
                   placeholder="Contoh: emailkamu@example.com atau username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="form-label mb-0">Kata Sandi (Password)</label>
            </div>
            <div class="relative" x-data="{ show: false }">
                <input id="password"
                       :type="show ? 'text' : 'password'"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="form-input pr-12"
                       placeholder="••••••••" />
                <button type="button"
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 hover:text-forest-800 transition-colors focus:outline-none p-1.5"
                        title="Tampilkan/Sembunyikan Password">
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

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       name="remember"
                       class="rounded-md border-sand-300 text-forest-800 focus:ring-sage-500 w-4 h-4">
                <span class="ms-2 text-xs text-ink-600 font-semibold">Ingat saya di perangkat ini</span>
            </label>
        </div>

        <div class="p-3.5 rounded-2xl bg-forest-50/80 border border-forest-200/80 flex items-center gap-2.5 text-xs text-forest-900">
            <svg class="w-4 h-4 text-forest-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            <span>Data asesmen dan percakapanmu <strong>dijaga rahasia sepenuhnya</strong>.</span>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-3.5 text-sm font-extrabold uppercase tracking-wider">
                Masuk ke Ruang Tumbuh
            </button>
        </div>

        <div class="text-center mt-5 pt-4 border-t border-sand-200">
            <p class="text-xs text-ink-500">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="text-forest-800 hover:text-terra-600 font-extrabold transition-colors ml-1">
                    Daftar Akun Siswa Baru &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
