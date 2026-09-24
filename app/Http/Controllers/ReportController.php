<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\TourPackage;
use App\Models\Destination;

class ReportController extends Controller
{
    public function index()
    {

        // Statistik
        $totalDestination = Destination::count();

        $totalPackage = TourPackage::count();

        $totalBooking = Booking::count();

        $totalPayment = Payment::count();


        // Total pendapatan dari payment lunas
        $totalIncome = Payment::where('status', 'Lunas')
            ->sum('amount');


        // Data laporan booking
        $bookings = Booking::with([
                'user',
                'package',
                'payment'
            ])
            ->latest()
            ->get();



        return view('report.index', compact(

            'totalDestination',

            'totalPackage',

            'totalBooking',

            'totalPayment',

            'totalIncome',

            'bookings'

        ));

    }
}