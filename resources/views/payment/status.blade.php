<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Pembayaran — Harau Trip</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-3xl mx-auto px-5 py-12">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">
                Status Pembayaran
            </h1>

            <p class="text-gray-500 mt-2">
                Berikut informasi pembayaran booking kamu
            </p>
        </div>


        {{-- STATUS --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            @if($booking->payment && $booking->payment->status === 'Lunas')

                {{-- BERHASIL --}}
                <div class="text-center px-6 py-8 border-b">

                    <div class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-5">
                        <svg class="w-10 h-10 text-green-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-green-600">
                        Pembayaran Berhasil
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Pembayaran kamu sudah berhasil diproses.
                    </p>

                </div>

                {{-- ============ QR VOUCHER ============ --}}
                <div class="px-6 py-8 border-b bg-gradient-to-b from-green-50/60 to-white">

                    <div class="max-w-xs mx-auto text-center">

                        <p class="text-sm font-semibold text-gray-700 mb-1">
                            Voucher Check-in
                        </p>
                        <p class="text-xs text-gray-500 mb-5">
                            Tunjukkan QR ini ke petugas di lokasi untuk check-in
                        </p>

                        <div class="bg-white border-2 border-green-200 rounded-2xl p-4 inline-block shadow-sm">
                            <img
                                src="https://api.qrserver.com/v1/create-qr-code/?size=240x240&margin=8&data={{ urlencode($booking->booking_code) }}"
                                alt="QR Voucher {{ $booking->booking_code }}"
                                width="240"
                                height="240"
                                class="mx-auto"
                            >
                        </div>

                        <p class="font-mono font-bold text-gray-900 text-lg mt-4 tracking-wider">
                            {{ $booking->booking_code }}
                        </p>

                        @if($booking->is_checked_in)
                            <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold text-xs">
                                <span>✓</span>
                                Sudah check-in pada {{ $booking->checked_in_at->format('d M Y, H:i') }}
                            </div>
                        @else
                            <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 font-semibold text-xs">
                                Belum check-in — simpan QR ini
                            </div>
                        @endif

                        <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&margin=10&data={{ urlencode($booking->booking_code) }}"
                           download="voucher-{{ $booking->booking_code }}.png"
                           class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-green-700 hover:text-green-800 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                            </svg>
                            Unduh QR Voucher
                        </a>

                    </div>

                </div>

            @elseif($booking->payment && $booking->payment->status === 'Pending')

                {{-- PENDING --}}
                <div class="text-center px-6 py-8 border-b">

                    <div class="w-20 h-20 mx-auto rounded-full bg-yellow-100 flex items-center justify-center mb-5">
                        <svg class="w-10 h-10 text-yellow-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-yellow-600">
                        Pembayaran Sedang Diproses
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Pembayaran kamu masih menunggu konfirmasi. QR voucher akan muncul di sini
                        setelah pembayaran berhasil dikonfirmasi.
                    </p>

                </div>

            @else

                {{-- GAGAL --}}
                <div class="text-center px-6 py-8 border-b">

                    <div class="w-20 h-20 mx-auto rounded-full bg-red-100 flex items-center justify-center mb-5">
                        <svg class="w-10 h-10 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-red-600">
                        Pembayaran Gagal
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Pembayaran belum berhasil dilakukan.
                    </p>

                </div>

            @endif


            {{-- DETAIL BOOKING --}}
            <div class="p-6">

                <h3 class="font-bold text-gray-900 text-lg mb-5">
                    Detail Transaksi
                </h3>

                <div class="space-y-4">

                    {{-- KODE BOOKING --}}
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-gray-500">
                            Kode Booking
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $booking->booking_code }}
                        </span>
                    </div>


                    {{-- PAKET --}}
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-gray-500">
                            Paket Wisata
                        </span>

                        <span class="font-semibold text-gray-900 text-right">
                            {{ $booking->package->name ?? '-' }}
                        </span>
                    </div>


                    {{-- JUMLAH ORANG --}}
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-gray-500">
                            Jumlah Orang
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $booking->total_people }} Orang
                        </span>
                    </div>


                    {{-- TANGGAL --}}
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-gray-500">
                            Tanggal Booking
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                        </span>
                    </div>


                    {{-- METODE --}}
                    @if($booking->payment)
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-gray-500">
                                Metode Pembayaran
                            </span>

                            <span class="font-semibold text-gray-900">
                                {{ $booking->payment->method ?? 'MIDTRANS' }}
                            </span>
                        </div>
                    @endif


                    {{-- TOTAL --}}
                    <div class="border-t pt-4 mt-4 flex items-center justify-between gap-4">

                        <span class="font-semibold text-gray-700">
                            Total Pembayaran
                        </span>

                        <span class="text-xl font-bold text-blue-600">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>

                    </div>

                </div>


                {{-- STATUS BADGE --}}
                <div class="mt-6">

                    <p class="text-sm text-gray-500 mb-2">
                        Status Pembayaran
                    </p>

                    @if($booking->payment && $booking->payment->status === 'Lunas')

                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                            ✓ Lunas
                        </span>

                    @elseif($booking->payment && $booking->payment->status === 'Pending')

                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm">
                            ⏳ Pending
                        </span>

                    @else

                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold text-sm">
                            ✕ Ditolak
                        </span>

                    @endif

                </div>


                {{-- BUTTON --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-3">

                    <a href="{{ route('dashboard') }}"
                       class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-5 rounded-xl transition">
                        Lihat Riwayat Transaksi
                    </a>

                    <a href="{{ url('/') }}"
                       class="flex-1 text-center border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold py-3 px-5 rounded-xl transition">
                        Kembali ke Beranda
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>
</html>