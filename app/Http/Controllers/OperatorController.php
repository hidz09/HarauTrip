<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Tampilkan daftar booking yang dijadwalkan hari ini.
     */
    public function today(Request $request)
    {
        $date = $request->query('date')
            ? \Carbon\Carbon::parse($request->query('date'))
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
     * Tampilkan riwayat check-in (booking yang sudah pernah discan).
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

        $history = $query->orderByDesc('checked_in_at')->paginate(15)->withQueryString();

        return view('operator.history', [
            'history' => $history,
        ]);
    }

    /**
     * Tampilkan halaman scan voucher.
     */
    public function scan()
    {
        return view('operator.scan');
    }

    /**
     * Verifikasi kode voucher hasil scan / input manual,
     * lalu tandai booking sebagai checked-in.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string',
        ]);

        \Illuminate\Support\Facades\Log::info('OperatorController@verify dipanggil', [
            'booking_code_diterima' => $request->booking_code,
            'operator' => auth()->user()->name ?? 'unknown',
        ]);

        $booking = Booking::with(['user', 'package'])
            ->where('booking_code', trim($request->booking_code))
            ->first();

        if (!$booking) {
            \Illuminate\Support\Facades\Log::warning('Booking tidak ditemukan', [
                'booking_code_dicari' => trim($request->booking_code),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Kode voucher tidak ditemukan.',
            ], 404);
        }

        if ($booking->status !== 'Confirmed') {
            return response()->json([
                'success' => false,
                'message' => "Booking berstatus \"{$booking->status}\" — belum bisa check-in.",
            ], 422);
        }

        if ($booking->is_checked_in) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher ini sudah pernah digunakan pada '
                    . $booking->checked_in_at->format('d M Y H:i') . '.',
            ], 422);
        }

        $booking->update([
            'is_checked_in' => true,
            'checked_in_at' => now(),
            'checked_in_by' => auth()->id(),
        ]);

        \Illuminate\Support\Facades\Log::info('Check-in berhasil disimpan', [
            'booking_id' => $booking->id,
            'booking_code' => $booking->booking_code,
            'is_checked_in_setelah_update' => $booking->fresh()->is_checked_in,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in berhasil!',
            'data' => [
                'booking_code'   => $booking->booking_code,
                'nama'           => $booking->user->name,
                'no_hp'          => $booking->phone_number,
                'paket'          => $booking->package->name,
                'tanggal'        => $booking->booking_date->format('d M Y'),
                'jumlah_peserta' => $booking->total_people,
            ],
        ]);
    }
}