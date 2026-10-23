@extends('layouts.base')

@section('title', 'Informasi & Tim Pengembang - Ruang Tumbuh')
@section('description', 'Tentang Model, Tim Pengembang, dan Alamat Kontak Ruang Tumbuh - Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang')

@section('body')
<div class="min-h-screen bg-[#F0FDF4] text-slate-800">
    
    {{-- Header Navigation (Playful Modern Green Theme) --}}
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-emerald-100 py-3.5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('image/logo-mark.png') }}" alt="RUANG TUMBUH" class="w-10 h-10 rounded-2xl object-cover bg-white shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform">
                <div>
                    <span class="font-display font-black text-xl text-forest-950 leading-none block">RUANG TUMBUH</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-700 block mt-1">BK FIP Universitas Negeri Malang</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="/" class="text-xs font-extrabold text-slate-600 hover:text-emerald-700 transition-colors py-2 px-3 rounded-xl hover:bg-emerald-50">
                    &larr; Beranda
                </a>
                <a href="{{ route('register') }}" class="btn-primary py-2.5 px-5 text-xs font-extrabold rounded-full shadow-md shadow-forest-800/20">
                    Daftar Akun Siswa
                </a>
            </div>
        </div>
    </header>

    {{-- Hero Section: Playful Modern Green with Wavy Divider --}}
    <section class="relative pt-10 sm:pt-16 pb-0 overflow-hidden bg-gradient-to-b from-white via-emerald-50/40 to-[#F0FDF4]">
        
        {{-- Decorative Wavy Glow Blobs --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-200/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-20 w-80 h-80 bg-lime-200/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6 text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100 text-forest-900 border border-emerald-300 text-xs font-black shadow-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                <span>Departemen BK FIP Universitas Negeri Malang</span>
                <span class="bg-lime-300 text-forest-950 px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider">Riset & Model</span>
            </div>

            <h1 class="font-display font-black text-4xl sm:text-5xl lg:text-6xl text-forest-950 tracking-tight leading-tight">
                Mengenal Model & Tim Pengembang <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-emerald-700 to-forest-800">RUANG TUMBUH</span>
            </h1>

            <p class="text-slate-700 text-base sm:text-lg leading-relaxed font-medium max-w-3xl mx-auto">
                Platform riset pengembangan model konseling online bermuatan nilai kearifan lokal untuk meningkatkan <em>psychological well-being</em> remaja dengan ide bunuh diri.
            </p>
        </div>

        {{-- Wavy Organic SVG Divider directly connected to white section --}}
        <div class="w-full overflow-hidden leading-none mt-12 sm:mt-16 text-white -mb-px">
            <svg class="relative block w-full h-14 sm:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,140.83,111.45,200.74,99,240.23,90.81,280.23,64.1,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    {{-- Seksi 1: Tentang Model (White Canvas) --}}
    <section class="bg-white py-16 sm:py-24 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-7xl mx-auto space-y-12">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-forest-900 text-xs font-black uppercase tracking-wider">
                    Landasan Filosofis & Ilmiah
                </span>
                <h2 class="font-display font-black text-3xl sm:text-4xl text-forest-950 tracking-tight">
                    Tentang Model Konseling RUANG TUMBUH
                </h2>
                <p class="text-slate-600 text-base">
                    Model ini dirancang sebagai ruang pendampingan yang aman, suportif, dan inklusif bagi remaja.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                {{-- Card 1 --}}
                <div class="p-8 sm:p-10 rounded-[2.5rem] bg-gradient-to-br from-emerald-50 via-teal-50/50 to-lime-50/40 border-2 border-emerald-200/90 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-2xl shadow-md">
                        🧠
                    </div>
                    <h3 class="font-display font-black text-2xl text-forest-950">Rasionalitas & Kepekaan Remaja</h3>
                    <p class="text-slate-700 text-base leading-relaxed font-medium">
                        Pengembangan model konseling ini berakar pada kepedulian mendalam terhadap fenomena peningkatan distres emosional dan ide bunuh diri pada remaja di Indonesia. Seringkali, remaja menghadapi hambatan stigma, keterbatasan akses bantuan profesional, serta perasaan tidak dipahami saat mengalami krisis emosional.
                    </p>
                    <p class="text-slate-700 text-base leading-relaxed font-medium">
                        Model <strong>RUANG TUMBUH</strong> hadir menjembatani kebutuhan tersebut melalui pendekatan <em>Rational Emotive Behavior Therapy</em> (REBT) yang dikontekstualisasikan dengan kearifan lokal nusantara.
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="p-8 sm:p-10 rounded-[2.5rem] bg-gradient-to-br from-emerald-50 via-teal-50/50 to-lime-50/40 border-2 border-emerald-200/90 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-forest-800 text-white flex items-center justify-center font-black text-2xl shadow-md">
                        🌾
                    </div>
                    <h3 class="font-display font-black text-2xl text-forest-950">Integrasi Nilai Budaya & Well-Being</h3>
                    <p class="text-slate-700 text-base leading-relaxed font-medium">
                        Nilai kearifan lokal berfungsi sebagai sumber metafora, refleksi eksistensial, dan pengingat akan pentingnya jejaring dukungan sosial (solidaritas dan gotong royong). Model ini memandu konseli mengenali dan mengevaluasi keyakinan yang tidak rasional serta menumbuhkan kembali keyakinan alternatif yang rasional.
                    </p>
                    <p class="text-slate-700 text-base leading-relaxed font-medium">
                        Orientasi akhir layanan diarahkan pada 6 dimensi <em>Psychological Well-Being</em> Carol D. Ryff, memastikan setiap sesi tidak hanya mereduksi distres emosional, tetapi juga memperkuat makna hidup remaja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Wavy Transition to Tim Pengembang --}}
    <div class="w-full overflow-hidden leading-none text-emerald-950 bg-white -mb-px">
        <svg class="relative block w-full h-12 sm:h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,90 350,-40 500,60 C650,160 900,10 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
        </svg>
    </div>

    {{-- Seksi 2: 7 Tim Pengembang (Emerald-950 Playful Section) --}}
    @php
        $developers = [
            ['name' => 'Prof. Dr. M. Ramli, M.A', 'role' => 'Guru Besar Bimbingan & Konseling UM', 'slug' => 'ramli'],
            ['name' => 'Prof. Dr. Juntika Nurihsan, M.Pd', 'role' => 'Pakar Bimbingan & Konseling Indonesia', 'slug' => 'juntika-nurihsan'],
            ['name' => 'Prof. Dr. Zadrian Ardi, S.Pd., M.Pd., Kons', 'role' => 'Guru Besar Bimbingan & Konseling', 'slug' => 'zadrian-ardi'],
            ['name' => 'Prof. Dr. Nur Hidayah, M.Pd', 'role' => 'Guru Besar Bimbingan & Konseling UM', 'slug' => 'nur-hidayah'],
            ['name' => 'Dr. Nur Mega Aris Saputra, S.Pd., M.Pd', 'role' => 'Ketua Tim Peneliti & Dosen BK FIP UM', 'slug' => 'aris-saputra'],
            ['name' => 'Dr. Juwanto, S.Pd.I., M.Pd', 'role' => 'Dosen & Peneliti Bimbingan Konseling FIP UM', 'slug' => 'juwanto'],
            ['name' => 'Ade Herdian Putra, S.Pd., M.Pd. Kons', 'role' => 'Konselor & Tim Peneliti BK FIP UM', 'slug' => 'ade-herdian'],
        ];
    @endphp
    <section class="bg-emerald-950 text-white py-16 sm:py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="max-w-7xl mx-auto space-y-12 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-block px-4 py-1.5 rounded-full bg-lime-300 text-forest-950 text-xs font-black uppercase tracking-wider">
                    ✦ Akademisi & Peneliti Pengembang
                </span>
                <h2 class="font-display font-black text-3xl sm:text-5xl text-white tracking-tight">
                    Tim Pengembang Model Ruang Tumbuh
                </h2>
                <p class="text-emerald-100/90 text-base">
                    Model konseling online ini dikonstruksi dan divalidasi oleh 7 akademisi dan pakar Bimbingan dan Konseling terkemuka.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($developers as $idx => $dev)
                    @php
                        $photoFound = null;
                        foreach (['png', 'jpg', 'jpeg', 'webp'] as $ext) {
                            $path = 'image/team/' . $dev['slug'] . '.' . $ext;
                            if (file_exists(public_path($path))) {
                                $photoFound = asset($path);
                                break;
                            }
                        }
                    @endphp
                    <div class="p-6 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 hover:border-lime-300 hover:bg-white/15 transition-all duration-300 flex flex-col justify-between group">
                        <div class="space-y-4">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden bg-gradient-to-tr from-emerald-500 to-lime-300 text-forest-950 font-black text-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300 border-2 border-white/20">
                                @if($photoFound)
                                    <img src="{{ $photoFound }}" alt="Foto {{ $dev['name'] }}" class="w-full h-full object-cover object-top">
                                @else
                                    <span>{{ strtoupper(substr(preg_replace('/^(Prof\.|Dr\.|M\.|Muh\.)\s*/i', '', $dev['name']), 0, 2)) }}</span>
                                @endif
                            </div>
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-wider text-lime-300 block mb-1">Pengembang #0{{ $idx + 1 }}</span>
                                <h3 class="font-display font-black text-lg text-white leading-snug group-hover:text-lime-200 transition-colors">{{ $dev['name'] }}</h3>
                                <p class="text-xs text-emerald-200 mt-1 font-medium">{{ $dev['role'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-between text-[11px] font-bold text-emerald-300">
                            <span>Departemen BK FIP UM</span>
                            <span class="text-lime-300">✦</span>
                        </div>
                    </div>
                @endforeach
            </div>
                            <span>Departemen BK FIP UM</span>
                            <span class="text-lime-300">✦</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Wavy Transition to Alamat & Kontak --}}
    <div class="w-full overflow-hidden leading-none text-emerald-950 bg-[#F0FDF4] -mb-px">
        <svg class="relative block w-full h-12 sm:h-16 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,90 350,-40 500,60 C650,160 900,10 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
        </svg>
    </div>

    {{-- Seksi 3: Alamat & Kontak Resmi --}}
    <section class="bg-[#F0FDF4] py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="p-8 sm:p-14 rounded-[3rem] bg-white border-2 border-emerald-200 shadow-xl shadow-forest-900/5">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    <div class="lg:col-span-7 space-y-5">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-forest-900 text-xs font-black uppercase tracking-wider">
                            Sekretariat Riset
                        </span>
                        <h2 class="font-display font-black text-3xl sm:text-4xl text-forest-950 tracking-tight leading-tight">
                            Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang
                        </h2>
                        <p class="text-slate-600 text-base leading-relaxed">
                            Gedung D2 Fakultas Ilmu Pendidikan, Universitas Negeri Malang<br>
                            Jl. Semarang No. 5, Kota Malang, Jawa Timur 65145
                        </p>
                        <div class="flex flex-wrap gap-4 pt-2">
                            <a href="https://wa.me/6281231750634?text=Halo%20Tim%20Ruang%20Tumbuh%2C%20saya%20ingin%20bertanya%20mengenai%20layanan%20konseling."
                               target="_blank"
                               class="btn-primary py-4 px-7 text-sm font-extrabold rounded-2xl shadow-lg shadow-forest-800/20 hover:scale-[1.02] transition-all">
                                💬 Hubungi via WhatsApp
                            </a>
                            <a href="mailto:aris.saputra.fip@um.ac.id"
                               class="btn-secondary py-4 px-7 text-sm font-bold rounded-2xl border-2 border-emerald-200 hover:border-emerald-400 hover:bg-emerald-50 transition-all">
                                ✉️ Kirim Email Resmi
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-5 p-7 rounded-[2rem] bg-emerald-50/60 border-2 border-emerald-100 space-y-4">
                        <h4 class="font-display font-black text-lg text-forest-950">Saluran Narahubung Resmi</h4>
                        <div class="space-y-3 text-xs font-medium">
                            <div class="p-4 rounded-2xl bg-white border border-emerald-200/80 shadow-xs">
                                <span class="text-slate-400 block font-bold mb-0.5">Koordinator Peneliti:</span>
                                <span class="font-extrabold text-forest-950 text-sm">Dr. Nur Mega Aris Saputra, S.Pd., M.Pd</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-white border border-emerald-200/80 shadow-xs">
                                <span class="text-slate-400 block font-bold mb-0.5">Nomor WhatsApp:</span>
                                <span class="font-extrabold text-emerald-800 text-sm">+62 812-3175-0634</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-white border border-emerald-200/80 shadow-xs">
                                <span class="text-slate-400 block font-bold mb-0.5">Email Korespondensi:</span>
                                <span class="font-extrabold text-emerald-800 text-sm">aris.saputra.fip@um.ac.id</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-forest-950 text-white py-10 border-t border-forest-900 text-center text-xs text-emerald-200/80 space-y-2">
        <p class="font-bold">&copy; {{ date('Y') }} RUANG TUMBUH — Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang.</p>
        <p class="text-[11px] text-emerald-300/60">Platform Bimbingan & Konseling Online Remaja Berbasis Nilai Kearifan Lokal.</p>
    </footer>
</div>
@endsection
