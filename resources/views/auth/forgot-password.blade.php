<x-guest-layout>
    <div class="mb-6 space-y-2">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-forest-900 border border-emerald-300 text-xs font-black shadow-xs">
            <span>🔑 Atur Ulang Kata Sandi</span>
        </div>
        <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 tracking-tight">Lupa Kata Sandi?</h2>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
            Tidak masalah! Masukkan alamat email yang terdaftar pada akun Ruang Tumbuh kamu, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi baru.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label text-forest-950">Alamat Email Terdaftar</label>
            <input id="email"
                   class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-4 rounded-2xl text-base font-extrabold shadow-lg shadow-forest-800/25 hover:shadow-xl hover:scale-[1.01] transition-all">
                Kirim Tautan Atur Ulang Sandi &rarr;
            </button>
        </div>

        <div class="text-center mt-4 pt-3 border-t border-slate-100">
            <a href="{{ route('login') }}" class="text-xs text-emerald-700 hover:text-forest-900 font-extrabold transition-colors">
                &larr; Ingat kata sandi? Masuk di sini
            </a>
        </div>
    </form>
</x-guest-layout>
