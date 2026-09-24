<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Midtrans\Transaction;
class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $payments = Payment::with('booking')->latest()->get();

        return view('payment.index', compact('payments'));
    }

    public function create(Booking $booking)
    {
        // Cari payment yang sudah ada
        $payment = $booking->payment;

        // Kalau belum ada, buat payment baru
        if (!$payment) {
            $payment = Payment::create([
                'booking_id'   => $booking->id,
                'payment_code' => 'PAY-' . time(),
                'amount'       => $booking->total_price,
                'method'       => 'MIDTRANS',
                'status'       => 'Pending',
            ]);
        }

        // Buat order ID Midtrans
        if (empty($payment->order_id)) {
            $payment->order_id = 'ORDER-' . $payment->id . '-' . time();
            $payment->save();
        }

        // Data transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => $payment->order_id,
                'gross_amount' => (int) $payment->amount,
            ],

            'customer_details' => [
                'first_name' => $booking->user->name ?? 'Guest',
                'email'      => $booking->user->email ?? 'guest@example.com',
                'phone'      => $booking->phone_number ?? '',
            ],

            'item_details' => [
                [
                    'id'       => (string) ($booking->package->id ?? 'PKG'),
                    'price'    => (int) $payment->amount,
                    'quantity' => 1,
                    'name'     => $booking->package->name ?? 'Paket Wisata',
                ]
            ],

            'callbacks' => [
    'finish' => route('payment.status', [
        'booking' => $booking->id
                ]),
            ],
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Simpan token
        $payment->snap_token = $snapToken;
        $payment->save();

        return view('payment.create', compact(
            'booking',
            'payment',
            'snapToken'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount'     => 'required|numeric|min:0',
            'method'     => 'required|string',
            'proof'      => 'required|image|max:2048',
        ]);

        $proofPath = $request->file('proof')
            ->store('payment', 'public');

        Payment::create([
            'booking_id'   => $validated['booking_id'],
            'payment_code' => 'PAY-' . time(),
            'amount'       => $validated['amount'],
            'method'       => $validated['method'],
            'proof'        => $proofPath,
            'status'       => 'Pending',
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Pembayaran berhasil dikirim, menunggu verifikasi admin.'
            );
    }

    public function callback(Request $request)
    {
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Cari payment berdasarkan order ID
        $payment = Payment::where('order_id', $orderId)->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found'
            ], 404);
        }

        // Pembayaran berhasil
        if (
            $transactionStatus === 'settlement' ||
            (
                $transactionStatus === 'capture' &&
                $fraudStatus === 'accept'
            )
        ) {
            $payment->status = 'Lunas';
        }

        // Menunggu pembayaran
        elseif ($transactionStatus === 'pending') {
            $payment->status = 'Pending';
        }

        // Pembayaran gagal / dibatalkan / kadaluarsa
        elseif (in_array($transactionStatus, [
            'deny',
            'cancel',
            'expire'
        ])) {
            $payment->status = 'Ditolak';
        }

        $payment->save();

        // Sinkronkan status booking
        $booking = $payment->booking;

        if ($booking) {

            if ($payment->status === 'Lunas') {
                $booking->update([
                    'status' => 'Confirmed'
                ]);
            }

            elseif ($payment->status === 'Ditolak') {
                $booking->update([
                    'status' => 'Cancelled'
                ]);
            }

            elseif ($payment->status === 'Pending') {
                $booking->update([
                    'status' => 'Pending'
                ]);
            }
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Status Pembayaran
    |--------------------------------------------------------------------------
    */

    public function status(Booking $booking)
{
    $booking->load([
        'user',
        'package',
        'payment'
    ]);

    $payment = $booking->payment;

    // Cek langsung status transaksi ke Midtrans
    if ($payment && $payment->order_id) {

        try {
            $transaction = Transaction::status($payment->order_id);

            $transactionStatus = $transaction->transaction_status ?? null;
            $fraudStatus = $transaction->fraud_status ?? null;

            if (
                $transactionStatus === 'settlement' ||
                (
                    $transactionStatus === 'capture' &&
                    $fraudStatus === 'accept'
                )
            ) {
                $payment->status = 'Lunas';
                $booking->status = 'Confirmed';
            }

            elseif ($transactionStatus === 'pending') {
                $payment->status = 'Pending';
                $booking->status = 'Pending';
            }

            elseif (in_array($transactionStatus, [
                'deny',
                'cancel',
                'expire'
            ])) {
                $payment->status = 'Ditolak';
                $booking->status = 'Cancelled';
            }

            $payment->save();
            $booking->save();

        } catch (\Exception $e) {
            // Kalau Midtrans belum bisa dicek,
            // tetap tampilkan status yang tersimpan di database.
        }
    }

    return view(
        'payment.status',
        compact('booking')
    );
}
    /*
    |--------------------------------------------------------------------------
    | Selesai Pembayaran
    |--------------------------------------------------------------------------
    */

    
    public function show(Payment $payment)
    {
        $payment->load(
            'booking.user',
            'booking.package'
        );

        return view(
            'payment.show',
            compact('payment')
        );
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $payment->update([
            'status' => $validated['status'],
        ]);

        // Sinkronkan status booking
        if ($payment->booking) {

            if ($validated['status'] === 'Lunas') {
                $payment->booking->update([
                    'status' => 'Confirmed'
                ]);
            }

            elseif ($validated['status'] === 'Ditolak') {
                $payment->booking->update([
                    'status' => 'Cancelled'
                ]);
            }

            elseif ($validated['status'] === 'Pending') {
                $payment->booking->update([
                    'status' => 'Pending'
                ]);
            }
        }

        return redirect()
            ->route('admin.payment.index')
            ->with(
                'success',
                'Status pembayaran diperbarui'
            );
    }
}