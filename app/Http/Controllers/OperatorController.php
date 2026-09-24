<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OperatorController extends Controller
{
    /**
     * Tampilkan daftar booking yang dijadwalkan hari ini.
     */
    public function today(Request $request)
    {
        $date = $request->query('date')
            ? Carbon::parse($request->query('date'))
            : now();

        $bookings = Booking::with(['user', 'package'])
            ->whereDate('booking_date', $date)
            ->orderBy('created_at')
            ->get();

        return view('operator.today', [
            'bookings' => $bookings,
            'date' => $date,
        ]);
    }

    /**
     * Tampilkan riwayat check-in.
     */
    public function history(Request $request)
    {
        $query = Booking::with(['user', 'package', 'checkedInBy'])
            ->where('is_checked_in', true);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('checked_in_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('checked_in_at', '<=', $request->to);
        }

        $history = $query
            ->orderByDesc('checked_in_at')
            ->paginate(15)
            ->withQueryString();

        return view('operator.history', [
            'history' => $history,
        ]);
    }

    /**
     * Halaman scan voucher.
     */
    public function scan()
    {
        return view('operator.scan');
    }

    /**
     * Verifikasi kode booking.
     *
     * Scan hanya mengambil data booking.
     * Check-in dilakukan setelah operator menekan tombol konfirmasi.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string',
        ]);

        $booking = Booking::with([
            'user',
            'package.destination',
            'payment',
            'checkedInBy',
        ])
            ->where('booking_code', trim($request->booking_code))
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Kode voucher tidak ditemukan.',
            ], 404);
        }

        if ($booking->is_checked_in) {
            return response()->json([
                'success' => false,
                'already_checked_in' => true,
                'message' => 'Voucher ini sudah pernah digunakan pada '
                    . ($booking->checked_in_at
                        ? $booking->checked_in_at->format('d M Y H:i')
                        : '-')
                    . '.',
                'data' => [
                    'booking_code' => $booking->booking_code,
                    'nama' => $booking->user?->name ?? '-',
                    'paket' => $booking->package?->name ?? '-',
                ],
            ], 422);
        }

        if ($booking->status !== 'Confirmed') {
            return response()->json([
                'success' => false,
                'message' => "Booking berstatus \"{$booking->status}\" — belum bisa check-in.",
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Booking valid. Silakan periksa data sebelum melakukan check-in.',
            'data' => [
                // PEMESAN
                'nama' => $booking->user?->name ?? '-',
                'email' => $booking->user?->email ?? '-',
                'phone' => $booking->phone_number ?? '-',

                // BOOKING
                'booking_code' => $booking->booking_code,
                'booking_date' => $booking->booking_date
                    ? $booking->booking_date->format('d M Y')
                    : '-',
                'jumlah_peserta' => $booking->total_people,
                'catatan' => $booking->notes ?: '-',

                // PAKET
                'paket' => $booking->package?->name ?? '-',
                'kategori' => $booking->package?->category ?? '-',
                'durasi' => $booking->package?->duration_days
                    ? $booking->package->duration_days . ' Hari'
                    : '-',
                'keberangkatan' => $booking->package?->departure_date
                    ? $booking->package->departure_date->format('d M Y')
                    : '-',
                'harga_paket' => $booking->package?->price !== null
                    ? 'Rp ' . number_format(
                        (float) $booking->package->price,
                        0,
                        ',',
                        '.'
                    )
                    : '-',

                // PEMBAYARAN
                'total_harga' => $booking->total_price !== null
                    ? 'Rp ' . number_format(
                        (float) $booking->total_price,
                        0,
                        ',',
                        '.'
                    )
                    : '-',
                'status_pembayaran' => $booking->payment?->status ?? '-',
                'metode_pembayaran' => $booking->payment?->method ?? '-',

                // STATUS
                'status_booking' => $booking->status,
            ],
        ]);
    }

    /**
     * Konfirmasi check-in setelah operator memeriksa data booking.
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string',
        ]);

        $booking = Booking::where(
            'booking_code',
            trim($request->booking_code)
        )->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Kode booking tidak ditemukan.',
            ], 404);
        }

        if ($booking->is_checked_in) {
            return response()->json([
                'success' => false,
                'message' => 'Booking ini sudah pernah check-in.',
            ], 422);
        }

        if ($booking->status !== 'Confirmed') {
            return response()->json([
                'success' => false,
                'message' => "Booking berstatus \"{$booking->status}\" — tidak dapat check-in.",
            ], 422);
        }

        $booking->update([
            'is_checked_in' => true,
            'checked_in_at' => now(),
            'checked_in_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in berhasil! Booking telah berhasil diverifikasi.',
            'data' => [
                'booking_code' => $booking->booking_code,
                'checked_in_at' => $booking->checked_in_at
                    ->format('d M Y H:i'),
            ],
        ]);
    }
}