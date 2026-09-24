<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Paket Wisata — HarauTrip</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=optional" rel="stylesheet">

    {{-- Material Symbols --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0&display=block"
        rel="stylesheet"
    >

    {{-- Tailwind CSS lokal --}}
    @vite(['resources/css/app.css'])

    <style>
        /* Supaya judul section tidak ketutup header fixed (h-20 = 80px) */
        section[id] {
            scroll-margin-top: 80px;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .material-symbols-outlined {
            display: inline-block;
            width: 1em;
            height: 1em;
            overflow: hidden;
            font-variation-settings:
                'FILL' 0,
                'wght' 500,
                'GRAD' 0,
                'opsz' 24;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #d8dfd9;
            border-radius: 10px;
        }

        .faq-toggle[aria-expanded="true"] .faq-icon {
            transform: rotate(45deg);
        }

        .faq-panel {
            display: none;
        }

        .faq-toggle[aria-expanded="true"] + .faq-panel {
            display: block;
        }
    </style>

</head>
<body class="bg-cream text-ink antialiased">

{{-- ============================= HEADER ============================= --}}
<header class="fixed top-0 inset-x-0 z-50 bg-cream border-b border-line">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between gap-4">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="24" cy="9" r="4.5" fill="#EA6A12"/>
                <path d="M3 27L11.5 12L17 20.5L20.5 15L31 27H3Z" fill="#0E7A3F"/>
                <path d="M11.5 12L14.5 17L11.5 22.5L8.5 17L11.5 12Z" fill="#0A5C30"/>
            </svg>
            <span class="font-display font-extrabold text-xl tracking-tight text-primary">Harau<span class="text-accent">Trip</span></span>
        </a>

        {{-- Nav --}}
        <nav class="hidden lg:flex items-center gap-1 bg-white/70 px-2 py-1.5 rounded-full border border-line">
            <a href="{{ route('home') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Beranda</a>
            <a href="{{ route('landing.destinations') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Destinasi</a>
            @auth
                <a href="{{ route('landing.packages') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-light text-primary">Paket Wisata</a>
            @endauth
            <a href="{{ route('landing.about') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Tentang Kami</a>
            <a href="{{ route('landing.contact') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Kontak</a>
        </nav>

        {{-- Right actions --}}
        <div class="flex items-center gap-3">
            @auth
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
            @else
                <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-semibold text-ink-soft hover:text-ink transition px-2">Masuk</a>
                <a href="{{ route('register') }}" class="inline-flex items-center bg-accent hover:bg-accent/90 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm transition">
                    Daftar
                </a>
            @endauth
        </div>

    </div>
</header>

<main class="pt-20">

    {{-- ============================= PAGE HEADER ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-12 lg:py-16">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-wide mb-5">
            <span class="material-symbols-outlined text-[16px]">confirmation_number</span>
            Rencanakan Perjalanan
        </div>
        <h1 class="font-display font-extrabold text-4xl lg:text-5xl leading-tight tracking-tight text-ink max-w-2xl">
            Paket Wisata, Disusun Sesuai Jalur yang Benar-Benar Kami Tempuh
        </h1>
        <p class="text-ink-soft text-lg leading-relaxed max-w-xl mt-4">
            Pilih paket yang sesuai kebutuhanmu — semua sudah termasuk pemandu lokal dan rute yang teruji.
        </p>
    </section>

    {{-- ============================= PACKAGE LIST ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-20">

        @if($packages->isEmpty())
            <div class="text-center py-16 text-ink-soft">
                <span class="material-symbols-outlined text-5xl text-line block mb-3">confirmation_number</span>
                Belum ada paket wisata yang tersedia saat ini.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages as $package)
                    <div class="bg-white rounded-2xl overflow-hidden border border-line hover:shadow-xl transition-all flex flex-col">
                        <div class="h-52 overflow-hidden bg-primary-light">
                            @if($package->destination && $package->destination->image)
                                <img src="{{ asset('storage/'.$package->destination->image) }}" alt="{{ $package->name }}"
                                     loading="lazy" decoding="async"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary/40 text-5xl">confirmation_number</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            @if($package->destination)
                                <span class="text-[11px] font-bold uppercase tracking-wider text-primary bg-primary-light px-2.5 py-1 rounded-full w-fit">
                                    {{ $package->destination->name }}
                                </span>
                            @endif

                            <h3 class="font-display font-bold text-lg text-ink mt-3 mb-1.5">{{ $package->name }}</h3>

                            @if($package->description)
                                <p class="text-sm text-ink-soft leading-relaxed line-clamp-2 mb-4">
                                    {{ $package->description }}
                                </p>
                            @endif

                            <div class="flex items-center gap-4 text-xs text-ink-soft mb-4">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px]">schedule</span>
                                    {{ $package->duration_days }} Hari
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px]">group</span>
                                    Kuota {{ $package->quota }}
                                </span>
                            </div>

                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-line">
                                <div>
                                    <p class="text-[11px] text-ink-soft">Mulai dari</p>
                                    <p class="font-display font-extrabold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ route('booking.create', ['package' => $package->id]) }}"
                                   class="inline-flex items-center justify-center gap-1.5 bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                                    Checkout
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                            </div>
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
                    <li><a href="{{ route('landing.destinations') }}" class="hover:text-white transition">Destinasi</a></li>
                    @auth
                        <li><a href="{{ route('landing.packages') }}" class="hover:text-white transition">Paket Wisata</a></li>
                    @endauth
                    <li><a href="{{ route('landing.about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Bantuan</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('landing.contact') }}" class="hover:text-white transition">Hubungi Kami</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Riwayat Pemesanan</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Daftar Akun</a></li>
                    @endauth
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