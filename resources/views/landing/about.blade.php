<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tentang Kami — HarauTrip</title>

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
                <a href="{{ route('landing.packages') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Paket Wisata</a>
            @endauth
            <a href="{{ route('landing.about') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-light text-primary">Tentang Kami</a>
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
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-12 lg:py-16">
        <div class="relative rounded-3xl overflow-hidden min-h-[60vh] bg-ink">

            @php $heroImg = $aboutDestinations->get(0); @endphp
            @if($heroImg)
                <img src="{{ asset('storage/'.$heroImg->image) }}" alt="{{ $heroImg->name }}" fetchpriority="high" decoding="async" class="absolute inset-0 w-full h-full object-cover">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-primary to-primary-dark"></div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/50 to-ink/10"></div>

            <div class="absolute inset-0 flex items-end">
                <div class="p-8 md:p-12 lg:p-16">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-wide mb-5">
                        <span class="material-symbols-outlined text-[16px]">groups</span>
                        Tentang Kami
                    </div>
                    <h1 class="font-display font-extrabold text-4xl md:text-5xl text-white leading-tight max-w-2xl">
                        Kami tumbuh dari lembah ini, bukan sekadar berjualan tiketnya.
                    </h1>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================= CERITA ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="space-y-5">
                <span class="text-accent font-bold text-xs uppercase tracking-widest">Cerita Kami</span>
                <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-ink leading-tight">
                    HarauTrip lahir dari orang-orang yang tumbuh di kaki tebing granit ini.
                </h2>
                <p class="text-ink-soft leading-relaxed">
                    Kami menghubungkan Anda dengan keindahan alam Lembah Harau di Sumatera Barat —
                    tebing granit setinggi 100–150 meter, tujuh air terjun, dan budaya Minangkabau
                    yang masih terjaga di setiap sudut nagari.
                </p>
                <p class="text-ink-soft leading-relaxed">
                    Setiap paket yang kami susun dikerjakan bersama pemandu lokal, supaya
                    perjalananmu bukan cuma singgah, tapi benar-benar mengenal lembah ini.
                </p>
            </div>

            <div class="rounded-3xl overflow-hidden h-80 lg:h-96 bg-primary-light">
                @php $storyImg = $aboutDestinations->get(1); @endphp
                @if($storyImg)
                    <img src="{{ asset('storage/'.$storyImg->image) }}" alt="{{ $storyImg->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary/30 text-6xl">landscape</span>
                    </div>
                @endif
            </div>

        </div>
    </section>

    {{-- ============================= VALUES ============================= --}}
    <section class="bg-primary py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-accent-light font-bold text-xs uppercase tracking-widest">Yang Kami Pegang</span>
                <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-white mt-3">Tiga Hal yang Tidak Kami Tawar</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach([
                    ['icon' => 'groups', 'title' => 'Pemandu Lokal', 'desc' => 'Setiap rombongan didampingi warga sekitar yang tahu jalur, cuaca, dan cerita di balik setiap tebing.'],
                    ['icon' => 'eco', 'title' => 'Alam Terjaga', 'desc' => 'Kami membatasi jumlah rombongan per hari, supaya lembah ini tetap seperti yang kami kenal sejak kecil.'],
                    ['icon' => 'payments', 'title' => 'Harga Jujur', 'desc' => 'Tidak ada biaya tersembunyi. Yang tertera di paket, itu yang kamu bayar.'],
                ] as $value)
                    <div class="bg-primary-dark/40 border border-white/10 rounded-2xl p-7">
                        <div class="w-12 h-12 rounded-xl bg-white/10 text-accent-light flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined">{{ $value['icon'] }}</span>
                        </div>
                        <h3 class="font-display font-bold text-white text-lg mb-2">{{ $value['title'] }}</h3>
                        <p class="text-sm text-white/70 leading-relaxed">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ============================= CTA ============================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16 text-center">
        <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-ink max-w-xl mx-auto leading-tight mb-8">
            Siap melihat langsung tebing yang kami ceritakan?
        </h2>

        @auth
            <a href="{{ route('landing.packages') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-4 rounded-full transition">
                Lihat Paket Wisata
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-4 rounded-full transition">
                <span class="material-symbols-outlined text-[20px]">lock</span>
                Masuk untuk Lihat Paket Wisata
            </a>
        @endauth
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