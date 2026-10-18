<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Instrumen Well-Being dan Ide Bunuh Diri - {{ $type === 'pre_test' ? 'AWAL KONSELING' : 'SESUDAH KONSELING' }}</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 70px;
            vertical-align: middle;
        }
        .kop-logo img {
            width: 60px;
            height: 60px;
            border-radius: 12px;
        }
        .kop-text {
            vertical-align: middle;
            padding-left: 15px;
        }
        .kop-title {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: #1B4332;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }
        .kop-subtitle {
            margin: 2px 0 0 0;
            font-size: 10.5px;
            color: #475569;
            font-weight: 500;
        }
        .kop-divider-thick {
            height: 3px;
            background-color: #1B4332;
            margin-top: 10px;
        }
        .kop-divider-thin {
            height: 1px;
            background-color: #52B788;
            margin-top: 2px;
            margin-bottom: 20px;
        }
        .doc-title {
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 20px;
        }
        .meta-container {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .meta-container td {
            padding: 9px 12px;
            font-size: 10.5px;
            vertical-align: top;
        }
        .meta-label {
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            font-size: 9px;
            width: 130px;
        }
        .meta-val {
            color: #1e293b;
            font-weight: 600;
        }
        .meta-border-bottom {
            border-bottom: 1px solid #e2e8f0;
        }
        .meta-border-right {
            border-right: 1px solid #e2e8f0;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .results-left {
            width: 34%;
            padding-right: 12px;
            vertical-align: top;
        }
        .results-right {
            width: 66%;
            padding-left: 12px;
            vertical-align: top;
        }
        .score-card {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 14px;
            text-align: center;
            padding: 16px 10px;
        }
        .score-card-title {
            margin: 0 0 6px 0;
            font-size: 10px;
            font-weight: 700;
            color: #2D6A4F;
            text-transform: uppercase;
        }
        .score-number {
            font-size: 38px;
            font-weight: 800;
            color: #1B4332;
            line-height: 1;
            margin-bottom: 6px;
        }
        .score-desc {
            margin: 0;
            font-size: 9.5px;
            color: #2D6A4F;
            font-weight: 600;
        }
        .interpretation-card {
            background-color: #FAF7F2;
            border: 1px solid #E8E2D8;
            border-left: 5px solid #1B4332;
            border-radius: 4px 14px 14px 4px;
            padding: 14px;
        }
        .interpretation-title {
            margin: 0 0 6px 0;
            font-size: 11px;
            font-weight: 800;
            color: #1B4332;
            text-transform: uppercase;
        }
        .interpretation-text {
            margin: 0;
            font-size: 10.5px;
            color: #1C2526;
            line-height: 1.55;
        }
        .details-section-title {
            font-size: 12px;
            font-weight: 800;
            color: #1B4332;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-bottom: 2px solid #E8E2D8;
            padding-bottom: 5px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table th {
            background-color: #1B4332;
            color: #ffffff;
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #1B4332;
        }
        .details-table td {
            padding: 8px 10px;
            font-size: 10px;
            color: #334155;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .details-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center {
            text-align: center;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            border-top: 1px dashed #cbd5e1;
        }
        .footer-text {
            font-size: 9px;
            color: #64748b;
            line-height: 1.5;
            text-align: center;
            padding-top: 12px;
        }
    </style>
</head>
<body>
    @php
        $kategoriLabel = $type === 'pre_test' ? 'AWAL KONSELING (PRA-KONSELING)' : 'SESUDAH KONSELING (PASCA-KONSELING)';
        $wellBeingScore = $answer->well_being_score ?? $answer->details->filter(fn($d) => ($d->question->category ?? 'well_being') === 'well_being')->sum('score');
        $suicideIdeationScore = $answer->suicide_ideation_score ?? $answer->details->filter(fn($d) => ($d->question->category ?? '') === 'suicide_ideation')->sum('score');
    @endphp

    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                <img src="{{ public_path('image/logo-mark.png') }}" alt="Logo">
            </td>
            <td class="kop-text">
                <h1 class="kop-title">RUANG TUMBUH (RuangTumbuh.com)</h1>
                <p class="kop-subtitle">Konstruksi Model Teoritis Konseling Online Bermuatan Nilai Kearifan Lokal untuk Meningkatkan Well-Being Remaja dengan Ide Bunuh Diri</p>
            </td>
        </tr>
    </table>

    <div class="kop-divider-thick"></div>
    <div class="kop-divider-thin"></div>

    <div class="doc-title">
        Laporan Hasil Instrumen Well-Being dan Ide Bunuh Diri
    </div>

    <table class="meta-container">
        <tr>
            <td class="meta-label meta-border-bottom meta-border-right">Nama Konseli</td>
            <td class="meta-val meta-border-bottom meta-border-right">{{ $answer->konseli_name }}</td>
            <td class="meta-label meta-border-bottom">Kategori Pengisian</td>
            <td class="meta-val meta-border-bottom">{{ $kategoriLabel }}</td>
        </tr>
        <tr>
            <td class="meta-label meta-border-right">Tanggal Pengisian</td>
            <td class="meta-val meta-border-right">{{ $answer->completed_at->format('d F Y') }}</td>
            <td class="meta-label">Waktu Selesai</td>
            <td class="meta-val">{{ $answer->completed_at->format('H:i') }} WIB</td>
        </tr>
    </table>

    <table class="results-table">
        <tr>
            <td class="results-left">
                <div class="score-card">
                    <h2 class="score-card-title">Total Skor</h2>
                    <div class="score-number">{{ $answer->total_score }}</div>
                    <p class="score-desc">Well-Being: {{ $wellBeingScore }} | Ide Bunuh Diri: {{ $suicideIdeationScore }}</p>
                </div>
            </td>
            <td class="results-right">
                <div class="interpretation-card">
                    <h3 class="interpretation-title">Hasil Analisis & Interpretasi</h3>
                    <p class="interpretation-text">
                        {{ $answer->interpretation->description ?? 'Deskripsi interpretasi tidak ditemukan.' }}
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <div class="details-section-title">
        Rincian Respon Butir Instrumen Well-Being & Ide Bunuh Diri
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th style="width: 6%; text-align: center;">No</th>
                <th style="width: 24%;">Dimensi / Kategori</th>
                <th style="width: 48%;">Pernyataan Instrumen</th>
                <th style="width: 22%;">Jawaban Terpilih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answer->details as $index => $detail)
                <tr>
                    <td class="text-center font-bold" style="color: #64748b;">{{ $index + 1 }}</td>
                    <td>{{ $detail->question->dimension ?? 'Well-Being' }}</td>
                    <td>{{ $detail->question->text }}</td>
                    <td class="font-semibold" style="color: #1B4332;">{{ $detail->selectedOption->label }} ({{ $detail->score }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="footer-table">
        <tr>
            <td class="footer-text">
                Dokumen hasil pengukuran Instrumen Well-Being dan Ide Bunuh Diri ini dihasilkan oleh sistem digital RUANG TUMBUH.<br>
                Departemen Bimbingan dan Konseling FIP Universitas Negeri Malang &bull; Jl. Semarang No 5 Kota Malang.
            </td>
        </tr>
    </table>
</body>
</html>
