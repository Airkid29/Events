<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(\Illuminate\Http\Request $request, \App\Models\Event $event)
    {
        $user = auth()->user();

        // Check if user already reserved
        if ($event->reservations()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Vous avez déjà réservé cet événement.');
        }

        // Check capacity
        if ($event->reservations()->count() >= $event->capacity) {
            return back()->with('error', 'Désolé, cet événement est complet.');
        }

        $event->reservations()->create([
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Votre réservation a été confirmée !');
    }

}
