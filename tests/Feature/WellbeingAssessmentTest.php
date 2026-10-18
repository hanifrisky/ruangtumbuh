<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use App\Models\WellbeingAnswer;
use App\Models\WellbeingAnswerDetail;
use Database\Seeders\WellbeingQuestionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WellbeingAssessmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(WellbeingQuestionSeeder::class);
    }

    public function test_seeder_populates_exact_37_questions_and_interpretations(): void
    {
        $this->assertEquals(37, Question::count());
        $this->assertEquals(25, Question::where('category', 'well_being')->count());
        $this->assertEquals(12, Question::where('category', 'suicide_ideation')->count());

        // Cek 6 dimensi Well-Being
        $dimensions = [
            'Penerimaan Diri' => 4,
            'Relasi Positif' => 4,
            'Otonomi' => 4,
            'Penguasaan Lingkungan' => 4,
            'Tujuan Hidup' => 4,
            'Pertumbuhan Pribadi' => 5,
        ];

        foreach ($dimensions as $dim => $count) {
            $this->assertEquals($count, Question::where('dimension', $dim)->count(), "Dimensi {$dim} harus berjumlah {$count}");
        }

        // Cek 4 aspek Ide Bunuh Diri
        $aspects = [
            'Frekuensi dan Intensitas' => 3,
            'Keputusasaan' => 3,
            'Perasaan Menjadi Beban dan Keterasingan' => 3,
            'Kendali, Gangguan, dan Distres' => 3,
        ];

        foreach ($aspects as $asp => $count) {
            $this->assertEquals($count, Question::where('dimension', $asp)->count(), "Aspek {$asp} harus berjumlah {$count}");
        }
    }

    public function test_konseli_can_complete_assessment_and_view_results(): void
    {
        $konseli = User::factory()->create([
            'role' => 'konseli',
            'school_origin' => 'SMA Negeri 1 Malang',
            'grade_class' => 'XI MIPA 2',
            'gender' => 'Perempuan',
        ]);

        $answer = WellbeingAnswer::create([
            'konseli_id' => $konseli->id,
            'type' => 'pre_test',
            'konseli_name' => $konseli->name,
            'status' => 'draft',
            'started_at' => now(),
        ]);

        $questions = Question::with('optionGroup.items')->get();

        foreach ($questions as $q) {
            $firstOption = $q->optionGroup->items->first();
            WellbeingAnswerDetail::create([
                'wellbeing_answer_id' => $answer->id,
                'question_id' => $q->id,
                'selected_option_id' => $firstOption->id,
                'score' => $firstOption->score,
            ]);
        }

        $response = $this->actingAs($konseli)
            ->post(route('konseli.wellbeing.finish', 'pre_test'));

        $response->assertRedirect(route('konseli.wellbeing.result', 'pre_test'));

        $answer->refresh();
        $this->assertEquals('completed', $answer->status);
        $this->assertNotNull($answer->well_being_score);
        $this->assertNotNull($answer->suicide_ideation_score);

        // Verifikasi attributes
        $this->assertNotEmpty($answer->well_being_category);
        $this->assertNotEmpty($answer->suicide_category);
        $this->assertIsArray($answer->dimensions_breakdown);
        $this->assertCount(6, $answer->dimensions_breakdown);
        $this->assertIsArray($answer->suicide_aspects_breakdown);
        $this->assertCount(4, $answer->suicide_aspects_breakdown);

        // Verifikasi tampilan result
        $resultResponse = $this->actingAs($konseli)
            ->get(route('konseli.wellbeing.result', 'pre_test'));
        $resultResponse->assertStatus(200);
        $resultResponse->assertSee('Laporan Hasil Pemetaan Psikologis');
    }

    public function test_konseli_can_download_pdf_report(): void
    {
        $konseli = User::factory()->create([
            'role' => 'konseli',
            'school_origin' => 'SMA Negeri 1 Malang',
            'grade_class' => 'XI MIPA 2',
        ]);

        $answer = WellbeingAnswer::create([
            'konseli_id' => $konseli->id,
            'type' => 'pre_test',
            'konseli_name' => $konseli->name,
            'status' => 'completed',
            'total_score' => 95,
            'well_being_score' => 95,
            'suicide_ideation_score' => 15,
            'started_at' => now()->subHour(),
            'completed_at' => now(),
        ]);

        $questions = Question::with('optionGroup.items')->get();
        foreach ($questions as $q) {
            $firstOption = $q->optionGroup->items->first();
            WellbeingAnswerDetail::create([
                'wellbeing_answer_id' => $answer->id,
                'question_id' => $q->id,
                'selected_option_id' => $firstOption->id,
                'score' => $firstOption->score,
            ]);
        }

        $response = $this->actingAs($konseli)
            ->get(route('konseli.wellbeing.pdf', 'pre_test'));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
    }
}
