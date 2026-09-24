<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard untuk user yang sudah login
    public function index()
    {
        $bookings = Booking::with(['package', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.user.index', compact('bookings'));
    }
}