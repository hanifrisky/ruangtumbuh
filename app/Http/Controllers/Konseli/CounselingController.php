<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\CounselingSession;
use App\Models\SessionReflection;
use App\Models\WellbeingAnswer;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
    protected function getActiveSession($konseli): ?CounselingSession
    {
        if (! $konseli->selected_counselor_id) {
            return null;
        }

        return CounselingSession::firstOrCreate(
            [
                'konseli_id' => $konseli->id,
                'konselor_id' => $konseli->selected_counselor_id,
            ],
            [
                'session_number' => 1,
                'status' => 'pending',
            ]
        );
    }

    public function index()
    {
        $konseli = auth()->user();

        if (! $konseli->selected_counselor_id) {
            return redirect()->route('konseli.counselor.index')
                ->with('error', 'Silakan pilih konselor terlebih dahulu untuk membuka ruang Chat dan Jadwal Konseling Online.');
        }

        $session = $this->getActiveSession($konseli);
        $session->load(['konselor.counselorProfile', 'messages.sender', 'reflections']);

        // Mark unread messages from konselor as read
        ChatMessage::where('counseling_session_id', $session->id)
            ->where('receiver_id', $konseli->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $preTest = WellbeingAnswer::where('konseli_id', $konseli->id)->where('type', 'pre_test')->first();
        $postTest = WellbeingAnswer::where('konseli_id', $konseli->id)->where('type', 'post_test')->first();

        return view('konseli.counseling.index', compact('session', 'preTest', 'postTest'));
    }

    public function sendMessage(Request $request)
    {
        $konseli = auth()->user();
        $session = $this->getActiveSession($konseli);
        abort_unless($session !== null, 403);

        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ChatMessage::create([
            'counseling_session_id' => $session->id,
            'sender_id' => $konseli->id,
            'receiver_id' => $session->konselor_id,
            'message' => trim($request->message),
        ]);

        return redirect()->route('konseli.counseling.index', ['#chat-box'])
            ->with('success', 'Pesan berhasil dikirim ke konselor.');
    }

    public function reflection()
    {
        $konseli = auth()->user();

        if (! $konseli->selected_counselor_id) {
            return redirect()->route('konseli.counselor.index')
                ->with('error', 'Silakan pilih konselor terlebih dahulu.');
        }

        $session = $this->getActiveSession($konseli);
        $session->load(['konselor.counselorProfile', 'reflections']);

        return view('konseli.reflection.index', compact('session'));
    }

    public function storeReflection(Request $request)
    {
        $konseli = auth()->user();
        $session = $this->getActiveSession($konseli);
        abort_unless($session !== null, 403);

        $request->validate([
            'answer_1' => ['required', 'string', 'min:5'],
            'answer_2' => ['required', 'string', 'min:5'],
            'answer_3' => ['required', 'string', 'min:5'],
        ]);

        SessionReflection::create([
            'counseling_session_id' => $session->id,
            'konseli_id' => $konseli->id,
            'answer_1' => $request->answer_1,
            'answer_2' => $request->answer_2,
            'answer_3' => $request->answer_3,
            'submitted_at' => now(),
        ]);

        return redirect()->route('konseli.reflection.index')
            ->with('success', 'Instrumen Refleksi Pasca-Sesi berhasil disimpan. Terima kasih atas refleksi Anda!');
    }

    public function evaluation()
    {
        $konseli = auth()->user();
        $session = $this->getActiveSession($konseli);
        if ($session) {
            $session->load(['konselor.counselorProfile', 'reflections']);
        }

        $preTest = WellbeingAnswer::where('konseli_id', $konseli->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->with(['details.question', 'details.selectedOption', 'interpretation'])
            ->first();

        $postTest = WellbeingAnswer::where('konseli_id', $konseli->id)
            ->where('type', 'post_test')
            ->where('status', 'completed')
            ->with(['details.question', 'details.selectedOption', 'interpretation'])
            ->first();

        return view('konseli.evaluation.index', compact('session', 'preTest', 'postTest'));
    }
}
