<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\CounselingSession;
use App\Models\User;
use App\Models\WellbeingAnswer;
use Illuminate\Http\Request;

class CounselingSessionController extends Controller
{
    protected function getOrCreateSession(User $konseli): CounselingSession
    {
        abort_unless($konseli->selected_counselor_id == auth()->id(), 403);

        return CounselingSession::firstOrCreate(
            [
                'konseli_id' => $konseli->id,
                'konselor_id' => auth()->id(),
            ],
            [
                'session_number' => 1,
                'status' => 'pending',
            ]
        );
    }

    public function show(User $user)
    {
        $session = $this->getOrCreateSession($user);
        $session->load(['messages.sender', 'reflections']);

        // Mark unread messages from konseli as read
        ChatMessage::where('counseling_session_id', $session->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $preTest = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->with(['interpretation'])
            ->first();

        $postTest = WellbeingAnswer::where('konseli_id', $user->id)
            ->where('type', 'post_test')
            ->where('status', 'completed')
            ->with(['interpretation'])
            ->first();

        return view('konselor.konseli.session', compact('user', 'session', 'preTest', 'postTest'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $session = $this->getOrCreateSession($user);

        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ChatMessage::create([
            'counseling_session_id' => $session->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => trim($request->message),
        ]);

        return redirect()->route('konselor.konseli.session', $user)
            ->with('success', 'Pesan balasan berhasil dikirim ke konseli.');
    }

    public function updateSchedule(Request $request, User $user)
    {
        $session = $this->getOrCreateSession($user);

        $request->validate([
            'session_number' => ['required', 'integer', 'min:1', 'max:20'],
            'scheduled_at' => ['required', 'date'],
            'platform' => ['required', 'string', 'in:Google Meet,Zoom'],
            'meeting_url' => ['required', 'url', 'max:500'],
            'status' => ['required', 'in:pending,scheduled,completed,cancelled'],
        ]);

        $session->update([
            'session_number' => $request->session_number,
            'scheduled_at' => $request->scheduled_at,
            'platform' => $request->platform,
            'meeting_url' => $request->meeting_url,
            'status' => $request->status,
        ]);

        return redirect()->route('konselor.konseli.session', $user)
            ->with('success', 'Jadwal sesi konseling dan tautan ' . $request->platform . ' berhasil disimpan dan ditampilkan di halaman konseli.');
    }

    public function updateEvaluation(Request $request, User $user)
    {
        $session = $this->getOrCreateSession($user);

        $request->validate([
            'counselor_evaluation_notes' => ['nullable', 'string', 'max:5000'],
            'status' => ['nullable', 'in:pending,scheduled,completed,cancelled'],
        ]);

        $data = [
            'counselor_evaluation_notes' => $request->counselor_evaluation_notes,
        ];
        if ($request->filled('status')) {
            $data['status'] = $request->status;
        }

        $session->update($data);

        return redirect()->back()
            ->with('success', 'Catatan evaluasi dan tindak lanjut konseli berhasil disimpan.');
    }
}
