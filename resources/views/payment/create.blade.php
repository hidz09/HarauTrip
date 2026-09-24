<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran — HarauTrip</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Midtrans Sandbox --}}
    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0e7a3f',
                        'primary-dark': '#0a5c30',
                        'primary-light': '#e6f4ea',
                        accent: '#ea6a12',
                        'accent-light': '#fdece0',
                        ink: '#182420',
                        'ink-soft': '#5c6862',
                        cream: '#faf8f3',
                        line: '#e7e2d4',
                    },
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: #d8dfd9; border-radius: 10px; }
    </style>
</head>

<body class="bg-cream text-ink antialiased">

{{-- CATATAN: halaman ini auth-only (route payment.* dibungkus middleware 'auth') --}}

{{-- ============================= HEADER ============================= --}}
<header class="fixed top-0 inset-x-0 z-50 bg-cream/90 backdrop-blur-md border-b border-line">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between gap-4">

        <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="24" cy="9" r="4.5" fill="#EA6A12"/>
                <path d="M3 27L11.5 12L17 20.5L20.5 15L31 27H3Z" fill="#0E7A3F"/>
                <path d="M11.5 12L14.5 17L11.5 22.5L8.5 17L11.5 12Z" fill="#0A5C30"/>
            </svg>
            <span class="font-display font-extrabold text-xl tracking-tight text-primary">Harau<span class="text-accent">Trip</span></span>
        </a>

        <nav class="hidden lg:flex items-center gap-1 bg-white/70 px-2 py-1.5 rounded-full border border-line">
            <a href="{{ route('home') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Beranda</a>
            <a href="{{ route('home') }}#destinasi-populer" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Destinasi</a>
            <a href="{{ route('landing.packages') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Paket Wisata</a>
            <a href="{{ route('landing.about') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Tentang Kami</a>
            <a href="{{ route('landing.contact') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Kontak</a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-ink-soft hover:text-ink transition">
                <span class="material-symbols-outlined text-[18px]">history</span>
                Riwayat
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-5 py-2.5 rounded-full transition">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Logout
                </button>
            </form>
        </div>

    </div>
</header>

{{-- ============================= CONTENT ============================= --}}
<section class="min-h-screen pt-32 pb-20">
    <div class="max-w-2xl mx-auto px-6 lg:px-10">

        {{-- HEADER --}}
        <div class="flex items-start justify-between gap-4 mb-2">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-wide mb-5">
                    <span class="material-symbols-outlined text-[16px]">payments</span>
                    Langkah 2 dari 2
                </div>
                <h1 class="font-display font-extrabold text-4xl leading-tight tracking-tight text-ink">
                    Pembayaran Booking
                </h1>
            </div>

            <a href="{{ route('dashboard') }}"
               class="hidden sm:inline-flex items-center gap-1.5 bg-white border border-line text-ink text-xs font-semibold uppercase tracking-wide px-4 py-2.5 rounded-full hover:bg-primary-light hover:text-primary hover:border-primary transition shrink-0">
                <span class="material-symbols-outlined text-[16px]">history</span>
                Riwayat Transaksi
            </a>
        </div>

        <p class="text-ink-soft leading-relaxed mb-10">
            Selesaikan pembayaran untuk mengonfirmasi booking-mu.
        </p>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-primary-light border-l-4 border-primary text-ink/80 rounded-r-xl px-5 py-4 mb-8 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- PAYMENT CARD --}}
        <div class="bg-white rounded-3xl border border-line shadow-sm p-8 md:p-10">

            {{-- BOOKING CODE --}}
            <div class="flex items-center gap-3 bg-accent-light border-l-4 border-accent text-ink/80 text-sm rounded-r-xl px-5 py-4 mb-8">
                <span class="material-symbols-outlined text-accent text-[20px]">confirmation_number</span>
                <span>
                    Kode Booking:
                    <strong class="text-ink">{{ $booking->booking_code }}</strong>
                </span>
            </div>

            {{-- DETAIL --}}
            <p class="text-xs font-bold uppercase tracking-widest text-ink-soft mb-3">Detail Paket</p>

            <dl class="divide-y divide-line mb-8">

                <div class="flex items-center justify-between py-3">
                    <dt class="text-sm text-ink-soft">Paket Wisata</dt>
                    <dd class="text-sm font-semibold text-ink text-right">{{ $booking->package->name ?? '-' }}</dd>
                </div>

                <div class="flex items-center justify-between py-3">
                    <dt class="text-sm text-ink-soft">Jumlah Orang</dt>
                    <dd class="text-sm font-semibold text-ink text-right">{{ $booking->total_people }} Orang</dd>
                </div>

                <div class="flex items-center justify-between py-3">
                    <dt class="text-sm text-ink-soft">Tanggal Booking</dt>
                    <dd class="text-sm font-semibold text-ink text-right">{{ $booking->booking_date->format('d-m-Y') }}</dd>
                </div>

                <div class="flex items-center justify-between py-4">
                    <dt class="text-sm text-ink-soft">Total Pembayaran</dt>
                    <dd class="font-display font-extrabold text-2xl text-primary text-right">
                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                    </dd>
                </div>

            </dl>

            {{-- PAYMENT BUTTON --}}
            <button
                type="button"
                id="pay-button"
                class="w-full inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent/90 text-white font-semibold px-6 py-3.5 rounded-full shadow-sm transition">
                <span class="material-symbols-outlined text-[20px]">lock</span>
                Bayar Sekarang
            </button>

            <p class="text-center text-xs text-ink-soft mt-4">
                Pembayaran menggunakan Midtrans Sandbox
            </p>

        </div>

    </div>
