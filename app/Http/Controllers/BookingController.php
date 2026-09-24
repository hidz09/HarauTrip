<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'package'])
            ->latest()
            ->get();

        $packages = TourPackage::where('status', 'active')->get();

        return view('booking.index', compact('bookings', 'packages'));
    }

    /**
     * Form checkout untuk USER (halaman standalone, dari landing page).
     */
    public function create(Request $request)
    {
        $packages = TourPackage::where('status', 'active')->get();

        $selectedPackageId = $request->query('package');

        return view('booking.create', compact('packages', 'selectedPackageId'));
    }

    /**
     * Generate kode booking yang unik. Menggabungkan timestamp
     * dengan string acak, dan mengecek ulang ke database supaya
     * tidak pernah bentrok meskipun dibuat di detik yang sama.
     */
    protected function generateUniqueBookingCode(): string
    {
        do {
            $code = 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }

    /**
     * Simpan booking dari checkout USER, lanjut ke halaman pembayaran.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'booking_date'    => 'required|date|after_or_equal:today',
            'total_people'    => 'required|integer|min:1',
            'phone_number'    => 'required|string|min:9|max:15',
            'notes'           => 'nullable|string|max:500',
            'agreement'       => 'required',
        ]);

        $package = TourPackage::findOrFail($request->tour_package_id);

        $booking = Booking::create([
            'user_id'          => Auth::id(),
            'phone_number'     => $request->phone_number,
            'tour_package_id'  => $package->id,
            'booking_code'     => $this->generateUniqueBookingCode(),
            'booking_date'     => $request->booking_date,
            'total_people'     => $request->total_people,
            'total_price'      => $package->price * $request->total_people,
            'notes'            => $request->notes,
            'status'           => 'Pending',
        ]);

        return redirect()
            ->route('payment.create', $booking->id)
            ->with('success', 'Booking berhasil dibuat, silahkan lanjutkan pembayaran.');
    }

    /**
     * Form tambah booking oleh ADMIN (pakai layout admin).
     */
    public function createAdmin()
    {
        $packages = TourPackage::where('status', 'active')->get();

        return view('booking.create_admin', compact('packages'));
    }

    /**
     * Simpan booking yang dibuat ADMIN, balik ke daftar booking.
     */
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'booking_date'    => 'required|date',
            'total_people'    => 'required|integer|min:1',
        ]);

        $package = TourPackage::findOrFail($request->tour_package_id);

        Booking::create([
            'user_id'          => Auth::id(),
            'tour_package_id'  => $package->id,
            'booking_code'     => $this->generateUniqueBookingCode(),
            'booking_date'     => $request->booking_date,
            'total_people'     => $request->total_people,
            'total_price'      => $package->price * $request->total_people,
            'status'           => 'Pending',
        ]);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $packages = TourPackage::where('status', 'active')->get();

        return view('booking.edit', compact('booking', 'packages'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'booking_date'    => 'required|date',
            'total_people'    => 'required|integer|min:1',
            'status'          => 'required',
        ]);

        $package = TourPackage::findOrFail($request->tour_package_id);

        $booking->update([
            'tour_package_id' => $package->id,
            'booking_date'    => $request->booking_date,
            'total_people'    => $request->total_people,
            'total_price'     => $package->price * $request->total_people,
            'status'          => $request->status,
        ]);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}