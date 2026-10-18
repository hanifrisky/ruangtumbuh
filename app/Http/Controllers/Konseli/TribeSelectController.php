<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\Tribe;
use Illuminate\Http\Request;

class TribeSelectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tribes = Tribe::withCount('materials')->get();

        // If there is only 1 module/paket, or user already has one selected, go directly to self-help session
        if ($tribes->count() === 1) {
            $defaultTribe = $tribes->first();
            if ($user->selected_tribe_id !== $defaultTribe->id) {
                $user->update(['selected_tribe_id' => $defaultTribe->id]);
            }
            return redirect()->route('konseli.self-help.show', $defaultTribe);
        }

        if ($user->selected_tribe_id && $tribes->contains('id', $user->selected_tribe_id)) {
            return redirect()->route('konseli.self-help.show', $user->selected_tribe_id);
        } elseif ($tribes->isNotEmpty()) {
            $firstTribe = $tribes->first();
            $user->update(['selected_tribe_id' => $firstTribe->id]);
            return redirect()->route('konseli.self-help.show', $firstTribe);
        }

        $selectedTribeId = $user->selected_tribe_id;
        return view('konseli.tribe.index', compact('tribes', 'selectedTribeId'));
    }

    public function select(Request $request, Tribe $tribe)
    {
        auth()->user()->update(['selected_tribe_id' => $tribe->id]);

        return redirect()->route('konseli.self-help.show', $tribe)
            ->with('success', 'Modul Self-Help berhasil dipilih.');
    }
}
