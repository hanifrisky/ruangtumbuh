<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\CounselingSession;
use App\Models\User;
use Illuminate\Http\Request;

class CounselorSelectController extends Controller
{
    public function index()
    {
        $counselors = User::where('role', 'konselor')
            ->with('counselorProfile')
            ->get()
            ->sortBy(fn ($u) => $u->counselorProfile->order_number ?? 999)
            ->values();

        $selectedCounselorId = auth()->user()->selected_counselor_id;

        return view('konseli.counselor.index', compact('counselors', 'selectedCounselorId'));
    }

    public function select(Request $request, User $user)
    {
        abort_unless($user->role === 'konselor', 404);

        $konseli = auth()->user();
        $konseli->update(['selected_counselor_id' => $user->id]);

        // Ensure an active counseling session exists between this Konseli and Konselor
        CounselingSession::firstOrCreate(
            [
                'konseli_id' => $konseli->id,
                'konselor_id' => $user->id,
            ],
            [
                'session_number' => 1,
                'status' => 'pending',
            ]
        );

        return redirect()->route('konseli.counseling.index')
            ->with('success', 'Konselor ' . $user->name . ' berhasil dipilih. Silakan gunakan fitur Chat untuk menyepakati jadwal konseling online.');
    }
}
