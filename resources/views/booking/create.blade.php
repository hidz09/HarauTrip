<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout — HarauTrip</title>

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

        input, select, textarea { transition: 0.2s ease; }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #0e7a3f !important;
            box-shadow: 0 0 0 3px rgba(14, 122, 63, 0.12);
        }

        .summary-card { position: sticky; top: 104px; }
        @media (max-width: 1024px) {
            .summary-card { position: static; }
        }
    </style>
</head>

<body class="bg-cream text-ink antialiased">

{{-- CATATAN: halaman ini auth-only (route booking.create/store dibungkus middleware 'auth') --}}

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
            <a href="{{ route('landing.packages') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-light text-primary">Paket Wisata</a>
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

{{-- ============================= CHECKOUT ============================= --}}
<section class="min-h-screen pt-32 pb-20">
    <div class="max-w-6xl mx-auto px-6 lg:px-10">

        {{-- HEADER --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-wide mb-5">
                <span class="material-symbols-outlined text-[16px]">confirmation_number</span>
                Checkout
            </div>
            <h1 class="font-display font-extrabold text-4xl md:text-5xl leading-tight tracking-tight text-ink mb-3">
                Pesan Paket Wisata
            </h1>
            <p class="text-ink-soft leading-relaxed">
                Lengkapi data pemesanan sebelum melanjutkan ke pembayaran.
            </p>
        </div>

        {{-- ERROR --}}
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 mb-8 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">

                {{-- ================= KIRI ================= --}}
                <div class="lg:col-span-2 bg-white rounded-3xl border border-line shadow-sm p-7 md:p-9">

                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-accent mb-2">Data Pemesanan</p>
                            <h2 class="font-display font-bold text-2xl text-ink">Lengkapi informasi</h2>
                        </div>
                        <span class="hidden sm:block text-xs text-ink-soft">* Wajib diisi</span>
                    </div>

                    {{-- PAKET --}}
                    <div class="mb-7">
                        <label for="packageSelect" class="block text-sm font-semibold text-ink mb-2">
                            Pilih Paket Wisata
                        </label>

                        <select name="tour_package_id"
                                id="packageSelect"
                                required
                                class="w-full px-4 py-3.5 rounded-xl border border-line bg-cream text-ink text-sm">

                            <option value="">-- Pilih Paket --</option>

                            @foreach($packages as $package)
                                <option value="{{ $package->id }}"
                                        data-price="{{ $package->price }}"
                                    {{ old('tour_package_id', $selectedPackageId ?? null) == $package->id ? 'selected' : '' }}>
                                    {{ $package->name }} — Rp {{ number_format($package->price,0,',','.') }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- NOMOR HP --}}
                    <div class="mb-7">
                        <label for="phone_number" class="block text-sm font-semibold text-ink mb-2">
                            Nomor HP / WhatsApp
                        </label>

                        <input type="tel"
                               name="phone_number"
                               id="phone_number"
                               required
                               placeholder="08xxxxxxxxxx"
                               value="{{ old('phone_number') }}"
                               class="w-full px-4 py-3.5 rounded-xl border border-line bg-cream text-ink text-sm placeholder:text-ink-soft/60">

                        <p class="text-xs text-ink-soft mt-2">
                            Kami akan menghubungi nomor ini untuk konfirmasi jadwal.
                        </p>
                    </div>

                    {{-- TANGGAL + JUMLAH ORANG --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-7">

                        {{-- TANGGAL --}}
                        <div>
                            <label for="booking_date" class="block text-sm font-semibold text-ink mb-2">
                                Tanggal Booking
                            </label>

                            <input type="date"
                                   name="booking_date"
                                   id="booking_date"
                                   required
                                   min="{{ date('Y-m-d') }}"
                                   value="{{ old('booking_date') }}"
                                   class="w-full px-4 py-3.5 rounded-xl border border-line bg-cream text-ink text-sm">
                        </div>

                        {{-- JUMLAH --}}
                        <div>
                            <label for="totalPeople" class="block text-sm font-semibold text-ink mb-2">
                                Jumlah Orang
                            </label>

                            <div class="flex rounded-xl overflow-hidden border border-line">
                                <button type="button"
                                        onclick="decreasePeople()"
                                        class="w-12 bg-primary-light text-primary text-lg font-bold hover:bg-primary hover:text-white transition">
                                    −
                                </button>

                                <input type="number"
                                       name="total_people"
                                       id="totalPeople"
                                       min="1"
                                       required
                                       value="{{ old('total_people', 1) }}"
                                       class="w-full px-4 py-3.5 border-x border-line bg-cream text-ink text-sm text-center">

                                <button type="button"
                                        onclick="increasePeople()"
                                        class="w-12 bg-primary-light text-primary text-lg font-bold hover:bg-primary hover:text-white transition">
                                    +
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- CATATAN --}}
                    <div class="mb-8">
                        <label for="notes" class="block text-sm font-semibold text-ink mb-2">
                            Catatan Tambahan
                            <span class="font-normal text-ink-soft">(opsional)</span>
                        </label>

                        <textarea name="notes"
                                  id="notes"
                                  rows="4"
                                  placeholder="Misalnya: titik jemput, alergi makanan, kebutuhan khusus, dll."
                                  class="w-full px-4 py-3.5 rounded-xl border border-line bg-cream text-ink text-sm resize-none placeholder:text-ink-soft/60">{{ old('notes') }}</textarea>
                    </div>

                    {{-- PERSETUJUAN --}}
                    <label class="flex items-start gap-3 text-sm text-ink-soft cursor-pointer">
                        <input type="checkbox"
                               name="agreement"
                               value="1"
                               required
                               class="mt-1 w-4 h-4 rounded border-line text-primary focus:ring-primary/30">
                        <span>
                            Saya memahami bahwa booking ini bersifat sementara
                            sampai pembayaran dikonfirmasi oleh admin.
                        </span>
                    </label>

                </div>

                {{-- ================= KANAN ================= --}}
                <div class="summary-card">

                    <div class="bg-white rounded-3xl border border-line shadow-sm p-7">

                        <p class="text-xs font-bold uppercase tracking-widest text-accent mb-2">Ringkasan Pesanan</p>
                        <h2 class="font-display font-bold text-2xl text-ink mb-7">Pesanan kamu</h2>

                        {{-- PAKET --}}
                        <div class="border-b border-line pb-6 mb-6">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-ink-soft mb-2">Paket Wisata</p>
                            <h3 id="summaryPackage" class="font-display font-bold text-xl text-ink">
                                Pilih paket
                            </h3>
                        </div>

                        {{-- HARGA --}}
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-ink-soft">Harga / orang</span>
                                <span id="pricePreview" class="text-ink font-medium">Rp 0</span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-ink-soft">Jumlah orang</span>
                                <span id="peoplePreview" class="text-ink font-medium">1 orang</span>
                            </div>
                        </div>

                        <div class="border-t border-line my-6"></div>

                        {{-- TOTAL --}}
                        <div class="flex justify-between items-end mb-7">
                            <p class="text-xs font-bold uppercase tracking-widest text-ink-soft">Total</p>
                            <span id="totalPreview" class="font-display font-extrabold text-2xl text-primary">
                                Rp 0
                            </span>
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent/90 text-white font-semibold px-6 py-3.5 rounded-full shadow-sm transition">
                            Lanjut ke Pembayaran
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </button>

                        <p class="flex items-center justify-center gap-1.5 text-center text-xs text-ink-soft mt-4">
                            <span class="material-symbols-outlined text-[15px]">lock</span>
                            Data pemesanan kamu aman
                        </p>

                    </div>

                    {{-- BACK --}}
                    <div class="text-center mt-6">
                        <a href="{{ route('landing.packages') }}"
                           class="inline-flex items-center gap-1.5 text-sm font-semibold text-ink-soft hover:text-ink transition">
                            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                            Kembali ke Paket Wisata
                        </a>
                    </div>

                </div>

            </div>

        </form>

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

{{-- ============================= JAVASCRIPT ============================= --}}
<script>
    const packageSelect = document.getElementById('packageSelect');
    const totalPeople = document.getElementById('totalPeople');

    const pricePreview = document.getElementById('pricePreview');
    const peoplePreview = document.getElementById('peoplePreview');
    const totalPreview = document.getElementById('totalPreview');
    const summaryPackage = document.getElementById('summaryPackage');

    function updateTotal() {
        const selected = packageSelect.options[packageSelect.selectedIndex];
        const price = selected ? parseFloat(selected.dataset.price || 0) : 0;

        let people = parseInt(totalPeople.value) || 1;
        if (people < 1) {
            people = 1;
            totalPeople.value = 1;
        }

        const total = price * people;

        // Nama paket
        if (selected && selected.value !== '') {
            summaryPackage.textContent = selected.textContent.split(' — ')[0];
        } else {
            summaryPackage.textContent = 'Pilih paket';
        }

        // Harga per orang
        pricePreview.textContent = 'Rp ' + price.toLocaleString('id-ID');

        // Jumlah orang
        peoplePreview.textContent = people + ' orang';

        // Total
        totalPreview.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function increasePeople() {
        let value = parseInt(totalPeople.value) || 1;
        totalPeople.value = value + 1;
        updateTotal();
    }

    function decreasePeople() {
        let value = parseInt(totalPeople.value) || 1;
        if (value > 1) {
            totalPeople.value = value - 1;
        }
        updateTotal();
    }

    packageSelect.addEventListener('change', updateTotal);
    totalPeople.addEventListener('input', updateTotal);

    updateTotal();
</script>

</body>
</html>