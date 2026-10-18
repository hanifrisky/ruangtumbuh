<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Asesmen Psikologis - {{ $type === 'pre_test' ? 'Awal Konseling' : 'Sesudah Konseling' }} - {{ $answer->konseli_name }}</title>
    <style>
        @page {
            margin: 1.2cm 1.2cm 1.5cm 1.2cm;
            @bottom-right {
                content: "Halaman " counter(page) " dari " counter(pages);
                font-size: 8pt;
                color: #64748b;
            }
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.45;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-size: 9.5pt;
        }

        /* Kop Surat Resmi */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .kop-logo {
            width: 65px;
            vertical-align: middle;
        }
        .kop-logo img {
            width: 55px;
            height: 55px;
        }
        .kop-text {
            vertical-align: middle;
            padding-left: 12px;
        }
        .kop-title {
            margin: 0;
            font-size: 16pt;
            font-weight: 800;
            color: #1B4332;
            letter-spacing: 0.5px;
            line-height: 1.1;
        }
        .kop-subtitle {
            margin: 2px 0 0 0;
            font-size: 8pt;
            color: #475569;
            font-weight: 500;
            line-height: 1.3;
        }
        .kop-institution {
            margin: 2px 0 0 0;
            font-size: 7.5pt;
            color: #64748b;
            font-style: italic;
        }
        .kop-divider-thick {
            height: 2.5px;
            background-color: #1B4332;
            margin-top: 6px;
        }
        .kop-divider-thin {
            height: 0.8px;
            background-color: #52B788;
            margin-top: 2px;
            margin-bottom: 12px;
        }

        /* Judul Dokumen */
        .doc-title-container {
            text-align: center;
            margin-bottom: 12px;
        }
        .doc-title {
            font-size: 11pt;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 0;
        }
        .doc-subtitle {
            font-size: 8.5pt;
            color: #475569;
            margin-top: 2px;
        }
        .doc-badge {
            display: inline-block;
            margin-top: 4px;
            padding: 3px 10px;
            font-size: 8pt;
            font-weight: 700;
            text-transform: uppercase;
            background-color: #1B4332;
            color: #ffffff;
            border-radius: 12px;
        }

        /* Metadata Konseli */
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            margin-bottom: 14px;
            border-radius: 6px;
        }
        .meta-table td {
            padding: 6px 10px;
            font-size: 8.5pt;
            vertical-align: top;
            border-bottom: 1px solid #e2e8f0;
        }
        .meta-label {
            font-weight: bold;
            color: #475569;
            width: 18%;
            background-color: #f1f5f9;
        }
        .meta-val {
            color: #0f172a;
            font-weight: 600;
            width: 32%;
        }

        /* Alert / Status Skrining & Krisis */
        .alert-box {
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 12px;
            font-size: 8.5pt;
            line-height: 1.4;
            page-break-inside: avoid;
        }
        .alert-crisis {
            background-color: #fef2f2;
            border: 1.5px solid #dc2626;
            color: #991b1b;
        }
        .alert-priority {
            background-color: #fffbeb;
            border: 1.5px solid #d97706;
            color: #92400e;
        }
        .alert-normal {
            background-color: #f0fdf4;
            border: 1px solid #16a34a;
            color: #166534;
        }
        .alert-title {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 8.5pt;
            margin-bottom: 2px;
        }

        /* Score Summary Dual Grid */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            page-break-inside: avoid;
        }
        .summary-card {
            width: 48.5%;
            padding: 10px 12px;
            border-radius: 8px;
            vertical-align: top;
            border: 1px solid #cbd5e1;
        }
        .summary-card-wb {
            background-color: #f0fdf4;
            border-color: #86efac;
            border-left: 5px solid #1B4332;
        }
        .summary-card-suicide {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            border-left: 5px solid #334155;
        }
        .summary-header {
            font-size: 8pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1B4332;
            margin-bottom: 4px;
        }
        .summary-score {
            font-size: 24pt;
            font-weight: 900;
            color: #1B4332;
            line-height: 1;
            margin-bottom: 4px;
        }
        .summary-category {
            display: inline-block;
            font-size: 8.5pt;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 4px;
            margin-bottom: 6px;
        }
        .cat-sangat-tinggi { background-color: #15803d; color: #fff; }
        .cat-tinggi { background-color: #22c55e; color: #fff; }
        .cat-sedang { background-color: #eab308; color: #000; }
        .cat-rendah { background-color: #f97316; color: #fff; }
        .cat-sangat-rendah { background-color: #ef4444; color: #fff; }

        .summary-desc {
            font-size: 8pt;
            color: #334155;
            line-height: 1.35;
        }

        /* Section Headings */
        .section-header {
            font-size: 9.5pt;
            font-weight: 800;
            color: #1B4332;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1.5px solid #1B4332;
            padding-bottom: 3px;
            margin-top: 14px;
            margin-bottom: 8px;
            page-break-after: avoid;
        }

        /* Standard Data Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 8pt;
            page-break-inside: auto;
        }
        .data-table thead {
            display: table-header-group;
        }
        .data-table tr {
            page-break-inside: avoid;
        }
        .data-table th {
            background-color: #1B4332;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 7.5pt;
            padding: 5px 6px;
            border: 1px solid #1B4332;
            text-align: left;
        }
        .data-table td {
            padding: 5px 6px;
            border: 1px solid #cbd5e1;
            vertical-align: top;
            line-height: 1.3;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }

        /* Badge Tag */
        .badge {
            display: inline-block;
            font-size: 7pt;
            font-weight: 700;
            padding: 1.5px 5px;
            border-radius: 3px;
        }
        .badge-red { background-color: #fee2e2; color: #991b1b; border: 0.5px solid #f87171; }
        .badge-amber { background-color: #fef3c7; color: #92400e; border: 0.5px solid #fcd34d; }
        .badge-green { background-color: #dcfce7; color: #166534; border: 0.5px solid #86efac; }
        .badge-blue { background-color: #e0f2fe; color: #075985; border: 0.5px solid #7dd3fc; }

        /* Page Break Helpers */
        .page-break {
            page-break-before: always;
        }

        /* Signatures Section */
        .sig-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
            page-break-inside: avoid;
        }
        .sig-table td {
            width: 50%;
            vertical-align: top;
            text-align: center;
            font-size: 8.5pt;
        }
        .sig-space {
            height: 55px;
        }
        .sig-name {
            font-weight: bold;
            text-decoration: underline;
        }
        .sig-role {
            font-size: 7.5pt;
            color: #64748b;
        }

        /* Footer Note */
        .footer-note {
            margin-top: 16px;
            border-top: 1px dashed #cbd5e1;
            padding-top: 6px;
            text-align: center;
            font-size: 7pt;
            color: #64748b;
            line-height: 1.3;
        }
    </style>
</head>
<body>
    @php
        $userObj = $answer->konseli ?? auth()->user();
        $counselor = $userObj?->selectedCounselor;
        $counselorProfile = $counselor?->counselorProfile;

        $wbScore = $answer->computed_well_being_score;
        $suicideScore = $answer->computed_suicide_score;
        $wbMeanItem = round($wbScore / 25, 2);
        $suicideMeanItem = round($suicideScore / 12, 2);

        $wbCategory = $answer->well_being_category;
        $wbInterp = $answer->well_being_interpretation_text;
        $isSelective = $answer->is_selective_priority;

        $suicideCategory = $answer->suicide_category;
        $suicideInterp = $answer->suicide_interpretation_text;
        $isCrisis = $answer->is_crisis;

        $dimensions = $answer->dimensions_breakdown;
        $aspects = $answer->suicide_aspects_breakdown;

        $labelTahap = $type === 'pre_test' ? 'Awal Konseling (Pra-Konseling)' : 'Sesudah Konseling (Pasca-Konseling)';
        $badgeColor = $type === 'pre_test' ? '#1B4332' : '#0369a1';
    @endphp

    {{-- KOP DOKUMEN RESMI --}}
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                @if(file_exists(public_path('image/logo-mark.png')))
                    <img src="{{ public_path('image/logo-mark.png') }}" alt="Logo">
                @endif
            </td>
            <td class="kop-text">
                <h1 class="kop-title">RUANG TUMBUH (RuangTumbuh.com)</h1>
                <p class="kop-subtitle">Model Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri</p>
                <p class="kop-institution">Departemen Bimbingan dan Konseling, Fakultas Ilmu Pendidikan, Universitas Negeri Malang</p>
            </td>
        </tr>
    </table>

    <div class="kop-divider-thick"></div>
    <div class="kop-divider-thin"></div>

    {{-- JUDUL LAPORAN --}}
    <div class="doc-title-container">
        <h2 class="doc-title">Laporan Hasil Asesmen Psikologis</h2>
        <div class="doc-subtitle">Pengukuran Psychological Well-Being (Carol D. Ryff) & Identifikasi Diri (Ide Bunuh Diri)</div>
        <span class="doc-badge" style="background-color: {{ $badgeColor }};">Tahap: {{ $labelTahap }}</span>
    </div>

    {{-- TABEL IDENTITAS --}}
    <table class="meta-table">
        <tr>
            <td class="meta-label">Nama Konseli</td>
            <td class="meta-val">{{ $answer->konseli_name ?? $userObj?->name }}</td>
            <td class="meta-label">Asal Sekolah</td>
            <td class="meta-val">{{ $userObj?->school_origin ?? 'Tidak dicantumkan' }}</td>
        </tr>
        <tr>
            <td class="meta-label">Jenis Kelamin</td>
            <td class="meta-val">{{ $userObj?->gender ?? '-' }}</td>
            <td class="meta-label">Kelas</td>
            <td class="meta-val">{{ $userObj?->grade_class ?? '-' }}</td>
        </tr>
        <tr>
            <td class="meta-label">Waktu Selesai</td>
            <td class="meta-val">{{ $answer->completed_at ? $answer->completed_at->format('d F Y, H:i') . ' WIB' : '-' }}</td>
            <td class="meta-label">Konselor Pendamping</td>
            <td class="meta-val">{{ $counselor?->name ?? 'Belum memilih konselor' }}</td>
        </tr>
    </table>

    {{-- ALERT STATUS KRISIS / PRIORITAS SKRINING --}}
    @if($isCrisis)
        <div class="alert-box alert-crisis">
            <div class="alert-title">⚠ PERINGATAN KRISIS KLINIS: PRIORITAS TINGGI / TINDAKAN SEGERA</div>
            <div>
                Hasil asesmen menunjukkan indikasi risiko ide bunuh diri yang <strong>nyata dan membutuhkan respons cepat</strong> (Skor: {{ $suicideScore }}/60).
                Konselor diwajibkan melakukan penanganan pada hari yang sama, menyusun rencana keselamatan (*safety plan*), mengomunikasikan dengan orang tua/wali secara bijak, dan melakukan rujukan ke tenaga profesional kesehatan mental jika diperlukan.
            </div>
        </div>
    @elseif($isSelective)
        <div class="alert-box alert-priority">
            <div class="alert-title">⚡ PRIORITAS LAYANAN PENCEGAHAN SELEKTIF</div>
            <div>
                Skor Well-Being konseli ({{ $wbScore }}/125, rerata {{ $wbMeanItem }}) berada <strong>di bawah titik potong skrining (&le; 80)</strong>.
                Berdasarkan data norma riset (AUC = 0,81; NPV = 0,96), konseli merupakan sasaran prioritas intervensi preventif untuk mencegah eskalasi tekanan psikologis.
            </div>
        </div>
    @else
        <div class="alert-box alert-normal">
            <div class="alert-title">✓ STATUS SKRINING ADAPTIF</div>
            <div>
                Tingkat kesejahteraan psikologis berada dalam kategori memadai dan tidak terindikasi krisis aktif. Lanjutkan dengan layanan dasar dan penguatan potensi diri.
            </div>
        </div>
    @endif

    {{-- RINGKASAN EKSEKUTIF SKOR TOTAL --}}
    <table class="summary-table">
        <tr>
            <td class="summary-card summary-card-wb">
                <div class="summary-header">1. Psychological Well-Being (Carol D. Ryff)</div>
                <div class="summary-score">{{ $wbScore }} <span style="font-size: 11pt; font-weight: normal; color: #475569;">/ 125</span></div>
                <div>
                    @php
                        $wbCatClass = match($wbCategory) {
                            'Sangat Tinggi' => 'cat-sangat-tinggi',
                            'Tinggi' => 'cat-tinggi',
                            'Sedang' => 'cat-sedang',
                            'Rendah' => 'cat-rendah',
                            default => 'cat-sangat-rendah',
                        };
                    @endphp
                    <span class="summary-category {{ $wbCatClass }}">{{ $wbCategory }}</span>
                    <span style="font-size: 8pt; color: #475569; font-weight: bold; margin-left: 6px;">Rerata: {{ $wbMeanItem }} (Norma M=91,70; SD=11,93)</span>
                </div>
                <div class="summary-desc" style="margin-top: 4px;">
                    {{ $wbInterp }}
                </div>
            </td>
            <td style="width: 3%;"></td>
            <td class="summary-card summary-card-suicide">
                <div class="summary-header" style="color: #0f172a;">2. Identifikasi Diri (Ide Bunuh Diri)</div>
                <div class="summary-score" style="color: #0f172a;">{{ $suicideScore }} <span style="font-size: 11pt; font-weight: normal; color: #475569;">/ 60</span></div>
                <div>
                    @php
                        $suicideCatClass = match($suicideCategory) {
                            'Sangat Rendah' => 'cat-sangat-tinggi', // green
                            'Rendah' => 'cat-tinggi',
                            'Sedang' => 'cat-sedang',
                            'Tinggi' => 'cat-rendah',
                            default => 'cat-sangat-rendah', // red
                        };
                    @endphp
                    <span class="summary-category {{ $suicideCatClass }}">Tingkat Risiko: {{ $suicideCategory }}</span>
                    <span style="font-size: 8pt; color: #475569; font-weight: bold; margin-left: 6px;">Rerata: {{ $suicideMeanItem }} (Skala 1–5)</span>
                </div>
                <div class="summary-desc" style="margin-top: 4px;">
                    {{ $suicideInterp }}
                </div>
            </td>
        </tr>
    </table>

    {{-- BAGIAN 1: RINCIAN 6 DIMENSI WELL-BEING --}}
    <div class="section-header">
        Profil Analisis 6 Dimensi Psychological Well-Being
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;" class="text-center">No</th>
                <th style="width: 22%;">Dimensi (Rentang Skor)</th>
                <th style="width: 11%;" class="text-center">Skor Konseli</th>
                <th style="width: 11%;" class="text-center">Norma M (SD)</th>
                <th style="width: 14%;" class="text-center">Kategori</th>
                <th style="width: 38%;">Arah Rekomendasi Layanan Konseling</th>
            </tr>
        </thead>
        <tbody>
            @php $dimNo = 1; @endphp
            @foreach($dimensions as $name => $dim)
                @php
                    $dimCatBadge = match($dim['category']) {
                        'Sangat Tinggi', 'Tinggi' => 'badge-green',
                        'Sedang' => 'badge-blue',
                        'Rendah' => 'badge-amber',
                        default => 'badge-red',
                    };
                @endphp
                <tr>
                    <td class="text-center font-bold">{{ $dimNo++ }}</td>
                    <td>
                        <strong>{{ $name }}</strong>
                        <div style="font-size: 7pt; color: #64748b;">Maksimal: {{ $dim['max_score'] }} Poin</div>
                        @if($dim['is_critical_factor'] && $dim['is_low'])
                            <span class="badge badge-red" style="margin-top: 2px;">Faktor Risiko Utama</span>
                        @endif
                    </td>
                    <td class="text-center font-bold" style="font-size: 9pt; color: #1B4332;">{{ $dim['score'] }}</td>
                    <td class="text-center" style="font-size: 7.5pt; color: #475569;">{{ number_format($dim['mean'], 2) }} ({{ number_format($dim['sd'], 2) }})</td>
                    <td class="text-center">
                        <span class="badge {{ $dimCatBadge }}">{{ $dim['category'] }}</span>
                    </td>
                    <td>
                        <div style="color: #1e293b; font-weight: 600; font-size: 7.5pt; margin-bottom: 2px;">{{ $dim['meaning'] }}</div>
                        <div style="color: #1B4332; font-style: italic; font-size: 7pt;">&bull; Rekomendasi: {{ $dim['recommendation'] }}</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BAGIAN 2: RINCIAN 4 ASPEK IDENTIFIKASI DIRI --}}
    <div class="section-header">
        Profil Rincian 4 Aspek Identifikasi Diri (Ide Bunuh Diri)
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;" class="text-center">No</th>
                <th style="width: 28%;">Aspek Pengukuran</th>
                <th style="width: 12%;" class="text-center">Skor (3–15)</th>
                <th style="width: 16%;" class="text-center">Tingkat Risiko</th>
                <th style="width: 40%;">Makna Klinis & Catatan Pemantauan</th>
            </tr>
        </thead>
        <tbody>
            @php $aspNo = 1; @endphp
            @foreach($aspects as $name => $asp)
                @php
                    $aspBadge = match($asp['category']) {
                        'Sangat Rendah' => 'badge-green',
                        'Rendah' => 'badge-blue',
                        'Sedang' => 'badge-amber',
                        default => 'badge-red',
                    };
                @endphp
                <tr>
                    <td class="text-center font-bold">{{ $aspNo++ }}</td>
                    <td>
                        <strong>{{ $name }}</strong>
                    </td>
                    <td class="text-center font-bold" style="font-size: 9pt; color: {{ $asp['is_high'] ? '#b91c1c' : '#1e293b' }};">{{ $asp['score'] }}</td>
                    <td class="text-center">
                        <span class="badge {{ $aspBadge }}">{{ $asp['category'] }}</span>
                    </td>
                    <td style="font-size: 7.5pt;">
                        {{ $asp['description'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- REKOMENDASI UMUM KONSELING & PENGESAHAN (Halaman 1 atau 2 sesuai konten) --}}
    <div class="page-break"></div>

    {{-- TABEL AUDIT SELURUH BUTIR JAWABAN (25 BUTIR WELL-BEING & 12 BUTIR IDE BUNUH DIRI) --}}
    <div class="section-header">
        Rincian Respons Butir Instrumen — Bagian A: Well-Being (25 Butir)
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 22%;">Dimensi</th>
                <th style="width: 47%;">Pernyataan Instrumen</th>
                <th style="width: 7%;" class="text-center">Sifat</th>
                <th style="width: 13%;">Jawaban</th>
                <th style="width: 6%;" class="text-center">Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answer->details->filter(fn($d) => ($d->question->category ?? 'well_being') === 'well_being') as $index => $detail)
                <tr>
                    <td class="text-center font-bold" style="color: #64748b;">{{ $detail->question->order ?? ($index + 1) }}</td>
                    <td>{{ $detail->question->dimension ?? 'Well-Being' }}</td>
                    <td>{{ $detail->question->text }}</td>
                    <td class="text-center">
                        @if(($detail->question->type ?? '+') === '+')
                            <span class="badge badge-green">(+)</span>
                        @else
                            <span class="badge badge-amber">(−)</span>
                        @endif
                    </td>
                    <td class="font-bold" style="color: #1B4332; font-size: 7.5pt;">{{ $detail->selectedOption->label ?? '-' }}</td>
                    <td class="text-center font-bold">{{ $detail->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-header" style="margin-top: 14px;">
        Rincian Respons Butir Instrumen — Bagian B: Identifikasi Diri (12 Butir)
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 24%;">Aspek Risiko</th>
                <th style="width: 49%;">Pernyataan Instrumen</th>
                <th style="width: 16%;">Jawaban</th>
                <th style="width: 6%;" class="text-center">Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answer->details->filter(fn($d) => ($d->question->category ?? '') === 'suicide_ideation') as $index => $detail)
                <tr>
                    <td class="text-center font-bold" style="color: #64748b;">{{ $detail->question->order ?? ($index + 26) }}</td>
                    <td>{{ $detail->question->dimension ?? 'Identifikasi Diri' }}</td>
                    <td>{{ $detail->question->text }}</td>
                    <td class="font-bold" style="color: {{ $detail->score >= 4 ? '#b91c1c' : '#1B4332' }}; font-size: 7.5pt;">
                        {{ $detail->selectedOption->label ?? '-' }}
                    </td>
                    <td class="text-center font-bold" style="color: {{ $detail->score >= 4 ? '#b91c1c' : '#1e293b' }};">
                        {{ $detail->score }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- KESIMPULAN & TANDA TANGAN PENGESAHAN --}}
    <table class="sig-table">
        <tr>
            <td>
                Mengetahui & Menyetujui,<br>
                <strong>Konseli / Siswa</strong>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $answer->konseli_name ?? $userObj?->name }}</div>
                <div class="sig-role">Siswa Terdaftar RuangTumbuh.com</div>
            </td>
            <td>
                Malang, {{ $answer->completed_at ? $answer->completed_at->format('d F Y') : date('d F Y') }}<br>
                <strong>Konselor Pendamping</strong>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $counselor?->name ?? '( Konselor Ruang Tumbuh )' }}</div>
                <div class="sig-role">
                    {{ $counselorProfile?->title ?? 'Konselor Profesional BK FIP UM' }}
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        Dokumen Laporan Hasil Asesmen Psikologis ini dihasilkan secara otomatis oleh sistem digital <strong>RUANG TUMBUH</strong>.<br>
        Digunakan sebagai rujukan klinis dan edukatif pelaksanaan konseling online REBT bermuatan kearifan lokal.<br>
        Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang &bull; Jl. Semarang No. 5 Kota Malang.
    </div>
</body>
</html>
