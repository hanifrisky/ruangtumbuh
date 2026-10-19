<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WellbeingAnswer extends Model
{
    protected $fillable = [
        'konseli_id',
        'type',
        'konseli_name',
        'status',
        'total_score',
        'well_being_score',
        'suicide_ideation_score',
        'interpretation_id',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function konseli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konseli_id');
    }

    public function interpretation(): BelongsTo
    {
        return $this->belongsTo(Interpretation::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(WellbeingAnswerDetail::class);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Hitung Skor Well-Being (Skala 25 - 125)
     */
    public function getComputedWellBeingScoreAttribute(): int
    {
        if ($this->well_being_score !== null) {
            return (int) $this->well_being_score;
        }

        if ($this->relationLoaded('details') || $this->details()->exists()) {
            $sum = (int) $this->details
                ->filter(fn ($d) => ($d->question->category ?? 'well_being') === 'well_being')
                ->sum('score');
            if ($sum > 0) {
                return $sum;
            }
        }

        return (int) ($this->total_score ?? 0);
    }

    public function getComputedWellBeingScore(): int
    {
        return $this->getComputedWellBeingScoreAttribute();
    }

    /**
     * Hitung Skor Ide Bunuh Diri (Skala 12 - 60)
     */
    public function getComputedSuicideScoreAttribute(): int
    {
        if ($this->suicide_ideation_score !== null) {
            return (int) $this->suicide_ideation_score;
        }

        if ($this->relationLoaded('details') || $this->details()->exists()) {
            return (int) $this->details
                ->filter(fn ($d) => ($d->question->category ?? '') === 'suicide_ideation')
                ->sum('score');
        }

        return 0;
    }

    public function getComputedSuicideScore(): int
    {
        return $this->getComputedSuicideScoreAttribute();
    }

    /**
     * Kategori Skor Total Well-Being
     */
    public function getWellBeingCategoryAttribute(): string
    {
        $score = $this->getComputedWellBeingScore();

        return match (true) {
            $score >= 110 => 'Sangat Tinggi',
            $score >= 98  => 'Tinggi',
            $score >= 86  => 'Sedang',
            $score >= 74  => 'Rendah',
            default       => 'Sangat Rendah',
        };
    }

    /**
     * Deskripsi Lengkap Interpretasi Well-Being
     */
    public function getWellBeingInterpretationTextAttribute(): string
    {
        $score = $this->getComputedWellBeingScore();

        return match (true) {
            $score >= 110 => 'Siswa menerima dirinya dengan baik, memiliki hubungan yang hangat, mandiri, mampu mengelola tuntutan hidup, memiliki arah hidup yang jelas, dan terus berkembang. Kondisi ini menjadi kekuatan yang dapat dikembangkan, misalnya sebagai pendamping sebaya.',
            $score >= 98  => 'Kesejahteraan psikologis baik pada sebagian besar dimensi. Siswa umumnya mampu menghadapi tekanan sehari-hari secara adaptif.',
            $score >= 86  => 'Kesejahteraan psikologis cukup, tetapi ada dimensi tertentu yang belum optimal. Perhatikan profil dimensi untuk menemukan area yang perlu dikuatkan.',
            $score >= 74  => 'Kesejahteraan psikologis di bawah rata-rata teman sebaya. Siswa mungkin kesulitan menerima diri, merasa kurang terhubung, atau kurang memiliki arah hidup. Perlu pemantauan dan layanan penguatan.',
            default       => 'Kesejahteraan psikologis jauh di bawah teman sebaya. Kondisi ini merupakan faktor risiko masalah kesehatan mental, termasuk ide bunuh diri. Prioritaskan untuk layanan responsif dan asesmen lanjutan.',
        };
    }

    /**
     * Skrining Titik Potong Well-Being (<= 80)
     */
    public function getIsSelectivePriorityAttribute(): bool
    {
        return $this->getComputedWellBeingScore() <= 80;
    }

    /**
     * Kategori Skor Ide Bunuh Diri (Identifikasi Diri)
     */
    public function getSuicideCategoryAttribute(): string
    {
        $score = $this->getComputedSuicideScore();

        return match (true) {
            $score >= 51 => 'Sangat Tinggi',
            $score >= 41 => 'Tinggi',
            $score >= 32 => 'Sedang',
            $score >= 22 => 'Rendah',
            default      => 'Sangat Rendah',
        };
    }

    /**
     * Deskripsi Interpretasi Ide Bunuh Diri
     */
    public function getSuicideInterpretationTextAttribute(): string
    {
        $score = $this->getComputedSuicideScore();

        return match (true) {
            $score >= 51 => 'SITUASI KRISIS: Ide bunuh diri kuat, berulang, dan sulit dikendalikan. Lakukan penanganan pada hari yang sama, libatkan orang tua, dan segera rujuk ke layanan kesehatan mental profesional.',
            $score >= 41 => 'Ide bunuh diri tampak jelas dan mengganggu. Perlu penanganan segera oleh guru BK, penyusunan rencana keselamatan (safety planning), dan rujukan ke tenaga profesional.',
            $score >= 32 => 'Terdapat keputusasaan atau perasaan menjadi beban yang cukup kuat dan mungkin disertai pikiran tentang kematian. Perlu konseling individual intensif dan asesmen lanjutan.',
            $score >= 22 => 'Muncul sebagian perasaan negatif, misalnya putus asa atau merasa menjadi beban, tetapi belum mengarah pada pikiran mengakhiri hidup. Perlu pemantauan berkala.',
            default      => 'Tidak tampak ide bunuh diri. Cukup diberikan layanan dasar, bimbingan klasikal, dan promosi kesehatan mental.',
        };
    }

    /**
     * Deteksi Status Krisis Ide Bunuh Diri
     */
    public function getIsCrisisAttribute(): bool
    {
        $suicideScore = $this->getComputedSuicideScore();
        if ($suicideScore >= 41) {
            return true;
        }

        // Cek jika ada butir inti frekuensi/intensitas (butir 1-3) yang dijawab S (4) atau SS (5)
        $highCoreItems = $this->details
            ->filter(fn ($d) => ($d->question->category ?? '') === 'suicide_ideation')
            ->filter(fn ($d) => ($d->question->dimension ?? '') === 'Frekuensi dan Intensitas')
            ->filter(fn ($d) => $d->score >= 4)
            ->isNotEmpty();

        return $highCoreItems;
    }

    /**
     * Rincian Lengkap 6 Dimensi Well-Being (Carol D. Ryff)
     */
    public function getDimensionsBreakdownAttribute(): array
    {
        $dimensionDefs = [
            'Penerimaan Diri' => [
                'min' => 4, 'max' => 20, 'mean' => 13.31, 'sd' => 2.55,
                'categories' => [
                    ['min' => 4, 'max' => 9, 'label' => 'Sangat Rendah'],
                    ['min' => 10, 'max' => 12, 'label' => 'Rendah'],
                    ['min' => 13, 'max' => 14, 'label' => 'Sedang'],
                    ['min' => 15, 'max' => 17, 'label' => 'Tinggi'],
                    ['min' => 18, 'max' => 20, 'label' => 'Sangat Tinggi'],
                ],
                'meaning_low' => 'Sulit menerima kekurangan, sering menyesali diri, kurang nyaman menjadi diri sendiri.',
                'meaning_high' => 'Sikap positif terhadap diri dan pengalaman masa lalu.',
                'recommendation' => 'Konseling penerimaan diri, restrukturisasi kognitif (REBT), dan latihan welas diri (self-compassion).',
                'is_critical_factor' => false,
            ],
            'Relasi Positif' => [
                'min' => 4, 'max' => 20, 'mean' => 14.82, 'sd' => 2.39,
                'categories' => [
                    ['min' => 4, 'max' => 11, 'label' => 'Sangat Rendah'],
                    ['min' => 12, 'max' => 13, 'label' => 'Rendah'],
                    ['min' => 14, 'max' => 16, 'label' => 'Sedang'],
                    ['min' => 17, 'max' => 18, 'label' => 'Tinggi'],
                    ['min' => 19, 'max' => 20, 'label' => 'Sangat Tinggi'],
                ],
                'meaning_low' => 'Merasa sulit dekat dengan orang lain dan kurang dipedulikan.',
                'meaning_high' => 'Hubungan hangat, saling percaya, dan empatik.',
                'recommendation' => 'Bimbingan kelompok keterampilan sosial dan penguatan dukungan teman sebaya.',
                'is_critical_factor' => true, // Korelasi -0.83 dengan ide bunuh diri
            ],
            'Otonomi' => [
                'min' => 4, 'max' => 20, 'mean' => 13.82, 'sd' => 2.51,
                'categories' => [
                    ['min' => 4, 'max' => 10, 'label' => 'Sangat Rendah'],
                    ['min' => 11, 'max' => 12, 'label' => 'Rendah'],
                    ['min' => 13, 'max' => 15, 'label' => 'Sedang'],
                    ['min' => 16, 'max' => 17, 'label' => 'Tinggi'],
                    ['min' => 18, 'max' => 20, 'label' => 'Sangat Tinggi'],
                ],
                'meaning_low' => 'Ragu mengambil keputusan dan mudah terbawa pendapat orang lain.',
                'meaning_high' => 'Mandiri dan teguh pada keyakinan pribadi.',
                'recommendation' => 'Latihan asertivitas dan pengambilan keputusan mandiri.',
                'is_critical_factor' => false,
            ],
            'Penguasaan Lingkungan' => [
                'min' => 4, 'max' => 20, 'mean' => 14.20, 'sd' => 2.36,
                'categories' => [
                    ['min' => 4, 'max' => 10, 'label' => 'Sangat Rendah'],
                    ['min' => 11, 'max' => 13, 'label' => 'Rendah'],
                    ['min' => 14, 'max' => 15, 'label' => 'Sedang'],
                    ['min' => 16, 'max' => 17, 'label' => 'Tinggi'],
                    ['min' => 18, 'max' => 20, 'label' => 'Sangat Tinggi'],
                ],
                'meaning_low' => 'Merasa kewalahan dan tidak mampu mengendalikan hidup.',
                'meaning_high' => 'Mampu mengatur tuntutan dan memanfaatkan kesempatan.',
                'recommendation' => 'Manajemen waktu, pemecahan masalah (problem-solving), dan regulasi stres.',
                'is_critical_factor' => false,
            ],
            'Tujuan Hidup' => [
                'min' => 4, 'max' => 20, 'mean' => 15.94, 'sd' => 2.89,
                'categories' => [
                    ['min' => 4, 'max' => 11, 'label' => 'Sangat Rendah'],
                    ['min' => 12, 'max' => 14, 'label' => 'Rendah'],
                    ['min' => 15, 'max' => 17, 'label' => 'Sedang'],
                    ['min' => 18, 'max' => 20, 'label' => 'Tinggi'], // Efek plafon
                ],
                'meaning_low' => 'Merasa hidup tidak berarah atau tidak berguna.',
                'meaning_high' => 'Memiliki arah, tujuan, dan makna hidup yang jelas.',
                'recommendation' => 'Konseling makna hidup (logotherapy/REBT meaning-making) dan perencanaan karier.',
                'is_critical_factor' => true, // Korelasi -0.79 dengan ide bunuh diri
            ],
            'Pertumbuhan Pribadi' => [
                'min' => 5, 'max' => 25, 'mean' => 19.60, 'sd' => 2.76,
                'categories' => [
                    ['min' => 5, 'max' => 15, 'label' => 'Sangat Rendah'],
                    ['min' => 16, 'max' => 18, 'label' => 'Rendah'],
                    ['min' => 19, 'max' => 20, 'label' => 'Sedang'],
                    ['min' => 21, 'max' => 23, 'label' => 'Tinggi'],
                    ['min' => 24, 'max' => 25, 'label' => 'Sangat Tinggi'],
                ],
                'meaning_low' => 'Menghindari tantangan dan merasa tidak berkembang.',
                'meaning_high' => 'Terbuka pada pengalaman dan terus mengembangkan diri.',
                'recommendation' => 'Penetapan tujuan pengembangan diri (goal setting) dan pola pikir bertumbuh (growth mindset).',
                'is_critical_factor' => false,
            ],
        ];

        $results = [];
        foreach ($dimensionDefs as $name => $def) {
            $dimDetails = $this->details->filter(fn ($d) => ($d->question->dimension ?? '') === $name);
            $score = $dimDetails->sum('score');

            $category = 'Sedang';
            foreach ($def['categories'] as $cat) {
                if ($score >= $cat['min'] && $score <= $cat['max']) {
                    $category = $cat['label'];
                    break;
                }
            }

            $results[$name] = [
                'name' => $name,
                'score' => $score,
                'max_score' => $def['max'],
                'mean' => $def['mean'],
                'sd' => $def['sd'],
                'category' => $category,
                'meaning' => in_array($category, ['Rendah', 'Sangat Rendah']) ? $def['meaning_low'] : $def['meaning_high'],
                'recommendation' => $def['recommendation'],
                'is_critical_factor' => $def['is_critical_factor'],
                'is_low' => in_array($category, ['Rendah', 'Sangat Rendah']),
            ];
        }

        return $results;
    }

    /**
     * Rincian Lengkap 4 Aspek Identifikasi Diri (Ide Bunuh Diri)
     */
    public function getSuicideAspectsBreakdownAttribute(): array
    {
        $aspectDefs = [
            'Frekuensi dan Intensitas' => [
                'range' => '3–15',
                'description' => 'Pikiran mengakhiri hidup muncul dalam sebulan terakhir, berulang, dan makin kuat. Aspek ini paling langsung menandai risiko krisis.',
                'items' => [26, 27, 28],
            ],
            'Keputusasaan' => [
                'range' => '3–15',
                'description' => 'Siswa melihat masa depan suram dan merasa tidak ada jalan keluar. Prediktor kuat ide bunuh diri di kemudian hari.',
                'items' => [29, 30, 31],
            ],
            'Perasaan Menjadi Beban dan Keterasingan' => [
                'range' => '3–15',
                'description' => 'Siswa merasa menjadi beban dan tidak terhubung dengan orang lain. Aspek paling dominan pada norma.',
                'items' => [32, 33, 34],
            ],
            'Kendali, Gangguan, dan Distres' => [
                'range' => '3–15',
                'description' => 'Pikiran tersebut sulit dikendalikan, mengganggu aktivitas sekolah atau kegiatan sehari-hari, serta menimbulkan tekanan batin.',
                'items' => [35, 36, 37],
            ],
        ];

        $results = [];
        foreach ($aspectDefs as $name => $def) {
            $aspDetails = $this->details->filter(fn ($d) => ($d->question->dimension ?? '') === $name);
            $score = $aspDetails->sum('score');

            $category = match (true) {
                $score >= 13 => 'Sangat Tinggi',
                $score >= 11 => 'Tinggi',
                $score >= 8  => 'Sedang',
                $score >= 6  => 'Rendah',
                default      => 'Sangat Rendah',
            };

            $results[$name] = [
                'name' => $name,
                'score' => $score,
                'max_score' => 15,
                'category' => $category,
                'description' => $def['description'],
                'is_high' => in_array($category, ['Tinggi', 'Sangat Tinggi']),
            ];
        }

        return $results;
    }
}
