<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CounselorSeeder extends Seeder
{
    public function run(): void
    {
        // Clean up any old placeholder counselors (konselor8..12, alma)
        User::whereIn('email', [
            'alma.konselor@ruangtumbuh.com',
            'konselor8@ruangtumbuh.com',
            'konselor9@ruangtumbuh.com',
            'konselor10@ruangtumbuh.com',
            'konselor11@ruangtumbuh.com',
            'konselor12@ruangtumbuh.com',
        ])->delete();

        $counselors = [
            // 1–7: Tim Pengembang & Konselor
            [
                'order_number' => 1,
                'name' => 'Prof. Dr. M. Ramli, M.A',
                'username' => 'm.ramli',
                'email' => 'm.ramli.fip@um.ac.id',
                'whatsapp_number' => '081231750634',
                'motto' => 'Mendampingi remaja menemukan makna hidup melalui kearifan budaya Nusantara',
                'description' => "Tim Pengembang & Konselor Ruang Tumbuh\nDepartemen Bimbingan dan Konseling - Fakultas Ilmu Pendidikan Universitas Negeri Malang",
                'photo_path' => 'image/team/ramli.png',
                'is_developer' => true,
            ],
            [
                'order_number' => 2,
                'name' => 'Prof. Dr. Juntika Nurihsan, M.Pd',
                'username' => 'juntika.nurihsan',
                'email' => 'juntika.nurihsan@ruangtumbuh.com',
                'whatsapp_number' => '081231750634',
                'motto' => 'Membangun kesejahteraan psikologis dan kedamaian batin secara holistik',
                'description' => "Tim Pengembang & Konselor Ruang Tumbuh\nGuru Besar Bimbingan dan Konseling",
                'photo_path' => 'image/team/juntika-nurihsan.png',
                'is_developer' => true,
            ],
            [
                'order_number' => 3,
                'name' => 'Prof. Dr. Nur Hidayah, M.Pd',
                'username' => 'nur.hidayah',
                'email' => 'nur.hidayah.fip@um.ac.id',
                'whatsapp_number' => '081231750634',
                'motto' => 'Berpikir rasional dan berdaya melalui nilai luhur kearifan lokal',
                'description' => "Tim Pengembang & Konselor Ruang Tumbuh\nDepartemen Bimbingan dan Konseling - Fakultas Ilmu Pendidikan Universitas Negeri Malang",
                'photo_path' => 'image/team/nur-hidayah.png',
                'is_developer' => true,
            ],
            [
                'order_number' => 4,
                'name' => 'Prof. Dr. Zadrian Ardi, S.Pd., M.Pd., Kons',
                'username' => 'zadrian.ardi',
                'email' => 'zadrian.ardi@ruangtumbuh.com',
                'whatsapp_number' => '081231750634',
                'motto' => 'Menghadirkan ruang konseling online yang aman, empatik, dan profesional',
                'description' => "Tim Pengembang & Konselor Ruang Tumbuh\nGuru Besar Bimbingan dan Konseling",
                'photo_path' => 'image/team/zadrian-ardi.png',
                'is_developer' => true,
            ],
            [
                'order_number' => 5,
                'name' => 'Dr. Nur Mega Aris Saputra, S.Pd., M.Pd',
                'username' => 'aris.saputra',
                'email' => 'aris.saputra.fip@um.ac.id',
                'whatsapp_number' => '081231750634',
                'motto' => 'Yakin pada diri, mensyukuri nikmat',
                'description' => "Tim Pengembang & Dosen Bimbingan dan Konseling - Universitas Negeri Malang\nS1 Bimbingan dan Konseling - Universitas Negeri Malang (2017-2021)\nS2 Bimbingan dan Konseling - Universitas Negeri Malang (2021-2022)\nS3 Bimbingan dan Konseling - Universitas Negeri Malang",
                'photo_path' => 'image/team/aris-saputra.png',
                'is_developer' => true,
            ],
            [
                'order_number' => 6,
                'name' => 'Dr. Juwanto, S.Pd.I., M.Pd',
                'username' => 'juwanto',
                'email' => 'juwanto@ruangtumbuh.com',
                'whatsapp_number' => '081231750634',
                'motto' => 'Menumbuhkan harapan dan ketahanan diri melalui refleksi nilai kehidupan',
                'description' => "Tim Pengembang & Konselor Ruang Tumbuh\nBimbingan dan Konseling",
                'photo_path' => 'image/team/juwanto.png',
                'is_developer' => true,
            ],
            [
                'order_number' => 7,
                'name' => 'Ade Herdian Putra, S.Pd., M.Pd. Kons',
                'username' => 'ade.herdian',
                'email' => 'ade.herdian@ruangtumbuh.com',
                'whatsapp_number' => '081231750634',
                'motto' => 'Setiap remaja memiliki kekuatan untuk bangkit dan bertumbuh',
                'description' => "Tim Pengembang & Konselor Ruang Tumbuh\nBimbingan dan Konseling",
                'photo_path' => 'image/team/ade-herdian.png',
                'is_developer' => true,
            ],
            // 8–12: Konselor Ruang Tumbuh (Total 12 Konselor)
            [
                'order_number' => 8,
                'name' => 'Nail Hidaya Afandi, S.Pd., M.Pd',
                'username' => 'nail.hidaya',
                'email' => 'nail.hidaya.2301119@students.um.ac.id',
                'whatsapp_number' => '081378516305',
                'motto' => 'Hidup adalah eksperimen',
                'description' => "Konselor Ruang Tumbuh / Mahasiswi S3 Bimbingan dan Konseling Universitas Negeri Malang\nS1 Bimbingan dan Konseling - Universitas Negeri Malang (2017-2021)\nS2 Bimbingan dan Konseling - Universitas Negeri Malang (2021-2022)\nS3 Bimbingan dan Konseling - Universitas Negeri Malang (2023-Sekarang)",
                'photo_path' => 'image/counselors/nail-hidaya.png',
                'is_developer' => false,
            ],
            [
                'order_number' => 9,
                'name' => 'Muh. Khoirudin Jalil, S.Pd., M.Pd',
                'username' => 'khoirudin.jalil',
                'email' => 'm.khoirudin.2301118@students.um.ac.id',
                'whatsapp_number' => '081358991943',
                'motto' => 'Aku Berpikir Maka Aku Hidup',
                'description' => "Konselor Ruang Tumbuh / Mahasiswa S3 Bimbingan dan Konseling Universitas Negeri Malang\nS1 Bimbingan dan Konseling Islam - Universitas Islam Negeri Jember (2018-2022)\nS2 Bimbingan dan Konseling - Universitas Negeri Malang (2023-2024)\nS3 Bimbingan dan Konseling - Universitas Negeri Malang (2024-Sekarang)",
                'photo_path' => 'image/team/khoiruddin-jalil.png',
                'is_developer' => false,
            ],
            [
                'order_number' => 10,
                'name' => 'Alivia Eka Ariyanti, S.Pd., M.Pd',
                'username' => 'alivia.eka',
                'email' => 'alivia.eka.2301118@students.um.ac.id',
                'whatsapp_number' => '089678286737',
                'motto' => 'Man Jadda Wajada',
                'description' => "Konselor Ruang Tumbuh\nS1 Bimbingan dan Konseling Universitas Ahmad Dahlan (2018-2022)\nS2 Bimbingan dan Konseling Universitas Negeri Malang (2023-2025)",
                'photo_path' => 'image/counselors/alivia-eka.png',
                'is_developer' => false,
            ],
            [
                'order_number' => 11,
                'name' => 'Muh Nur Alamsyah, S.Pd., M.Pd',
                'username' => 'nur.alamsyah',
                'email' => 'muh.nur.2301118@students.um.ac.id',
                'whatsapp_number' => '082293122777',
                'motto' => 'Hidup untuk Beribadah dan Berkarya',
                'description' => "Konselor Ruang Tumbuh\nS1 Bimbingan dan Konseling - Universitas Negeri Makassar (2018-2023)\nS2 Bimbingan dan Konseling - Universitas Negeri Malang (2023-2025)",
                'photo_path' => 'image/team/alamsyah.png',
                'is_developer' => false,
            ],
            [
                'order_number' => 12,
                'name' => 'Herlin Ika Nafilasari, S.Pd., M.Pd',
                'username' => 'herlin.ika',
                'email' => 'herlin.icha15@gmail.com',
                'whatsapp_number' => '081334130175',
                'motto' => 'Bermakna',
                'description' => "Konselor Ruang Tumbuh / Guru BK di SMA Lab UM\nS1 Bimbingan dan Konseling - Universitas Negeri Surabaya (2016-2020)\nS2 Bimbingan dan Konseling - Universitas Negeri Malang (2021-2023)",
                'photo_path' => 'image/counselors/herlin-ika.png',
                'is_developer' => false,
            ],
        ];

        foreach ($counselors as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make('password'),
                    'role' => 'konselor',
                ]
            );

            $user->counselorProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'description' => $data['description'],
                    'motto' => $data['motto'],
                    'photo_path' => $data['photo_path'] ?? null,
                    'whatsapp_number' => $data['whatsapp_number'],
                    'is_developer' => $data['is_developer'],
                    'is_active' => true,
                    'order_number' => $data['order_number'],
                ]
            );
        }
    }
}
