<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Transaksi — HarauTrip</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
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

{{-- CATATAN: halaman ini auth-only (route dashboard dibungkus middleware 'auth') --}}

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
            <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold bg-primary-light text-primary px-4 py-2 rounded-full">
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

<main class="pt-20">

    {{-- ============================= PAGE HEADER ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-12 lg:py-16">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-wide mb-5">
            <span class="material-symbols-outlined text-[16px]">history</span>
            Riwayat Transaksi
        </div>
        <h1 class="font-display font-extrabold text-4xl lg:text-5xl leading-tight tracking-tight text-ink">
            Halo, {{ Auth::user()->name }}
        </h1>
    </section>

    {{-- ============================= BOOKING LIST ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-20">

        @if(session('success'))
            <div class="bg-primary-light border-l-4 border-primary text-ink/80 rounded-r-xl px-5 py-4 mb-8 text-sm max-w-3xl">
                {{ session('success') }}
            </div>
        @endif

        @if($bookings->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl border border-line">
                <span class="material-symbols-outlined text-5xl text-line block mb-4">confirmation_number</span>
                <p class="text-ink-soft mb-6">Kamu belum punya booking apa pun.</p>
                <a href="{{ route('landing.packages') }}"
                   class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-7 py-3 rounded-full transition">
                    Lihat Paket Wisata
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-2xl border border-line p-6 hover:shadow-lg transition">

                        <div class="flex justify-between items-start gap-3 mb-4">
                            <div>
                                <h3 class="font-display font-bold text-lg text-ink mb-1">
                                    {{ $booking->package->name ?? 'Paket dihapus' }}
                                </h3>
                                <p class="text-xs text-ink-soft">{{ $booking->booking_code }}</p>
                            </div>

                            @php
                                $statusColor = match($booking->status) {
                                    'Confirmed' => 'bg-primary-light text-primary',
                                    'Completed' => 'bg-primary text-white',
                                    'Cancelled' => 'bg-rose-100 text-rose-600',
                                    default => 'bg-accent-light text-accent',
                                };
                            @endphp
                            <span class="text-[11px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full shrink-0 {{ $statusColor }}">
                                {{ $booking->status }}
                            </span>
                        </div>

                        <div class="text-sm text-ink-soft space-y-1.5 pt-4 border-t border-line mb-5">
                            <p class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">event</span>
                                {{ $booking->booking_date->format('d M Y') }}
                            </p>
                            <p class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">group</span>
                                {{ $booking->total_people }} orang
                            </p>
                            <p class="font-display font-bold text-ink pt-1">
                                Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-line">
                            @if($booking->payment)
                                @php
                                    $payStatusColor = match($booking->payment->status) {
                                        'Lunas' => 'bg-primary-light text-primary',
                                        'Ditolak' => 'bg-rose-100 text-rose-600',
                                        default => 'bg-accent-light text-accent',
                                    };
                                @endphp
                                <span class="inline-flex items-center text-[11px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full {{ $payStatusColor }}">
                                    Pembayaran: {{ $booking->payment->status }}
                                </span>
                            @else
                                <a href="{{ route('payment.create', $booking->id) }}"
                                   class="inline-flex items-center gap-1.5 bg-accent hover:bg-accent/90 text-white text-sm font-semibold px-5 py-2.5 rounded-full transition">
                                    Bayar Sekarang
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </section>

</main>

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

</body>
</html>