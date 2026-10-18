<x-guest-layout>
    <div class="mb-6 space-y-2">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-forest-900 border border-emerald-300 text-xs font-black shadow-xs">
            <span>🔐 Pembaruan Kata Sandi</span>
        </div>
        <h2 class="font-display font-black text-2xl sm:text-3xl text-forest-950 tracking-tight">Buat Kata Sandi Baru</h2>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
            Masukkan kata sandi baru untuk akun Ruang Tumbuh kamu.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label text-forest-950">Alamat Email</label>
            <input id="email"
                   class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                   type="email"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   required
                   autofocus
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="form-label text-forest-950">Kata Sandi Baru</label>
            <input id="password"
                   class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                   type="password"
                   name="password"
                   required
                   autocomplete="new-password"
                   placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="form-label text-forest-950">Ulangi Kata Sandi Baru</label>
            <input id="password_confirmation"
                   class="form-input focus:border-emerald-600 focus:ring-emerald-500/20"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   placeholder="Ketik ulang kata sandi baru" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-4 rounded-2xl text-base font-extrabold shadow-lg shadow-forest-800/25 hover:shadow-xl hover:scale-[1.01] transition-all">
                Simpan Kata Sandi Baru &rarr;
            </button>
        </div>
    </form>
</x-guest-layout>
