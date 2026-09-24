<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HarauTrip — Jelajahi Keindahan Lembah Harau</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=optional"
      rel="stylesheet">

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
            <a href="{{ route('home') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-light text-primary">Beranda</a>
            <a href="{{ route('landing.destinations') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Destinasi</a>
            @auth
                <a href="{{ route('landing.packages') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Paket Wisata</a>
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

    {{-- ============================= HERO ============================= --}}
    <section id="beranda" class="relative max-w-7xl mx-auto px-6 lg:px-10 py-12 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            {{-- Left: copy --}}
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-wide">
                    <span class="material-symbols-outlined text-[16px]">eco</span>
                    Sumatera Barat, Indonesia
                </div>

                <h1 class="font-display font-extrabold text-4xl lg:text-5xl leading-tight tracking-tight text-ink">
                    Temukan Keindahan <span class="text-primary">Lembah Harau</span> Bersama HarauTrip
                </h1>

                <p class="text-ink-soft text-lg leading-relaxed max-w-xl">
                    Tebing granit menjulang, air terjun bertingkat, dan sawah hijau membentang —
                    rasakan pesona Lembah Harau bersama pemandu lokal yang memahami setiap sudutnya.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#destinasi-populer" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-accent hover:bg-accent/90 text-white font-semibold shadow-md transition">
                        Jelajahi Destinasi
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                    @auth
                        <a href="{{ route('landing.packages') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-white hover:bg-primary-light border border-line text-ink font-semibold transition">
                            <span class="material-symbols-outlined text-[20px] text-primary">travel_explore</span>
                            Lihat Paket Wisata
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-white hover:bg-primary-light border border-line text-ink font-semibold transition">
                            <span class="material-symbols-outlined text-[20px] text-primary">lock</span>
                            Masuk untuk Lihat Paket
                        </a>
                    @endauth
                </div>

                {{-- NOTE: angka di bawah masih placeholder — ganti dengan data asli kamu --}}
                <div class="grid grid-cols-3 gap-4 pt-8 max-w-md">
                    <div>
                        <div class="font-display font-extrabold text-2xl text-primary">300m+</div>
                        <div class="text-xs text-ink-soft mt-1">Tebing Granit Megah</div>
                    </div>
                    <div>
                        <div class="font-display font-extrabold text-2xl text-accent">6+</div>
                        <div class="text-xs text-ink-soft mt-1">Air Terjun Alami</div>
                    </div>
                    <div>
                        <div class="font-display font-extrabold text-2xl text-primary">100%</div>
                        <div class="text-xs text-ink-soft mt-1">Pemandu Lokal</div>
                    </div>
                </div>
            </div>

            {{-- Right: visual --}}
            <div class="lg:col-span-6 relative h-[420px] lg:h-[480px]">
                @php $heroDest = $spotlightDestinations->first(); @endphp

                <div class="relative w-full h-full rounded-3xl overflow-hidden shadow-xl">
                    @if($heroDest && $heroDest->image)
                        <img src="{{ asset('storage/'.$heroDest->image) }}" alt="{{ $heroDest->name }}" fetchpriority="high" decoding="async" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                            <span class="material-symbols-outlined text-white/30 text-[80px]">landscape</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                    @if($heroDest)
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <span class="text-[11px] font-bold uppercase tracking-wider bg-primary/80 px-2.5 py-1 rounded-full backdrop-blur-sm">{{ $heroDest->category }}</span>
                            <p class="font-display font-bold text-lg mt-2 drop-shadow">{{ $heroDest->name }}</p>
                            <p class="text-sm text-white/80">{{ $heroDest->location }}</p>
                        </div>
                    @endif
                </div>

                {{-- Floating card: destinasi ke-2 --}}
                @if($spotlightDestinations->count() > 1)
                    @php $floatDest = $spotlightDestinations[1]; @endphp
                    <div class="absolute -bottom-6 -left-6 bg-white p-3 rounded-2xl shadow-2xl flex items-center gap-3 max-w-[260px]">
                        <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-primary-light flex items-center justify-center">
                            @if($floatDest->image)
                                <img src="{{ asset('storage/'.$floatDest->image) }}" alt="{{ $floatDest->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-primary">landscape</span>
                            @endif
                        </div>
                        <div>
                            <p class="font-display font-bold text-sm text-ink leading-tight">{{ $floatDest->name }}</p>
                            <p class="text-xs text-primary font-medium">{{ $floatDest->category }}</p>
                        </div>
                    </div>
                @endif

                {{-- Floating badge --}}
                <div class="absolute -top-4 right-6 bg-white px-4 py-2 rounded-full shadow-lg flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[18px]">confirmation_number</span>
                    <span class="text-xs font-bold text-ink">Booking Online 24 Jam</span>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================= QUICK LINK BAR ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 -mt-4 mb-16 relative z-20">
        <div class="bg-white rounded-2xl shadow-lg border border-line p-5 lg:p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">

                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined">landscape</span>
                    </div>
                    <div>
                        <p class="text-xs text-ink-soft">Mulai dari</p>
                        <p class="font-display font-bold text-sm text-ink">Jelajahi Semua Destinasi</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-accent-light text-accent flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined">{{ auth()->check() ? 'confirmation_number' : 'lock' }}</span>
                    </div>
                    <div>
                        <p class="text-xs text-ink-soft">{{ auth()->check() ? 'Lihat semua' : 'Masuk untuk melihat' }}</p>
                        <p class="font-display font-bold text-sm text-ink">Paket Wisata Tersedia</p>
                    </div>
                </div>

                @auth
                    <a href="{{ route('landing.packages') }}" class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3.5 rounded-xl transition">
                        Cari Paket Wisata
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3.5 rounded-xl transition">
                        Masuk untuk Memesan
                        <span class="material-symbols-outlined text-[20px]">login</span>
                    </a>
                @endauth

            </div>
        </div>
    </section>

    {{-- ============================= KENAPA HARAUTRIP ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-accent font-bold text-xs uppercase tracking-widest">Kenapa Memilih Kami</span>
            <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-ink mt-3">Kenapa Menjelajah Bersama HarauTrip?</h2>
            <p class="text-ink-soft mt-3">Kami memastikan setiap perjalananmu ke Lembah Harau aman, transparan, dan berkesan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon' => 'verified', 'title' => 'Destinasi Terkurasi', 'desc' => 'Setiap destinasi dipilih dan diverifikasi langsung oleh tim kami.'],
                ['icon' => 'payments', 'title' => 'Harga Transparan', 'desc' => 'Tidak ada biaya tersembunyi, semua tertera jelas sejak awal.'],
                ['icon' => 'groups', 'title' => 'Pemandu Lokal', 'desc' => 'Dipandu warga setempat yang paham betul seluk-beluk Harau.'],
                ['icon' => 'support_agent', 'title' => 'Layanan Responsif', 'desc' => 'Tim kami siap membantu kebutuhan perjalananmu kapan saja.'],
            ] as $feature)
                <div class="bg-white border border-line rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-primary-light text-primary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined">{{ $feature['icon'] }}</span>
                    </div>
                    <h3 class="font-display font-bold text-ink mb-1.5">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-ink-soft leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============================= DESTINASI POPULER ============================= --}}
    <section id="destinasi-populer" class="max-w-7xl mx-auto px-6 lg:px-10 py-16">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <span class="text-accent font-bold text-xs uppercase tracking-widest">Destinasi Pilihan</span>
                <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-ink mt-3">Destinasi Ikonik Terpopuler</h2>
            </div>
            <a href="{{ route('landing.destinations') }}" class="inline-flex items-center gap-1.5 text-primary font-semibold text-sm hover:gap-2.5 transition-all">
                Lihat Semua Destinasi
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        @if($spotlightDestinations->isEmpty())
            <div class="text-center py-16 text-ink-soft">
                <span class="material-symbols-outlined text-5xl text-line block mb-3">landscape</span>
                Belum ada destinasi yang tersedia saat ini.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($spotlightDestinations as $destination)
                    <a href="{{ route('destinations.show', $destination) }}" class="group bg-white rounded-2xl overflow-hidden border border-line hover:shadow-xl transition-all">
                        <div class="h-52 overflow-hidden bg-primary-light">
                            @if($destination->image)
                                <img src="{{ asset('storage/'.$destination->image) }}"
                                     alt="{{ $destination->name }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary/40 text-5xl">landscape</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-primary bg-primary-light px-2.5 py-1 rounded-full">{{ $destination->category }}</span>
                            <h3 class="font-display font-bold text-lg text-ink mt-3 mb-1">{{ $destination->name }}</h3>
                            <p class="text-sm text-ink-soft flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                {{ $destination->location }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- ============================= PAKET WISATA ============================= --}}
    <section class="bg-primary-light/40 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-accent font-bold text-xs uppercase tracking-widest">Rencanakan Perjalananmu</span>
                    <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-ink mt-3">Paket Wisata Pilihan</h2>
                </div>
                @auth
                    <a href="{{ route('landing.packages') }}" class="inline-flex items-center gap-1.5 text-primary font-semibold text-sm hover:gap-2.5 transition-all">
                        Lihat Semua Paket
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                @endauth
            </div>

            @guest
                {{-- Belum login: tampilkan teaser terkunci, tidak menampilkan harga/detail paket --}}
                <div class="bg-white border border-line rounded-3xl px-8 py-14 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 rounded-2xl bg-primary-light text-primary flex items-center justify-center mx-auto mb-5">
                        <span class="material-symbols-outlined text-3xl">lock</span>
                    </div>
                    <h3 class="font-display font-bold text-xl text-ink mb-2">Masuk untuk Melihat Paket Wisata</h3>
                    <p class="text-ink-soft text-sm leading-relaxed max-w-md mx-auto mb-7">
                        Daftar atau masuk ke akunmu untuk melihat pilihan paket wisata lengkap
                        beserta harga, durasi, dan proses pemesanannya.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-7 py-3 rounded-full transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white hover:bg-primary-light border border-line text-ink font-semibold px-7 py-3 rounded-full transition">
                            Daftar Akun Baru
                        </a>
                    </div>
                </div>
            @else
                @if($featuredPackages->isEmpty())
                    <div class="text-center py-16 text-ink-soft">
                        <span class="material-symbols-outlined text-5xl text-line block mb-3">confirmation_number</span>
                        Belum ada paket wisata yang tersedia saat ini.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($featuredPackages as $package)
                            <div class="bg-white rounded-2xl overflow-hidden border border-line hover:shadow-xl transition-all flex flex-col">
                                <div class="h-44 overflow-hidden bg-primary-light">
                                    @if($package->destination && $package->destination->image)
                                        <img src="{{ asset('storage/'.$package->destination->image) }}" alt="{{ $package->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary/40 text-4xl">confirmation_number</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-5 flex flex-col flex-1">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-accent bg-accent-light px-2.5 py-1 rounded-full w-fit">{{ $package->category }}</span>

                                    <h3 class="font-display font-bold text-lg text-ink mt-3 mb-1.5">{{ $package->name }}</h3>

                                    <p class="text-sm text-ink-soft leading-relaxed line-clamp-2 mb-4">
                                        {{ $package->description }}
                                    </p>

                                    <div class="flex items-center gap-4 text-xs text-ink-soft mb-4">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[15px]">schedule</span>
                                            {{ $package->duration_days }} Hari
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[15px]">group</span>
                                            Maks {{ $package->quota }} orang
                                        </span>
                                    </div>

                                    <div class="mt-auto flex items-center justify-between pt-4 border-t border-line">
                                        <div>
                                            <p class="text-[11px] text-ink-soft">Mulai dari</p>
                                            <p class="font-display font-extrabold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="{{ route('landing.packages') }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                                            Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endguest

        </div>
    </section>

    {{-- ============================= SUSTAINABILITY / ABOUT ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <div class="rounded-3xl overflow-hidden h-80 lg:h-96 bg-primary-light">
                @php $aboutImg = $spotlightDestinations->firstWhere('image', '!=', null); @endphp
                @if($aboutImg)
                    <img src="{{ asset('storage/'.$aboutImg->image) }}" alt="{{ $aboutImg->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary/30 text-6xl">forest</span>
                    </div>
                @endif
            </div>

            <div class="space-y-5">
                <span class="text-accent font-bold text-xs uppercase tracking-widest">Wisata Berkelanjutan</span>
                <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-ink leading-tight">
                    Pariwisata yang Berakar pada Keramahan Nagari
                </h2>
                <p class="text-ink-soft leading-relaxed">
                    Kami percaya wisata yang baik adalah wisata yang menghidupkan, bukan menguras.
                    Setiap perjalanan bersama HarauTrip melibatkan masyarakat lokal secara langsung —
                    dari pemandu, penginapan, hingga kuliner khas Minang.
                </p>

                <div class="grid grid-cols-3 gap-6 pt-4">
                    <div>
                        <p class="font-display font-extrabold text-2xl text-primary">{{ $spotlightDestinations->count() }}+</p>
                        <p class="text-xs text-ink-soft mt-1">Destinasi Terkurasi</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl text-accent">{{ $featuredPackages->count() }}+</p>
                        <p class="text-xs text-ink-soft mt-1">Paket Wisata</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl text-primary">100%</p>
                        <p class="text-xs text-ink-soft mt-1">Pemandu Lokal</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================= CTA BANNER ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-16">
        <div class="relative bg-primary rounded-3xl overflow-hidden px-8 py-14 lg:px-16 lg:py-16 text-center">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-14 -left-10 w-56 h-56 bg-primary-dark/40 rounded-full"></div>

            <div class="relative max-w-xl mx-auto">
                <h2 class="font-display font-extrabold text-2xl lg:text-3xl text-white mb-3">
                    Siap Menjelajahi Pesona Megah Lembah Harau?
                </h2>
                <p class="text-white/80 mb-7">
                    Daftar sekarang dan mulai rencanakan perjalanan tak terlupakan bersama kami.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('landing.packages') }}" class="inline-flex items-center gap-2 bg-accent hover:bg-accent/90 text-white font-semibold px-7 py-3.5 rounded-full transition">
                            Lihat Paket Wisata
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-accent hover:bg-accent/90 text-white font-semibold px-7 py-3.5 rounded-full transition">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('landing.contact') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-3.5 rounded-full border border-white/30 transition">
                            Hubungi Kami
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- ============================= FAQ ============================= --}}
    <section class="max-w-4xl mx-auto px-6 lg:px-10 py-16">
        <div class="text-center mb-10">
            <span class="text-accent font-bold text-xs uppercase tracking-widest">Ada Pertanyaan?</span>
            <h2 class="font-display font-extrabold text-3xl text-ink mt-3">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-3">
            @foreach([
                ['q' => 'Bagaimana cara memesan paket wisata?', 'a' => 'Pilih paket wisata yang kamu inginkan, daftar atau masuk ke akunmu, lalu lengkapi data pemesanan dan lakukan pembayaran melalui halaman checkout.'],
                ['q' => 'Apakah harga sudah termasuk pemandu?', 'a' => 'Sebagian besar paket sudah termasuk pemandu lokal berlisensi. Detail apa saja yang termasuk bisa dilihat di halaman detail masing-masing paket.'],
                ['q' => 'Bagaimana cara pembatalan pemesanan?', 'a' => 'Kamu bisa menghubungi tim kami melalui halaman Kontak untuk proses pembatalan atau perubahan jadwal.'],
                ['q' => 'Apakah tersedia layanan check-in di lokasi?', 'a' => 'Ya, tim operator kami akan memverifikasi kode voucher booking kamu langsung di lokasi sebelum kegiatan dimulai.'],
            ] as $i => $faq)
                <div class="bg-white border border-line rounded-2xl overflow-hidden">
                    <button type="button"
                            class="faq-toggle w-full flex items-center justify-between gap-4 px-5 py-4 text-left"
                            aria-expanded="false"
                            onclick="const btn=this; const expanded=btn.getAttribute('aria-expanded')==='true'; btn.setAttribute('aria-expanded', !expanded);">
                        <span class="font-semibold text-ink text-sm">{{ $faq['q'] }}</span>
                        <span class="material-symbols-outlined faq-icon text-primary transition-transform shrink-0">add</span>
                    </button>
                    <div class="faq-panel px-5 pb-4">
                        <p class="text-sm text-ink-soft leading-relaxed">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
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