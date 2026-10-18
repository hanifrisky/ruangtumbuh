@extends('layouts.base')

@section('title', 'Informasi & Tim Pengembang - Ruang Tumbuh')
@section('description', 'Tentang Model, Tim Pengembang, dan Alamat Kontak Ruang Tumbuh - Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang')

@section('body')
<div class="min-h-screen bg-[#F8FAFC] text-slate-800">
    {{-- Header Navigation (60% White) --}}
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200 py-3.5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-10 h-10 rounded-2xl object-cover bg-white shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform">
                <div>
                    <span class="font-sans font-black text-lg text-forest-900 leading-none block">RUANG TUMBUH</span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 block mt-0.5">Informasi & Pengembang</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="/" class="text-xs font-bold text-slate-600 hover:text-forest-800 transition-colors">
                    &larr; Beranda
                </a>
                <a href="{{ route('konseling-online') }}" class="btn-primary py-2 px-4 text-xs font-bold">
                    Konseling Online
                </a>
            </div>
        </div>
    </header>

    {{-- 30% Green Hero Header (Inspired by the poster's bottom deep green section) --}}
    <div class="bg-gradient-to-br from-forest-950 via-forest-900 to-forest-850 text-white py-14 sm:py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="max-w-7xl mx-auto space-y-4 relative z-10">
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-emerald-200 text-xs font-bold uppercase tracking-wider">
                    Departemen BK FIP Universitas Negeri Malang
                </span>
                <span class="px-3 py-1 rounded-full bg-sky-500/20 border border-sky-400/40 text-sky-200 text-xs font-bold">
                    #RisetUnggulanUM
                </span>
            </div>
            <h1 class="font-sans text-3xl sm:text-4xl xl:text-5xl font-black text-white max-w-3xl leading-tight tracking-tight">
                Mengenal Model Konseling & Tim Pengembang Ruang Tumbuh
            </h1>
            <p class="text-sm sm:text-base text-emerald-100 max-w-2xl leading-relaxed font-light">
                Platform riset pengembangan model konseling online bermuatan nilai kearifan lokal untuk meningkatkan psychological well-being remaja dengan ide bunuh diri.
            </p>
        </div>
    </div>

    {{-- Seksi 1: Tentang Model (60% White Canvas) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 space-y-8">
        <div class="max-w-3xl space-y-2">
            <span class="text-xs font-black uppercase tracking-wider text-forest-800 bg-forest-50 px-3 py-1 rounded-full border border-forest-200">
                Landasan Ilmiah
            </span>
            <h2 class="font-sans text-2xl sm:text-3xl font-black text-slate-900">
                Tentang Model Konseling RUANG TUMBUH
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <div class="card p-7 sm:p-9 bg-white border border-slate-200 space-y-4 shadow-sm">
                <h3 class="font-sans text-lg font-bold text-forest-900">Rasionalitas & Kepekaan Konteks Remaja</h3>
                <p class="text-sm text-slate-600 leading-relaxed font-normal">
                    Pengembangan model konseling ini berakar pada kepedulian mendalam terhadap fenomena peningkatan distres emosional dan ide bunuh diri pada remaja di Indonesia. Seringkali, remaja menghadapi hambatan stigma, keterbatasan akses bantuan profesional, serta perasaan tidak dipahami saat mengalami krisis emosional.
                </p>
                <p class="text-sm text-slate-600 leading-relaxed font-normal">
                    Model <strong>RUANG TUMBUH</strong> hadir menjembatani kebutuhan tersebut melalui pendekatan <em>Rational Emotive Behavior Therapy</em> (REBT) yang dikontekstualisasikan dengan kearifan lokal nusantara, menghadirkan intervensi kognitif yang tetap bersahabat dengan nilai budaya keluarga dan komunitas siswa.
                </p>
            </div>

            <div class="card p-7 sm:p-9 bg-white border border-slate-200 space-y-4 shadow-sm">
                <h3 class="font-sans text-lg font-bold text-forest-900">Integrasi Nilai Budaya & Well-Being</h3>
                <p class="text-sm text-slate-600 leading-relaxed font-normal">
                    Nilai kearifan lokal berfungsi sebagai sumber metafora, refleksi eksistensial, dan pengingat akan pentingnya jejaring dukungan sosial (*solidaritas dan gotong royong*). Model ini memandu konseli mengidentifikasi keyakinan irasional yang menyudutkan diri sendiri dan mentransformasikannya menjadi keyakinan rasional yang menumbuhkan harapan.
                </p>
                <p class="text-sm text-slate-600 leading-relaxed font-normal">
                    Orientasi akhir layanan diarahkan pada 6 dimensi <em>Psychological Well-Being</em> Carol D. Ryff, memastikan setiap sesi tidak hanya mereduksi risiko ide bunuh diri, namun juga memperkuat keberfungsian positif remaja dalam jangka panjang.
                </p>
            </div>
        </div>
    </section>

    {{-- Seksi 2: 7 Tim Pengembang --}}
    @php
        $developers = [
            ['name' => 'Prof. Dr. M. Ramli, M.A', 'role' => 'Guru Besar Bimbingan & Konseling UM'],
            ['name' => 'Prof. Dr. Juntika Nurihsan, M.Pd', 'role' => 'Pakar Bimbingan & Konseling Indonesia'],
            ['name' => 'Prof. Dr. Zadrian Ardi, S.Pd., M.Pd., Kons', 'role' => 'Guru Besar Bimbingan & Konseling'],
            ['name' => 'Prof. Dr. Nur Hidayah, M.Pd', 'role' => 'Guru Besar Bimbingan & Konseling UM'],
            ['name' => 'Dr. Nur Mega Aris Saputra, S.Pd., M.Pd', 'role' => 'Ketua Tim Peneliti & Dosen BK FIP UM'],
            ['name' => 'Dr. Juwanto, S.Pd.I., M.Pd', 'role' => 'Dosen & Peneliti Bimbingan Konseling FIP UM'],
            ['name' => 'Ade Herdian Putra, S.Pd., M.Pd. Kons', 'role' => 'Konselor & Tim Peneliti BK FIP UM'],
        ];
    @endphp
    <section class="bg-white py-14 sm:py-20 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="max-w-3xl space-y-2">
                <span class="card-program-badge text-[11px]">
                    Akademisi & Peneliti
                </span>
                <h2 class="font-sans text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Tim Pengembang Model RUANG TUMBUH
                </h2>
                <p class="text-xs sm:text-sm text-slate-500">
                    Model konseling ini dikonstruksi dan divalidasi oleh 7 akademisi dan praktisi Bimbingan dan Konseling terkemuka.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($developers as $idx => $dev)
                    <div class="card p-6 bg-white border border-slate-200 hover:-translate-y-1 transition-all flex flex-col justify-between shadow-sm">
                        <div>
                            <div class="w-full aspect-square rounded-2xl bg-gradient-to-br from-forest-900 to-forest-800 border border-forest-700 overflow-hidden flex items-center justify-center font-sans font-black text-3xl text-white shadow-inner mb-4">
                                {{ strtoupper(substr(preg_replace('/^(Prof\.|Dr\.|M\.|Muh\.)\s*/i', '', $dev['name']), 0, 2)) }}
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-forest-700 block mb-1">Pengembang #0{{ $idx + 1 }}</span>
                            <h3 class="font-sans text-base font-bold text-slate-900 leading-snug">{{ $dev['name'] }}</h3>
                            <p class="text-xs text-slate-500 mt-1 font-normal">{{ $dev['role'] }}</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] font-bold text-forest-800">
                            <span>Departemen BK FIP UM</span>
                            <span class="text-sky-600">✦</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Seksi 3: Alamat & Kontak --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
        <div class="card p-8 sm:p-12 bg-white border border-slate-200 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-4">
                    <span class="text-xs font-black uppercase tracking-wider text-forest-800 bg-forest-50 px-3 py-1 rounded-full border border-forest-200">
                        Sekretariat Riset
                    </span>
                    <h2 class="font-sans text-2xl sm:text-3xl font-black text-slate-900">
                        Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang
                    </h2>
                    <p class="text-sm text-slate-600 leading-relaxed font-light">
                        Gedung D2 Fakultas Ilmu Pendidikan, Universitas Negeri Malang<br>
                        Jl. Semarang No. 5, Kota Malang, Jawa Timur 65145
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="https://wa.me/6281231750634" target="_blank" class="btn-primary py-3 px-6 text-xs font-bold uppercase tracking-wider">
                            Hubungi via WhatsApp
                        </a>
                        <a href="mailto:aris.saputra.fip@um.ac.id" class="btn-secondary py-3 px-6 text-xs font-bold">
                            Kirim Email Resmi
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5 p-6 rounded-3xl bg-slate-50 border border-slate-200 space-y-3">
                    <h4 class="font-sans text-base font-bold text-forest-900">Saluran Narahubung Resmi</h4>
                    <div class="space-y-2 text-xs">
                        <div class="p-3 rounded-2xl bg-white border border-slate-200">
                            <span class="text-slate-400 block font-semibold">Koordinator Peneliti:</span>
                            <span class="font-bold text-slate-900 text-sm">Dr. Nur Mega Aris Saputra, S.Pd., M.Pd</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white border border-slate-200">
                            <span class="text-slate-400 block font-semibold">Nomor WhatsApp:</span>
                            <span class="font-bold text-forest-800 text-sm">+62 812-3175-0634</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-white border border-slate-200">
                            <span class="text-slate-400 block font-semibold">Email:</span>
                            <span class="font-bold text-forest-800 text-sm">aris.saputra.fip@um.ac.id</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-forest-950 text-white py-8 border-t border-forest-900 text-xs text-center text-emerald-200">
        <p>&copy; {{ date('Y') }} RUANG TUMBUH — Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang.</p>
    </footer>
</div>
@endsection
