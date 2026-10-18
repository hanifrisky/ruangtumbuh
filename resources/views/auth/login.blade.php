<x-guest-layout>
    <div class="mb-6 space-y-2">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-forest-900 border border-emerald-300 text-xs font-black shadow-xs">
            <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
            <span>Langkah 2 • Akses Ruang Pribadi</span>
        </div>
        <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 tracking-tight">Selamat Datang Kembali!</h2>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
            Masuk dengan <strong>Email</strong> atau <strong>Username</strong> akun Ruang Tumbuh kamu untuk melanjutkan sesi konseling dan refleksi.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address or Username -->
        <div>
            <label for="email" class="form-label text-forest-950">Email atau Username</label>
            <input id="email"
                   type="text"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username"
                   class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                   placeholder="Contoh: siswa@example.com atau nama_user" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="form-label text-forest-950 mb-0">Kata Sandi</label>
            </div>
            <div class="relative" x-data="{ show: false }">
                <input id="password"
                       :type="show ? 'text' : 'password'"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="form-input pr-12 focus:border-emerald-600 focus:ring-emerald-500/20"
                       placeholder="••••••••" />
                <button type="button"
                        @click="show = !show"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-forest-800 transition-colors focus:outline-none p-1.5"
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

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       name="remember"
                       class="rounded-lg border-emerald-300 text-emerald-700 focus:ring-emerald-500 w-4 h-4">
                <span class="ms-2 text-xs text-slate-700 font-bold">Ingat saya di perangkat ini</span>
            </label>
        </div>

        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200/90 flex items-center gap-2.5 text-xs text-forest-950 font-medium">
            <span class="text-base flex-shrink-0">🔒</span>
            <span>Data asesmen dan riwayat konselingmu <strong>dijamin 100% rahasia & aman</strong>.</span>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-4 rounded-2xl text-base font-extrabold shadow-lg shadow-forest-800/25 hover:shadow-xl hover:scale-[1.01] transition-all">
                Masuk ke Ruang Tumbuh &rarr;
            </button>
        </div>

        <div class="text-center mt-5 pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-600 font-medium">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="text-emerald-700 hover:text-forest-900 font-extrabold transition-colors ml-1 underline decoration-2 decoration-emerald-400">
                    Daftar Akun Siswa Baru &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
