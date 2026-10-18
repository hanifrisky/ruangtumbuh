<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\CounselingSession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = \App\Models\User::where('selected_counselor_id', $user->id)
            ->with(['wellbeingAnswers', 'selectedTribe']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('school_origin', 'like', '%' . $search . '%');
            });
        }

        $limit = ($perPage === 'all') ? 999999 : (int) $perPage;

        $konseliList = $query->paginate($limit)
            ->appends($request->all())
            ->through(function ($konseli) use ($user) {
                $konseli->pre_test = $konseli->wellbeingAnswers->where('type', 'pre_test')->first();
                $konseli->post_test = $konseli->wellbeingAnswers->where('type', 'post_test')->first();
                $konseli->self_help_count = \App\Models\SelfHelpAnswer::where('konseli_id', $konseli->id)->count();

                $session = CounselingSession::where('konseli_id', $konseli->id)
                    ->where('konselor_id', $user->id)
                    ->withCount('reflections')
                    ->first();

                $konseli->active_session = $session;
                $konseli->unread_messages_count = $session
                    ? ChatMessage::where('counseling_session_id', $session->id)
                        ->where('receiver_id', $user->id)
                        ->whereNull('read_at')
                        ->count()
                    : 0;

                return $konseli;
            });

        return view('konselor.dashboard', compact('konseliList'));
    }
}
