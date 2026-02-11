<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $myEvents = $user->events()->latest()->get();
        $myReservations = $user->reservations()->with('event')->latest()->get();

        return view('dashboard', compact('myEvents', 'myReservations'));
    }
}
