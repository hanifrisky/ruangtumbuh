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
        // 1. Buat Kelompok Opsi Favorable (+) Skala Likert 5 Pilihan
        $groupPositif = OptionGroup::firstOrCreate(['name' => 'Sangat Setuju (Positif)']);

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

        // 2. Buat Kelompok Opsi Unfavorable (-) / Ide Bunuh Diri Terbalik
        $groupNegatif = OptionGroup::firstOrCreate(['name' => 'Sangat Setuju (Negatif)']);

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

        // 3. Bersihkan soal lama dan isi Instrumen Well-Being (Carol D. Ryff 6 Dimensi) & Ide Bunuh Diri
        Question::query()->delete();

        $questionsData = [
            // === BAGIAN A: PSYCHOLOGICAL WELL-BEING (Carol D. Ryff - 6 Dimensi, 18 Item) ===
            // 1. Penerimaan Diri (Self-Acceptance)
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Penerimaan Diri (Self-Acceptance)', 'text' => 'Saya menerima kelebihan dan kekurangan yang ada pada diri saya dengan lapang dada.'],
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Penerimaan Diri (Self-Acceptance)', 'text' => 'Saya tetap menghargai diri saya meskipun pernah melakukan kesalahan di masa lalu.'],
            ['category' => 'well_being', 'type' => '-', 'dimension' => 'Penerimaan Diri (Self-Acceptance)', 'text' => 'Saya sering merasa kecewa dan menyalahkan diri sendiri atas kondisi hidup saya saat ini.'],

            // 2. Hubungan Positif dengan Orang Lain (Positive Relations with Others)
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Hubungan Positif dengan Orang Lain', 'text' => 'Saya memiliki teman atau keluarga yang dapat dipercaya untuk berbagi cerita ketika menghadapi masalah.'],
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Hubungan Positif dengan Orang Lain', 'text' => 'Saya merasa peduli terhadap kesejahteraan orang-orang di sekitar saya dan senang saling membantu.'],
            ['category' => 'well_being', 'type' => '-', 'dimension' => 'Hubungan Positif dengan Orang Lain', 'text' => 'Saya merasa sulit membuka diri atau menjalin hubungan yang hangat dengan orang lain.'],

            // 3. Otonomi / Kemandirian (Autonomy)
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Kemandirian (Autonomy)', 'text' => 'Saya mampu mengambil keputusan yang baik bagi diri saya tanpa mudah terbawa tekanan negatif dari lingkungan.'],
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Kemandirian (Autonomy)', 'text' => 'Saya berani menyampaikan pendapat dan perasaan saya secara sopan dan jujur.'],
            ['category' => 'well_being', 'type' => '-', 'dimension' => 'Kemandirian (Autonomy)', 'text' => 'Saya sangat bergantung pada penilaian orang lain dalam menilai berharga atau tidaknya diri saya.'],

            // 4. Penguasaan Lingkungan (Environmental Mastery)
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Penguasaan Lingkungan (Environmental Mastery)', 'text' => 'Saya mampu tetap tenang dan mengelola tanggung jawab sehari-hari ketika menghadapi situasi yang sulit.'],
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Penguasaan Lingkungan (Environmental Mastery)', 'text' => 'Saya berusaha mencari jalan keluar yang sehat ketika menghadapi tekanan di sekolah maupun di rumah.'],
            ['category' => 'well_being', 'type' => '-', 'dimension' => 'Penguasaan Lingkungan (Environmental Mastery)', 'text' => 'Saya sering merasa kewalahan dan tidak berdaya dalam mengatur kehidupan sehari-hari saya.'],

            // 5. Tujuan Hidup (Purpose in Life)
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Tujuan Hidup (Purpose in Life)', 'text' => 'Saya memiliki cita-cita dan arah tujuan hidup yang ingin saya wujudkan di masa depan.'],
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Tujuan Hidup (Purpose in Life)', 'text' => 'Saya meyakini bahwa setiap pengalaman hidup yang saya lalui memiliki hikmah dan makna tersendiri.'],
            ['category' => 'well_being', 'type' => '-', 'dimension' => 'Tujuan Hidup (Purpose in Life)', 'text' => 'Saya merasa aktivitas yang saya jalani setiap hari terasa hampa dan tidak memiliki tujuan yang jelas.'],

            // 6. Pertumbuhan Pribadi (Personal Growth)
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Pertumbuhan Pribadi (Personal Growth)', 'text' => 'Saya memandang tantangan dan kesulitan sebagai proses belajar untuk menjadi pribadi yang lebih matang.'],
            ['category' => 'well_being', 'type' => '+', 'dimension' => 'Pertumbuhan Pribadi (Personal Growth)', 'text' => 'Saya terbuka untuk mempelajari cara berpikir baru yang lebih sehat dan bijaksana.'],
            ['category' => 'well_being', 'type' => '-', 'dimension' => 'Pertumbuhan Pribadi (Personal Growth)', 'text' => 'Saya merasa tidak mampu lagi mengubah atau memperbaiki keadaan diri saya menjadi lebih baik.'],

            // === BAGIAN B: INSTRUMEN DETEKSI IDE BUNUH DIRI & HARAPAN HIDUP (12 Item) ===
            ['category' => 'suicide_ideation', 'type' => '+', 'dimension' => 'Harapan & Keinginan Hidup', 'text' => 'Saya masih memiliki harapan bahwa masa depan saya akan menjadi lebih baik dari hari ini.'],
            ['category' => 'suicide_ideation', 'type' => '+', 'dimension' => 'Harapan & Keinginan Hidup', 'text' => 'Saya meyakini bahwa hidup saya berharga dan layak untuk diperjuangkan.'],
            ['category' => 'suicide_ideation', 'type' => '+', 'dimension' => 'Dukungan & Ketahanan Diri', 'text' => 'Ketika merasa sangat tertekan, saya bersedia mencari bantuan kepada konselor atau orang yang saya percaya.'],
            ['category' => 'suicide_ideation', 'type' => '+', 'dimension' => 'Dukungan & Ketahanan Diri', 'text' => 'Nilai agama, budaya, dan kasih sayang keluarga menguatkan saya untuk tetap bertahan menghadapi ujian hidup.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Perasaan Putus Asa & Beban Diri', 'text' => 'Saya merasa masalah yang saya hadapi terlalu berat dan tidak ada lagi jalan keluarnya.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Perasaan Putus Asa & Beban Diri', 'text' => 'Saya merasa kehadiran saya hanya menjadi beban bagi keluarga atau orang-orang di sekitar saya.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Perasaan Kesepian & Terasing', 'text' => 'Saya merasa sendirian dan tidak ada satu pun orang yang benar-benar peduli pada penderitaan saya.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Pikiran Mengakhiri Hidup (Pasif)', 'text' => 'Terkadang muncul pikiran bahwa akan lebih tenang jika saya tidur dan tidak pernah terbangun lagi.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Pikiran Mengakhiri Hidup (Pasif)', 'text' => 'Saya pernah berpikir bahwa semua rasa sakit batin ini hanya bisa berhenti jika saya tidak ada lagi di dunia.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Dorongan Menyakiti Diri', 'text' => 'Ketika mengalami kesedihan atau kemarahan yang mendalam, muncul keinginan untuk melukai atau menyakiti diri sendiri.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Ide Bunuh Diri Aktif', 'text' => 'Dalam beberapa waktu terakhir, saya sempat memikirkan cara untuk mengakhiri hidup saya.'],
            ['category' => 'suicide_ideation', 'type' => '-', 'dimension' => 'Kontrol atas Pikiran Negatif', 'text' => 'Saya merasa kesulitan mengendalikan pikiran-pikiran negatif yang mendorong saya untuk menyerah pada hidup.'],
        ];

        foreach ($questionsData as $index => $q) {
            $groupId = ($q['type'] === '+') ? $groupPositif->id : $groupNegatif->id;

            Question::create([
                'text' => $q['text'],
                'category' => $q['category'],
                'dimension' => $q['dimension'],
                'option_group_id' => $groupId,
                'order' => $index + 1,
            ]);
        }

        // 4. Bersihkan interpretasi lama dan isi 5 Kategori Penilaian Instrumen Well-Being & Ide Bunuh Diri
        Interpretation::query()->delete();

        $interpretations = [
            [
                'min_score' => 30,
                'max_score' => 54,
                'description' => 'Tingkat Well-Being Sangat Rendah & Risiko Ide Bunuh Diri Tinggi (Skor 30–54). Konseli mengalami tekanan psikologis yang berat, perasaan putus asa, serta rentan terhadap pikiran menyakiti atau mengakhiri diri. Sangat disarankan untuk segera mengikuti sesi konseling intensif bersama Konselor Ruang Tumbuh guna merestrukturisasi pikiran irasional dan membangun kembali harapan hidup.',
            ],
            [
                'min_score' => 55,
                'max_score' => 78,
                'description' => 'Tingkat Well-Being Rendah & Kerentanan Ide Bunuh Diri Cukup Tinggi (Skor 55–78). Konseli cenderung merasa kewalahan menghadapi masalah, kurang menerima diri, dan sesekali muncul pikiran menyerah. Direkomendasikan mengikuti layanan Konseling Online Ruang Tumbuh secara terjadwal untuk memperkuat daya tahan psikologis dan dukungan sosial.',
            ],
            [
                'min_score' => 79,
                'max_score' => 102,
                'description' => 'Tingkat Well-Being Sedang & Risiko Ide Bunuh Diri Moderat (Skor 79–102). Konseli cukup mampu berfungsi dalam keseharian, namun masih mudah goyah dan ragu ketika menghadapi tekanan berat. Pendampingan konseling bermuatan nilai kearifan lokal akan membantu memantapkan penerimaan diri, tujuan hidup, dan ketenangan batin.',
            ],
            [
                'min_score' => 103,
                'max_score' => 126,
                'description' => 'Tingkat Well-Being Tinggi & Risiko Ide Bunuh Diri Rendah (Skor 103–126). Konseli memiliki penerimaan diri yang positif, mampu menjalin hubungan hangat dengan orang lain, memiliki arah hidup yang jelas, serta mampu mengelola pikiran negatif secara rasional dan sehat.',
            ],
            [
                'min_score' => 127,
                'max_score' => 150,
                'description' => 'Tingkat Well-Being Sangat Tinggi & Protektif terhadap Ide Bunuh Diri (Skor 127–150). Konseli memiliki kesejahteraan psikologis yang sangat optimal pada keenam dimensi Well-Being (Penerimaan Diri, Hubungan Positif, Otonomi, Penguasaan Lingkungan, Tujuan Hidup, dan Pertumbuhan Pribadi) serta mampu menghargai makna kehidupan secara utuh.',
            ],
        ];

        foreach ($interpretations as $interp) {
            Interpretation::create($interp);
        }
    }
}
