<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $destination->name }} — HarauTrip</title>

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
    .video-container, .map-container { width: 100%; overflow: hidden; border-radius: 20px; }
    .video-container { aspect-ratio: 16 / 9; background: #182420; }
    .video-container iframe, .map-container iframe { width: 100%; height: 100%; border: 0; }
    .map-container { height: 420px; }
    @media (max-width: 768px) { .map-container { height: 320px; } }
</style>
</head>
<body class="bg-cream text-ink antialiased">

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
            <a href="{{ route('home') }}#destinasi-populer" class="px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-light text-primary">Destinasi</a>
            @auth
                <a href="{{ route('landing.packages') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Paket Wisata</a>
            @endauth
            <a href="{{ route('landing.about') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Tentang Kami</a>
            <a href="{{ route('landing.contact') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Kontak</a>
        </nav>

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

@php
    $videoId = null;
    if ($destination->video_url) {
        $u = $destination->video_url;
        $host = parse_url($u, PHP_URL_HOST);
        $path = trim(parse_url($u, PHP_URL_PATH) ?? '', '/');
        parse_str(parse_url($u, PHP_URL_QUERY) ?? '', $q);
        $videoId = ($host === 'youtu.be' || $host === 'www.youtu.be') ? $path : ($q['v'] ?? null);
        if (!$videoId && str_contains($host ?? '', 'youtube.com') && preg_match('/^(?:shorts|embed)\/([^\/]+)/', $path, $m)) {
            $videoId = $m[1];
        }
    }
@endphp

<main class="pt-24">

    {{-- ============================= HERO ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 pt-6">
        <div class="relative min-h-[55vh] flex items-end rounded-3xl overflow-hidden bg-ink">
            @if($destination->image)
                <img src="{{ asset('storage/'.$destination->image) }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $destination->name }}">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                    <span class="material-symbols-outlined text-white/30 text-[90px]">landscape</span>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

            <div class="relative w-full p-8 md:p-12 text-white">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider bg-primary/80 px-3 py-1.5 rounded-full backdrop-blur-sm">
                    {{ $destination->category }}
                </span>
                <h1 class="font-display font-extrabold text-4xl md:text-6xl mt-4">{{ $destination->name }}</h1>
                <p class="mt-3 flex items-center gap-1.5 text-white/80">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    {{ $destination->location }}
                </p>
            </div>
        </div>
    </section>

    {{-- ============================= DETAIL ============================= --}}
    <section class="max-w-6xl mx-auto px-6 lg:px-10 py-16">
        <div class="grid md:grid-cols-3 gap-10">

            <div class="md:col-span-2">
                <h2 class="font-display font-extrabold text-2xl lg:text-3xl text-ink mb-4">Tentang Destinasi</h2>
                <p class="leading-8 text-ink-soft whitespace-pre-line">{{ $destination->description }}</p>
            </div>

            <div class="bg-primary rounded-2xl p-7 h-fit">
                <h3 class="font-display font-bold text-xl text-white mb-6">Yang Perlu Kamu Tahu</h3>
                <div class="space-y-5">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-accent-light">Kategori</span>
                        <p class="text-white text-sm mt-1">{{ $destination->category }}</p>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-accent-light">Lokasi</span>
                        <p class="text-white text-sm mt-1">{{ $destination->location }}</p>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-accent-light">Jam Operasional</span>
                        <p class="text-white text-sm mt-1">{{ substr($destination->open_time, 0, 5) }} — {{ substr($destination->close_time, 0, 5) }} WIB</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================= PAKET WISATA DI DESTINASI INI ============================= --}}
    <section class="bg-primary-light/40 py-16">
        <div class="max-w-6xl mx-auto px-6 lg:px-10">
            <h2 class="font-display font-extrabold text-2xl lg:text-3xl text-ink mb-8">Paket Wisata di {{ $destination->name }}</h2>

            @guest
                <div class="bg-white border border-line rounded-3xl px-8 py-12 text-center max-w-xl mx-auto">
                    <div class="w-14 h-14 rounded-2xl bg-primary-light text-primary flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-2xl">lock</span>
                    </div>
                    <h3 class="font-display font-bold text-lg text-ink mb-2">Masuk untuk Melihat Paket & Harga</h3>
                    <p class="text-ink-soft text-sm mb-6">Daftar atau masuk ke akunmu untuk melihat paket wisata di destinasi ini beserta harganya.</p>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-6 py-2.5 rounded-full transition">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white hover:bg-primary-light border border-line text-ink text-sm font-semibold px-6 py-2.5 rounded-full transition">Daftar</a>
                    </div>
                </div>
            @else
                @if($relatedPackages->isEmpty())
                    <div class="text-center py-12 text-ink-soft">
                        <span class="material-symbols-outlined text-4xl text-line block mb-2">confirmation_number</span>
                        Belum ada paket wisata untuk destinasi ini.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedPackages as $package)
                            <div class="bg-white rounded-2xl border border-line p-6 flex flex-col">
                                <h3 class="font-display font-bold text-lg text-ink mb-1.5">{{ $package->name }}</h3>
                                <p class="text-sm text-ink-soft line-clamp-2 mb-4">{{ $package->description }}</p>

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

                                <div class="mt-auto pt-4 border-t border-line flex items-center justify-between">
                                    <p class="font-display font-extrabold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('booking.create', ['package' => $package->id]) }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-4 py-2 rounded-full transition">
                                        Pesan
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endguest
        </div>
    </section>

    {{-- ============================= VIDEO ============================= --}}
    @if($videoId)
        <section class="max-w-6xl mx-auto px-6 lg:px-10 py-16">
            <h2 class="font-display font-extrabold text-2xl lg:text-3xl text-ink mb-6">Video Destinasi</h2>
            <div class="video-container shadow-xl">
                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
            </div>
        </section>
    @endif

    {{-- ============================= PETA ============================= --}}
    <section class="max-w-6xl mx-auto px-6 lg:px-10 py-16">
        <h2 class="font-display font-extrabold text-2xl lg:text-3xl text-ink mb-6">Lokasi Destinasi</h2>
        <div class="map-container shadow-xl">
            <iframe src="https://www.google.com/maps?q={{ urlencode($destination->name.', '.$destination->location) }}&output=embed" loading="lazy"></iframe>
        </div>
        <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($destination->name.', '.$destination->location) }}"
           class="inline-flex items-center gap-1.5 mt-5 text-sm font-semibold text-primary hover:gap-2.5 transition-all">
            Buka di Google Maps
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </section>

    {{-- ============================= DESTINASI LAINNYA ============================= --}}
    @if($otherDestinations->count())
        <section class="max-w-6xl mx-auto px-6 lg:px-10 pb-20">
            <h2 class="font-display font-extrabold text-2xl lg:text-3xl text-ink mb-8">Destinasi Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherDestinations as $other)
                    <a href="{{ route('destinations.show', $other) }}" class="group bg-white rounded-2xl overflow-hidden border border-line hover:shadow-xl transition-all">
                        <div class="h-48 overflow-hidden bg-primary-light">
                            @if($other->image)
                                <img src="{{ asset('storage/'.$other->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $other->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary/40 text-4xl">landscape</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-primary bg-primary-light px-2.5 py-1 rounded-full">{{ $other->category }}</span>
                            <h3 class="font-display font-bold text-lg text-ink mt-3 mb-1">{{ $other->name }}</h3>
                            <p class="text-sm text-ink-soft flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                {{ $other->location }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

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