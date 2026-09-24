<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{

    public function index()
    {

        $bookings = Booking::with('package')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();


        return view(
            'dashboard.user.index',
            compact('bookings')
        );

    }

}