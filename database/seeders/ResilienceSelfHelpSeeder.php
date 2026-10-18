<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialQuestion;
use App\Models\Tribe;
use Illuminate\Database\Seeder;

class ResilienceSelfHelpSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data modul lama agar sesuai struktur 5 Modul SFBC-Resiliensi terbaru
        Tribe::query()->delete();

        $module = Tribe::create([
            'name' => 'Modul Self-Help SFBC-Resiliensi',
        ]);

        // Pemetaan Kategori Tahapan SFBC:
        // W = Tahap 1: Tujuan
        // D = Tahap 2: Penemuan Exception
        // S = Tahap 3: Pelaksanaan Solusi
        // E = Tahap 4: Scaling
        // P = Tahap 5: Tugas
        $materials = [
            [
                'title' => '1. Modul Regulasi Diri (Mengelola Emosi & Ketenangan)',
                'values' => 'Self Regulation, Mengelola Emosi, Ketenangan Diri',
                'description' => 'Pernah merasa kesal, marah, atau tertekan sampai rasanya sulit berpikir jernih? Itu wajar kok! Di modul ini, kita akan bereksplorasi menemukan cara-cara sederhana yang paling cocok buat kamu untuk mengelola emosi dan menjaga ketenangan diri saat menghadapi situasi sulit.',
                'order' => 1,
                'questions' => [
                    'W' => [
                        'Bayangkan besok kamu bangun tidur dan emosimu terasa jauh lebih kesal. Hal kecil apa yang pertama kali ingin kamu lakukan agar bisa tenang?',
                    ],
                    'D' => [
                        'Kapan terakhir kali kamu merasa kesal atau marah, tapi berhasil menahan diri? Apa yang kamu lakukan waktu itu hingga bisa tenang?',
                    ],
                    'S' => [
                        'Trik menenangkan diri mana yang paling cocok untukmu dan ingin kamu coba lagi hari ini?',
                    ],
                    'E' => [
                        'Dari angka 1 – 10 (1 = gampang kesal/marah dan 10 = tenang banget), kamu ada di angka berapa hari ini? Apa hal kecil yang bisa bikin kamu naik 1 angka lebih tenang?',
                    ],
                    'P' => [
                        'Misi Hari Ini: Langkah-langkah kecil apa yang akan dilakukan agar kamu dapat hidup lebih tenang?',
                    ],
                ],
            ],
            [
                'title' => '2. Modul Kapasitas Adaptif (Menyesuaikan Diri & Bangkit)',
                'values' => 'Adaptive Capacity, Penyesuaian Diri, Bangkit dari Kegagalan',
                'description' => 'Kadang rencana yang sudah kita susun rapi bisa berubah mendadak atau berjalan tidak sesuai harapan. Lewat modul ini, kamu diajak mengenali kembali pengalaman keberhasilanmu dalam menyesuaikan diri di masa lalu dan merancang langkah kecil agar tetap tangguh menghadapi perubahan.',
                'order' => 2,
                'questions' => [
                    'W' => [
                        'Kalau rencana yang kamu buat mendadak berantakan besok, penyesuaian-diri seperti apa yang ingin kamu tunjukkan?',
                    ],
                    'D' => [
                        'Coba ingat saat kamu pernah gagal atau menghadapi perubahan mendadak di masa lalu. Apa yang akhirnya bikin kamu bisa menyesuaikan diri lagi?',
                    ],
                    'S' => [
                        'Cara penyesuaian diri apa yang pernah berhasil dulu dan mau kamu pakai lagi untuk menghadapi masalahmu sekarang?',
                    ],
                    'E' => [
                        'Dari angka 1 – 10 (1 = Sangat tidak bisa menyesuaikan diri – 10 = Sangat bisa menyesuaikan diri) dalam menghadapi situasi yang tidak sesuai harapan, kamu berada di angka berapa sekarang? Apa yang akan kamu lakukan agar naik satu angka semakin dapat menyesuaikan diri?',
                    ],
                    'P' => [
                        'Misi Hari Ini: Pilih minimal dua langkah kecil yang akan dilakukan agar dapat menyesuaikan diri dengan situasi yang berada di luar harapanmu?',
                    ],
                ],
            ],
            [
                'title' => '3. Modul Pemecahan Masalah (Mencari Jalan Keluar)',
                'values' => 'Problem Solving Competence, Mencari Jalan Keluar, Fokus Solusi',
                'description' => 'Setiap masalah pasti punya jalan keluar jika kita melihatnya selangkah demi selangkah. Di modul ini, kamu akan diajak berfokus pada solusi dan memilih tindakan paling sederhana yang siap kamu coba untuk membawa perubahan positif.',
                'order' => 3,
                'questions' => [
                    'W' => [
                        'Kalau masalah utamamu selesai begitu saja besok pagi, perubahan positif apa yang bakal dilihat teman atau keluarga dari dirimu?',
                    ],
                    'D' => [
                        'Pernah nggak kamu menghadapi masalah yang mirip, tapi dampaknya nggak seburuk itu? Langkah cerdas apa yang kamu ambil waktu itu?',
                    ],
                    'S' => [
                        'Dari beberapa pilihan jalan keluar yang ada di pikiranmu, tindakan paling kecil mana yang paling siap kamu coba sekarang?',
                    ],
                    'E' => [
                        'Dari angka 1 – 10 (1 = sangat tidak yakin – 10 = Sangat yakin), pada angka berapa keyakinan kamu dengan cara penyelesaian masalahmu saat ini? Ide baru apa yang bisa bikin angkamu naik 1 tingkat?',
                    ],
                    'P' => [
                        'Misi Hari Ini: Pilih minimal dua langkah yang gampang, lalu lakukan langkah itu untuk dapat mencapai perubahan positif!',
                    ],
                ],
            ],
            [
                'title' => '4. Modul Keterikatan Sosial (Membangun Hubungan & Meminta Bantuan)',
                'values' => 'Social Connectedness, Dukungan Sosial, Keberanian Meminta Bantuan',
                'description' => 'Kamu nggak harus menghadapi semuanya sendirian! Meminta bantuan atau bercerita kepada orang yang tepat justru tanda bahwa kamu peduli pada dirimu sendiri. Mari temukan cara nyaman untuk terhubung dan membangun dukungan positif dengan orang-orang di sekitarmu.',
                'order' => 4,
                'questions' => [
                    'W' => [
                        'Bayangkan kamu nggak merasa sendirian lagi besok. Bagaimana caramu menyapa atau mengobrol dengan orang-orang di sekitarmu?',
                    ],
                    'D' => [
                        'Kapan terakhir kali kamu memberanikan diri cerita atau minta bantuan kepada orang lain, dan ternyata respons mereka baik banget?',
                    ],
                    'S' => [
                        'Bantuan atau dukungan seperti apa yang paling kamu butuhkan saat ini dari orang-orang terdekatmu?',
                    ],
                    'E' => [
                        'Kalau rasa dekatmu dengan orang lain ada di angka 4 hari ini (dimana 1 = sangat jauh dan 10 = Sangat dekat), Apa yang akan dilakukan agar berada 1 tingkat di atas angka 4 tersebut?',
                    ],
                    'P' => [
                        'Misi Hari Ini: Lakukan minimal dua langkah kecil yang mudah dilakukan untuk bisa mendekati orang lain.',
                    ],
                ],
            ],
            [
                'title' => '5. Modul Orientasi Pertumbuhan (Semangat Maju & Belajar)',
                'values' => 'Growth Orientation, Semangat Belajar, Pemanfaatan Digital Positif',
                'description' => 'Setiap tantangan adalah kesempatan buat belajar dan berkembang menjadi versi dirimu yang lebih baik. Di modul terakhir ini, mari perjelas impian masa depanmu dan manfaatkan berbagai sarana—termasuk teknologi digital—untuk mendukung pertumbuhan dirimu!',
                'order' => 5,
                'questions' => [
                    'W' => [
                        'Kalau hidupmu berjalan makin baik ke depannya, impian atau keahlian baru apa yang paling ingin kamu capai?',
                    ],
                    'D' => [
                        'Kapan kamu merasa paling bersemangat belajar hal baru atau memakai internet/HP untuk hal-hal yang berguna buat dirimu?',
                    ],
                    'S' => [
                        'Kegiatan positif atau materi belajar apa yang paling ingin kamu coba hari ini untuk meningkatkan kemampuanmu?',
                    ],
                    'E' => [
                        'Dari angka 1 - 10 (1 = sangat tidak jelas – 10 = sangat jelas), pada angka berapa kejelasan gambaran masa depan yang kamu inginkan saat ini? Hal kecil apa yang bisa bikin gambaran itu makin jelas satu tingkat di atas angkamu sekarang?',
                    ],
                    'P' => [
                        'Misi Hari Ini: Hal-hal kecil apa yang akan dilakukan agar gambaran masa depanmu dapat dicapai dengan baik?',
                    ],
                ],
            ],
        ];

        foreach ($materials as $mData) {
            $material = Material::create([
                'tribe_id' => $module->id,
                'title' => $mData['title'],
                'values' => $mData['values'],
                'description' => $mData['description'],
                'order' => $mData['order'],
            ]);

            $order = 1;
            foreach ($mData['questions'] as $category => $qTexts) {
                foreach ($qTexts as $text) {
                    MaterialQuestion::create([
                        'material_id' => $material->id,
                        'category' => $category,
                        'text' => $text,
                        'order' => $order++,
                    ]);
                }
            }
        }
    }
}
