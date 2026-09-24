<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HarauTrip — Daftar</title>

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
    input:focus {
        outline: none;
        border-color: #0e7a3f !important;
        box-shadow: 0 0 0 3px rgba(14, 122, 63, 0.12);
    }
</style>
</head>
<body class="bg-cream text-ink antialiased min-h-screen flex items-center justify-center p-6 lg:p-8">

<div class="w-full max-w-5xl min-h-[640px] bg-cream rounded-[22px] overflow-hidden grid grid-cols-1 lg:grid-cols-2 shadow-2xl">

    {{-- ============================= LEFT PANEL ============================= --}}
    <div class="hidden lg:flex relative flex-col justify-between bg-gradient-to-br from-primary-dark to-primary text-cream p-12 overflow-hidden">

        {{-- Decorative texture --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background:
                radial-gradient(circle at 85% 15%, rgba(234,106,18,0.18), transparent 45%),
                repeating-linear-gradient(115deg, rgba(250,248,243,0.035) 0px, rgba(250,248,243,0.035) 1px, transparent 1px, transparent 34px);">
        </div>

        <div class="relative z-10">
            <div class="flex items-center gap-2.5">
                <svg width="32" height="32" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="9" r="4.5" fill="#EA6A12"/>
                    <path d="M3 27L11.5 12L17 20.5L20.5 15L31 27H3Z" fill="#FAF8F3"/>
                    <path d="M11.5 12L14.5 17L11.5 22.5L8.5 17L11.5 12Z" fill="#e6f4ea"/>
                </svg>
                <span class="font-display font-extrabold text-xl tracking-tight">Harau<span class="text-accent">Trip</span></span>
            </div>

            <p class="mt-16 text-xs font-bold uppercase tracking-[0.2em] text-accent-light/90">
                Sumatera Barat · Indonesia
            </p>

            <h1 class="font-display font-semibold text-4xl leading-tight mt-4">
                Mulai jelajahi
                <br>
                <em class="italic text-accent-light font-normal">lembah</em> Harau.
            </h1>

            <p class="mt-5 text-sm leading-relaxed text-cream/80 max-w-sm">
                Buat akun untuk memesan paket wisata, menyimpan destinasi favorit,
                dan mendapatkan penawaran khusus dari HarauTrip.
            </p>
        </div>

        <div class="relative z-10 flex items-center gap-3.5">
            <div class="flex">
                <span class="w-8 h-8 rounded-full border-2 border-primary-dark bg-accent-light flex items-center justify-center text-[11px] font-bold text-primary-dark">AR</span>
                <span class="w-8 h-8 rounded-full border-2 border-primary-dark bg-accent-light flex items-center justify-center text-[11px] font-bold text-primary-dark -ml-2.5">NP</span>
                <span class="w-8 h-8 rounded-full border-2 border-primary-dark bg-accent-light flex items-center justify-center text-[11px] font-bold text-primary-dark -ml-2.5">DS</span>
            </div>
            <p class="text-xs leading-snug text-cream/70">
                <strong class="text-cream font-semibold">2.400+ penjelajah</strong>
                sudah menjelajah Harau bersama kami.
            </p>
        </div>

    </div>

    {{-- ============================= RIGHT PANEL (FORM) ============================= --}}
    <div class="bg-cream p-8 sm:p-12 flex flex-col justify-center overflow-y-auto">

        {{-- Mobile logo (shown only when left panel is hidden) --}}
        <div class="flex lg:hidden items-center gap-2.5 mb-8">
            <svg width="30" height="30" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="24" cy="9" r="4.5" fill="#EA6A12"/>
                <path d="M3 27L11.5 12L17 20.5L20.5 15L31 27H3Z" fill="#0E7A3F"/>
                <path d="M11.5 12L14.5 17L11.5 22.5L8.5 17L11.5 12Z" fill="#0A5C30"/>
            </svg>
            <span class="font-display font-extrabold text-lg tracking-tight text-primary">Harau<span class="text-accent">Trip</span></span>
        </div>

        <div class="mb-6">
            <h1 class="font-display font-bold text-2xl text-ink mb-1.5">Buat akun baru</h1>
            <p class="text-sm text-ink-soft mb-1.5">Sudah punya akun?</p>
            <a href="{{ route('login') }}"
               class="inline-block text-primary text-sm font-semibold border-b border-accent hover:text-accent transition">
                Masuk di sini
            </a>
        </div>

        {{-- REGISTER FORM --}}
        <form action="{{ route('register.process') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 rounded-xl px-4 py-3 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- NAMA --}}
            <div class="flex flex-col gap-1.5">
                <label for="regName" class="text-xs font-semibold text-ink tracking-wide">Nama lengkap</label>
                <input
                    id="regName"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    placeholder="Nama kamu"
                    required
                    autocomplete="name"
                    class="w-full px-4 py-3.5 rounded-xl border border-line bg-white text-ink text-sm placeholder:text-ink-soft/60">
            </div>

            {{-- EMAIL --}}
            <div class="flex flex-col gap-1.5">
                <label for="regEmail" class="text-xs font-semibold text-ink tracking-wide">Email</label>
                <input
                    id="regEmail"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    required
                    autocomplete="email"
                    class="w-full px-4 py-3.5 rounded-xl border border-line bg-white text-ink text-sm placeholder:text-ink-soft/60">
            </div>

            {{-- PASSWORD --}}
            <div class="flex flex-col gap-1.5">
                <label for="regPassword" class="text-xs font-semibold text-ink tracking-wide">Kata sandi</label>
                <input
                    id="regPassword"
                    name="password"
                    type="password"
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-3.5 rounded-xl border border-line bg-white text-ink text-sm placeholder:text-ink-soft/60">
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="flex flex-col gap-1.5">
                <label for="regConfirm" class="text-xs font-semibold text-ink tracking-wide">Konfirmasi kata sandi</label>
                <input
                    id="regConfirm"
                    name="password_confirmation"
                    type="password"
                    placeholder="Ulangi kata sandi"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-3.5 rounded-xl border border-line bg-white text-ink text-sm placeholder:text-ink-soft/60">
            </div>

            {{-- TERMS --}}
            <label class="flex items-start gap-2 text-sm text-ink-soft cursor-pointer -mt-1">
                <input type="checkbox" name="agree" value="1" required
                       class="mt-0.5 w-4 h-4 rounded border-line text-primary focus:ring-primary/30 shrink-0">
                <span>
                    Saya menyetujui
                    <a href="#" class="text-primary font-semibold border-b border-accent hover:text-accent transition">syarat &amp; ketentuan</a>
                    HarauTrip
                </span>
            </label>

            {{-- BUTTON --}}
            <button type="submit"
                    class="mt-2 inline-flex items-center justify-center gap-2 bg-accent hover:bg-accent/90 text-white font-semibold px-6 py-3.5 rounded-full shadow-sm transition">
                Daftar sekarang
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </button>

        </form>

    </div>

</div>

</body>
</html>