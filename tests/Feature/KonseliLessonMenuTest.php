<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KonseliLessonMenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_materi_appears_when_at_least_one_lesson_exists(): void
    {
        $konselor = User::factory()->create([
            'role' => 'konselor',
        ]);

        $konseli = User::factory()->create([
            'role' => 'konseli',
        ]);

        // Buat 1 materi pembelajaran oleh konselor
        $lesson = Lesson::create([
            'title' => 'Materi Ketangguhan Resiliensi Remaja',
            'tag' => 'Edukasi',
            'created_by' => $konselor->id,
        ]);

        $response = $this->actingAs($konseli)->get(route('konseli.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Materi Pembelajaran');
        $response->assertSee(route('konseli.lessons.index'));

        // Pastikan halaman index materi dapat diakses
        $lessonResponse = $this->actingAs($konseli)->get(route('konseli.lessons.index'));
        $lessonResponse->assertStatus(200);
        $lessonResponse->assertSee($lesson->title);
    }

    public function test_menu_materi_is_hidden_when_no_lesson_exists(): void
    {
        $konseli = User::factory()->create([
            'role' => 'konseli',
        ]);

        // Pastikan tidak ada lesson
        $this->assertEquals(0, Lesson::count());

        $response = $this->actingAs($konseli)->get(route('konseli.dashboard'));

        $response->assertStatus(200);
        $response->assertDontSee('Materi Pembelajaran');
        $response->assertDontSee(route('konseli.lessons.index'));

        // Jika konseli mencoba akses langsung route lessons saat tidak ada materi, diredirect ke dashboard
        $lessonResponse = $this->actingAs($konseli)->get(route('konseli.lessons.index'));
        $lessonResponse->assertRedirect(route('konseli.dashboard'));
        $lessonResponse->assertSessionHas('error');
    }
}
