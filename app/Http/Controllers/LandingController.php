<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $spotlightDestinations = Destination::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $featuredPackages = TourPackage::with('destination')
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        return view('landing.index', compact('spotlightDestinations', 'featuredPackages'));
    }

public function destinations()
{
    $destinations = Destination::where('status', 'active')
        ->latest()
        ->get();

    return view('landing.destinations', compact('destinations'));
}

public function sendContact(Request $request)
{
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string|max:2000',
    ]);

    // Kirim email ke tim Harau Trip.
    // Pastikan konfigurasi MAIL_* di file .env sudah diisi (SMTP/Mailtrap/dll),
    // atau sesuaikan alamat tujuan di bawah ini.
    try {
        \Illuminate\Support\Facades\Mail::raw(
            "Dari: {$validated['name']} ({$validated['email']})\n\n{$validated['message']}",
            function ($mail) use ($validated) {
                $mail->to('info@harautrip.com')
                    ->subject('Pesan Baru dari Formulir Kontak — ' . $validated['name']);
            }
        );
    } catch (\Exception $e) {
        // Kalau MAIL_* belum dikonfigurasi, pesan tetap tersimpan sebagai log
        // supaya tidak error ke user, tapi kamu tetap perlu setting email asli nanti.
        \Illuminate\Support\Facades\Log::info('Pesan kontak (mail gagal terkirim): ', $validated);
    }

    return redirect()
        ->route('landing.contact')
        ->with('success', 'Pesan kamu berhasil dikirim! Kami akan segera menghubungi balik.');
}

   public function about()
{
    $aboutDestinations = Destination::where('status', 'active')
        ->whereNotNull('image')
        ->inRandomOrder()
        ->take(2)
        ->get();

    return view('landing.about', compact('aboutDestinations'));
}

    public function packages()
    {
        $packages = TourPackage::with('destination')
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('landing.packages', compact('packages'));
    }

    public function contact()
    {
        return view('landing.contact');
    }
}