</section>

{{-- ============================= FOOTER ============================= --}}
<footer class="bg-ink text-white/70 pt-14 pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 pb-10 border-b border-white/10">

            <div>
                <div class="flex items-center gap-2 mb-4">
                    <svg width="28" height="28" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="9" r="4.5" fill="#EA6A12"/>
                        <path d="M3 27L11.5 12L17 20.5L20.5 15L31 27H3Z" fill="#3FB57C"/>
                        <path d="M11.5 12L14.5 17L11.5 22.5L8.5 17L11.5 12Z" fill="#2E9563"/>
                    </svg>
                    <span class="font-display font-extrabold text-lg text-white">HarauTrip</span>
                </div>
                <p class="text-sm leading-relaxed">
                    Platform reservasi wisata digital untuk menjelajahi pesona Lembah Harau, Sumatera Barat.
                </p>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Jelajahi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('home') }}#destinasi-populer" class="hover:text-white transition">Destinasi</a></li>
                    <li><a href="{{ route('landing.packages') }}" class="hover:text-white transition">Paket Wisata</a></li>
                    <li><a href="{{ route('landing.about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Bantuan</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('landing.contact') }}" class="hover:text-white transition">Hubungi Kami</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Riwayat Pemesanan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Kontak</h4>
                <ul class="space-y-2.5 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[16px] mt-0.5">location_on</span>
                        Lembah Harau, Kab. Lima Puluh Kota, Sumatera Barat
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        halo@harautrip.id
                    </li>
                </ul>
            </div>

        </div>

        <div class="pt-6 flex flex-wrap items-center justify-between gap-3 text-xs">
            <p>&copy; {{ date('Y') }} HarauTrip. Seluruh hak cipta dilindungi.</p>
            <p>Lembah yang belum banyak orang tahu.</p>
        </div>
    </div>
</footer>

{{-- ============================= MIDTRANS SCRIPT ============================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {

        // Token dari PaymentController
        const snapToken = @json($snapToken);

        if (!snapToken) {
            alert('Token pembayaran tidak tersedia. Silakan coba lagi.');
            return;
        }

        // Nonaktifkan tombol sementara
        payButton.disabled = true;
        payButton.innerText = 'Memuat Pembayaran...';

        snap.pay(snapToken, {

            // Pembayaran berhasil
            onSuccess: function (result) {
                window.location.href =
                    "{{ route('payment.status', ['booking' => $booking->id]) }}";
            },

            // Pembayaran masih pending
            onPending: function (result) {
                window.location.href =
                    "{{ route('payment.status', ['booking' => $booking->id]) }}";
            },

            // Pembayaran gagal
            onError: function (result) {
                alert('Pembayaran gagal, silakan coba lagi.');

                payButton.disabled = false;
                payButton.innerText = 'Bayar Sekarang';
            },

            // User menutup popup
            onClose: function () {
                payButton.disabled = false;
                payButton.innerText = 'Bayar Sekarang';
            }

        });

    });

});
</script>

</body>
</html>