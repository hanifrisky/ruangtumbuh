<?php

namespace Database\Seeders;

use App\Models\Interpretation;
use App\Models\OptionGroup;
use App\Models\OptionItem;
use App\Models\Question;
use Illuminate\Database\Seeder;

class WellbeingQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kelompok Opsi Favorable (+) Skala Likert 5 Pilihan (Well-Being Positif)
        $groupPositif = OptionGroup::firstOrCreate(['name' => 'Skala Likert Positif (Favorable)']);

        $optionsPositif = [
            ['label' => 'Sangat Setuju', 'score' => 5, 'order' => 0],
            ['label' => 'Setuju', 'score' => 4, 'order' => 1],
            ['label' => 'Netral', 'score' => 3, 'order' => 2],
            ['label' => 'Tidak Setuju', 'score' => 2, 'order' => 3],
            ['label' => 'Sangat Tidak Setuju', 'score' => 1, 'order' => 4],
        ];

        foreach ($optionsPositif as $opt) {
            OptionItem::updateOrCreate(
                [
                    'option_group_id' => $groupPositif->id,
                    'label' => $opt['label'],
                ],
                [
                    'score' => $opt['score'],
                    'order' => $opt['order'],
                ]
            );
        }

        // 2. Kelompok Opsi Unfavorable (-) Skala Likert Terbalik (Well-Being Negatif)
        $groupNegatif = OptionGroup::firstOrCreate(['name' => 'Skala Likert Negatif (Unfavorable)']);

        $optionsNegatif = [
            ['label' => 'Sangat Setuju', 'score' => 1, 'order' => 0],
            ['label' => 'Setuju', 'score' => 2, 'order' => 1],
            ['label' => 'Netral', 'score' => 3, 'order' => 2],
            ['label' => 'Tidak Setuju', 'score' => 4, 'order' => 3],
            ['label' => 'Sangat Tidak Setuju', 'score' => 5, 'order' => 4],
        ];

        foreach ($optionsNegatif as $opt) {
            OptionItem::updateOrCreate(
                [
                    'option_group_id' => $groupNegatif->id,
                    'label' => $opt['label'],
                ],
                [
                    'score' => $opt['score'],
                    'order' => $opt['order'],
                ]
            );
        }

        // 3. Kelompok Opsi Indikator Risiko (Identifikasi Diri / Ide Bunuh Diri)
        $groupRisiko = OptionGroup::firstOrCreate(['name' => 'Skala Indikator Risiko (Ide Bunuh Diri)']);

        $optionsRisiko = [
            ['label' => 'Sangat Setuju', 'score' => 5, 'order' => 0],
            ['label' => 'Setuju', 'score' => 4, 'order' => 1],
            ['label' => 'Netral', 'score' => 3, 'order' => 2],
            ['label' => 'Tidak Setuju', 'score' => 2, 'order' => 3],
            ['label' => 'Sangat Tidak Setuju', 'score' => 1, 'order' => 4],
        ];

        foreach ($optionsRisiko as $opt) {
            OptionItem::updateOrCreate(
                [
                    'option_group_id' => $groupRisiko->id,
                    'label' => $opt['label'],
                ],
                [
                    'score' => $opt['score'],
                    'order' => $opt['order'],
                ]
            );
        }

        // 4. Bersihkan data pertanyaan lama
        Question::query()->delete();

        // 5. Data Butir Instrumen Sesuai INSTRUMENT.md
        $questionsData = [
            // === BAGIAN 1: PSYCHOLOGICAL WELL-BEING (CAROL D. RYFF - 25 BUTIR) ===
            // Dimensi 1: Penerimaan Diri (4 butir: 1, 3 [+]; 2, 4 [-])
            [
                'order' => 1,
                'category' => 'well_being',
                'dimension' => 'Penerimaan Diri',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya menerima kondisi diri saya apa adanya.',
            ],
            [
                'order' => 2,
                'category' => 'well_being',
                'dimension' => 'Penerimaan Diri',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya sulit menerima kekurangan yang ada pada diri saya.',
            ],
            [
                'order' => 3,
                'category' => 'well_being',
                'dimension' => 'Penerimaan Diri',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya merasa nyaman menjadi diri sendiri di tengah keluarga dan teman-teman saya.',
            ],
            [
                'order' => 4,
                'category' => 'well_being',
                'dimension' => 'Penerimaan Diri',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya sering menyesali diri sendiri atas hal-hal yang sudah terjadi.',
            ],

            // Dimensi 2: Relasi Positif (4 butir: 5, 7 [+]; 6, 8 [-])
            [
                'order' => 5,
                'category' => 'well_being',
                'dimension' => 'Relasi Positif',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya memiliki hubungan yang hangat dan saling percaya dengan orang-orang di sekitar saya.',
            ],
            [
                'order' => 6,
                'category' => 'well_being',
                'dimension' => 'Relasi Positif',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa sulit menjalin kedekatan dengan orang lain.',
            ],
            [
                'order' => 7,
                'category' => 'well_being',
                'dimension' => 'Relasi Positif',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya bisa menghargai perbedaan pendapat teman tanpa harus memusuhi mereka.',
            ],
            [
                'order' => 8,
                'category' => 'well_being',
                'dimension' => 'Relasi Positif',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa tidak ada orang yang benar-benar peduli dengan saya.',
            ],

            // Dimensi 3: Otonomi (4 butir: 9, 11 [+]; 10, 12 [-])
            [
                'order' => 9,
                'category' => 'well_being',
                'dimension' => 'Otonomi',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya mampu mengambil keputusan penting tanpa harus selalu bergantung pada orang lain.',
            ],
            [
                'order' => 10,
                'category' => 'well_being',
                'dimension' => 'Otonomi',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa tidak percaya diri mengambil keputusan sendiri.',
            ],
            [
                'order' => 11,
                'category' => 'well_being',
                'dimension' => 'Otonomi',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya berani menghadapi tantangan baru meski harus melakukannya sendiri.',
            ],
            [
                'order' => 12,
                'category' => 'well_being',
                'dimension' => 'Otonomi',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya mudah terpengaruh pendapat orang lain meski bertentangan dengan keyakinan saya.',
            ],

            // Dimensi 4: Penguasaan Lingkungan (4 butir: 13, 15 [+]; 14, 16 [-])
            [
                'order' => 13,
                'category' => 'well_being',
                'dimension' => 'Penguasaan Lingkungan',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya mampu mengatur tuntutan sekolah dan kehidupan sehari-hari saya dengan baik.',
            ],
            [
                'order' => 14,
                'category' => 'well_being',
                'dimension' => 'Penguasaan Lingkungan',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa kewalahan mengurus tanggung jawab sehari-hari saya.',
            ],
            [
                'order' => 15,
                'category' => 'well_being',
                'dimension' => 'Penguasaan Lingkungan',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya bisa memanfaatkan kesempatan di sekitar saya untuk mencapai tujuan saya.',
            ],
            [
                'order' => 16,
                'category' => 'well_being',
                'dimension' => 'Penguasaan Lingkungan',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa tidak mampu mengendalikan hal-hal penting yang terjadi dalam hidup saya.',
            ],

            // Dimensi 5: Tujuan Hidup (4 butir: 17, 19 [+]; 18, 20 [-])
            [
                'order' => 17,
                'category' => 'well_being',
                'dimension' => 'Tujuan Hidup',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya punya arah dan tujuan yang jelas dalam menjalani hidup saya.',
            ],
            [
                'order' => 18,
                'category' => 'well_being',
                'dimension' => 'Tujuan Hidup',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa hidup saya tidak memiliki arah yang jelas.',
            ],
            [
                'order' => 19,
                'category' => 'well_being',
                'dimension' => 'Tujuan Hidup',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya memiliki cita-cita yang ingin saya capai di masa depan.',
            ],
            [
                'order' => 20,
                'category' => 'well_being',
                'dimension' => 'Tujuan Hidup',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya sering merasa hidup ini tidak ada gunanya.',
            ],

            // Dimensi 6: Pertumbuhan Pribadi (5 butir: 21, 23, 25 [+]; 22, 24 [-])
            [
                'order' => 21,
                'category' => 'well_being',
                'dimension' => 'Pertumbuhan Pribadi',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya terus berusaha mengembangkan diri menjadi lebih baik dari waktu ke waktu.',
            ],
            [
                'order' => 22,
                'category' => 'well_being',
                'dimension' => 'Pertumbuhan Pribadi',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya merasa tidak ada perubahan berarti dalam diri saya belakangan ini.',
            ],
            [
                'order' => 23,
                'category' => 'well_being',
                'dimension' => 'Pertumbuhan Pribadi',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya terbuka terhadap pengalaman baru yang bisa menambah wawasan saya.',
            ],
            [
                'order' => 24,
                'category' => 'well_being',
                'dimension' => 'Pertumbuhan Pribadi',
                'type' => '-',
                'group_id' => $groupNegatif->id,
                'text' => 'Saya cenderung menghindari hal-hal yang menantang saya untuk berkembang.',
            ],
            [
                'order' => 25,
                'category' => 'well_being',
                'dimension' => 'Pertumbuhan Pribadi',
                'type' => '+',
                'group_id' => $groupPositif->id,
                'text' => 'Saya belajar dari kesalahan atau pengalaman untuk menjadi pribadi yang lebih baik.',
            ],

            // === BAGIAN 2: IDENTIFIKASI DIRI (IDE BUNUH DIRI - 12 BUTIR) ===
            // Aspek 1: Frekuensi dan Intensitas (butir global 26–28)
            [
                'order' => 26,
                'category' => 'suicide_ideation',
                'dimension' => 'Frekuensi dan Intensitas',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Dalam sebulan terakhir, saya memikirkan tentang mengakhiri hidup saya.',
            ],
            [
                'order' => 27,
                'category' => 'suicide_ideation',
                'dimension' => 'Frekuensi dan Intensitas',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa pikiran untuk mengakhiri hidup muncul berulang kali belakangan ini.',
            ],
            [
                'order' => 28,
                'category' => 'suicide_ideation',
                'dimension' => 'Frekuensi dan Intensitas',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Pikiran untuk mengakhiri hidup saya terasa semakin kuat dari waktu ke waktu.',
            ],

            // Aspek 2: Keputusasaan (butir global 29–31)
            [
                'order' => 29,
                'category' => 'suicide_ideation',
                'dimension' => 'Keputusasaan',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa tidak ada jalan keluar dari masalah yang saya hadapi.',
            ],
            [
                'order' => 30,
                'category' => 'suicide_ideation',
                'dimension' => 'Keputusasaan',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa masa depan saya terasa suram dan tanpa harapan.',
            ],
            [
                'order' => 31,
                'category' => 'suicide_ideation',
                'dimension' => 'Keputusasaan',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa apa pun yang saya lakukan tidak akan mengubah keadaan saya menjadi lebih baik.',
            ],

            // Aspek 3: Perasaan Menjadi Beban dan Keterasingan (butir global 32–34)
            [
                'order' => 32,
                'category' => 'suicide_ideation',
                'dimension' => 'Perasaan Menjadi Beban dan Keterasingan',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa menjadi beban bagi keluarga atau orang-orang terdekat saya.',
            ],
            [
                'order' => 33,
                'category' => 'suicide_ideation',
                'dimension' => 'Perasaan Menjadi Beban dan Keterasingan',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa orang lain akan lebih baik jika saya tidak ada.',
            ],
            [
                'order' => 34,
                'category' => 'suicide_ideation',
                'dimension' => 'Perasaan Menjadi Beban dan Keterasingan',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa terasing dan tidak terhubung dengan orang-orang di sekitar saya.',
            ],

            // Aspek 4: Kendali, Gangguan, dan Distres (butir global 35–37)
            [
                'order' => 35,
                'category' => 'suicide_ideation',
                'dimension' => 'Kendali, Gangguan, dan Distres',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya kesulitan mengendalikan pikiran tersebut ketika muncul.',
            ],
            [
                'order' => 36,
                'category' => 'suicide_ideation',
                'dimension' => 'Kendali, Gangguan, dan Distres',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Pikiran tersebut mengganggu aktivitas sekolah atau kegiatan sehari-hari saya.',
            ],
            [
                'order' => 37,
                'category' => 'suicide_ideation',
                'dimension' => 'Kendali, Gangguan, dan Distres',
                'type' => '-',
                'group_id' => $groupRisiko->id,
                'text' => 'Saya merasa tertekan/terbebani oleh pikiran-pikiran tersebut.',
            ],
        ];

        foreach ($questionsData as $q) {
            Question::create([
                'text' => $q['text'],
                'category' => $q['category'],
                'dimension' => $q['dimension'],
                'type' => $q['type'],
                'option_group_id' => $q['group_id'],
                'order' => $q['order'],
            ]);
        }

        // 6. Bersihkan interpretasi lama dan isi 5 Kategori Norma Well-Being (M = 91,70; SD = 11,93)
        Interpretation::query()->delete();

        $interpretations = [
            [
                'min_score' => 110,
                'max_score' => 125,
                'description' => 'Sangat Tinggi (Skor 110–125 | 7,2% Sampel Norma). Siswa menerima dirinya dengan baik, memiliki hubungan yang hangat, mandiri, mampu mengelola tuntutan hidup, memiliki arah hidup yang jelas, dan terus berkembang. Kondisi ini menjadi kekuatan yang dapat dikembangkan, misalnya sebagai pendamping sebaya.',
            ],
            [
                'min_score' => 98,
                'max_score' => 109,
                'description' => 'Tinggi (Skor 98–109 | 23,3% Sampel Norma). Kesejahteraan psikologis baik pada sebagian besar dimensi. Siswa umumnya mampu menghadapi tekanan sehari-hari secara adaptif.',
            ],
            [
                'min_score' => 86,
                'max_score' => 97,
                'description' => 'Sedang (Skor 86–97 | 40,3% Sampel Norma). Kesejahteraan psikologis cukup, tetapi ada dimensi tertentu yang belum optimal. Perhatikan profil dimensi untuk menemukan area yang perlu dikuatkan.',
            ],
            [
                'min_score' => 74,
                'max_score' => 85,
                'description' => 'Rendah (Skor 74–85 | 23,9% Sampel Norma). Kesejahteraan psikologis di bawah rata-rata teman sebaya. Siswa mungkin kesulitan menerima diri, merasa kurang terhubung, atau kurang memiliki arah hidup. Perlu pemantauan dan layanan penguatan.',
            ],
            [
                'min_score' => 0,
                'max_score' => 73,
                'description' => 'Sangat Rendah (Skor 25–73 | 5,3% Sampel Norma). Kesejahteraan psikologis jauh di bawah teman sebaya. Kondisi ini merupakan faktor risiko masalah kesehatan mental, termasuk ide bunuh diri. Prioritaskan untuk layanan responsif dan asesmen lanjutan.',
            ],
        ];

        foreach ($interpretations as $interp) {
            Interpretation::create($interp);
        }
    }
}
