<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kontak — HarauTrip</title>

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
            <a href="{{ route('landing.about') }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-ink-soft hover:text-ink transition">Tentang Kami</a>
            <a href="{{ route('landing.contact') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-light text-primary">Kontak</a>
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
    <section class="max-w-7xl mx-auto px-6 lg:px-10 pt-12 pb-16">
        <div class="text-center max-w-2xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-wide">
                <span class="material-symbols-outlined text-[16px]">chat</span>
                Bicara Dengan Kami
            </span>
            <h1 class="font-display font-extrabold text-4xl md:text-5xl text-ink mt-5 leading-tight">
                Ada pertanyaan sebelum berangkat?
            </h1>
        </div>
    </section>

    {{-- ============================= CONTACT ============================= --}}
    <section class="max-w-5xl mx-auto px-6 lg:px-10 pb-20">

        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-primary-light border border-primary/20 text-primary rounded-2xl px-5 py-4">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Contact info --}}
            <div class="bg-white border border-line rounded-2xl p-8 shadow-sm">
                <p class="text-accent font-bold text-xs uppercase tracking-widest mb-6">Hubungi Kami</p>
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">location_on</span>
                        </div>
                        <p class="text-sm text-ink">Lembah Harau, Sumatera Barat</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">call</span>
                        </div>
                        <p class="text-sm text-ink">+62 813 8999 3062</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                        </div>
                        <p class="text-sm text-ink">info@harautrip.com</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">language</span>
                        </div>
                        <p class="text-sm text-ink">www.harautrip.com</p>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-line">
                    <p class="text-xs font-bold uppercase tracking-widest text-ink-soft mb-2">Jam Operasional</p>
                    <p class="text-sm text-ink-soft">Senin – Minggu, 08.00 – 20.00 WIB</p>
                </div>
            </div>

            {{-- Form --}}
            <div class="bg-white border border-line rounded-2xl p-8 shadow-sm">
                <p class="text-accent font-bold text-xs uppercase tracking-widest mb-6">Kirim Pesan</p>
                <form action="{{ route('landing.contact.send') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-semibold uppercase tracking-widest text-ink-soft mb-2">Nama</label>
                        <input type="text" id="name" name="name" autocomplete="name" value="{{ old('name') }}"
                               class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-400' : 'border-line' }} focus:outline-none focus:border-primary transition">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-widest text-ink-soft mb-2">Email</label>
                        <input type="email" id="email" name="email" autocomplete="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-red-400' : 'border-line' }} focus:outline-none focus:border-primary transition">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-semibold uppercase tracking-widest text-ink-soft mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border {{ $errors->has('message') ? 'border-red-400' : 'border-line' }} focus:outline-none focus:border-primary transition">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3.5 rounded-full transition">
                        Kirim Pesan
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>
            </div>

        </div>

        <div class="text-center mt-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:gap-2.5 transition-all">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Beranda
            </a>
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
                    Membawa Sobat Harau menjelajah lembah, tebing, dan sawah Sumatera Barat sejak dari layar ini.
                </p>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Jelajah</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('landing.destinations') }}" class="hover:text-white transition">Destinasi</a></li>
                    @auth
                        <li><a href="{{ route('landing.packages') }}" class="hover:text-white transition">Paket Wisata</a></li>
                    @endauth
                    <li><a href="{{ route('landing.about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="{{ route('landing.contact') }}" class="hover:text-white transition">Kontak</a></li>
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
                    <li>+62 813 8999 3062</li>
                    <li>info@harautrip.com</li>
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