<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog') - Klabat Online</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-green-50 min-h-screen text-slate-800 flex flex-col">

    <!-- Minimalist Header -->
    <header class="bg-emerald-700 border-b border-emerald-800 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold tracking-tight text-white">Klabat Online.</a>
            <!-- Minimal Nav or Contact -->
            <a href="#footer-contact"
                class="text-sm font-semibold text-emerald-50 hover:text-emerald-200 transition-colors">
                Hubungi Kami
            </a>
        </div>
    </header>

    <!-- Main Directory Content -->
    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer-contact" class="bg-emerald-800 text-emerald-50 mt-auto pt-12 pb-8 border-t border-emerald-900">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-extrabold text-white tracking-tight mb-4">Klabat Online.</h3>
                <p class="text-emerald-200 text-sm leading-relaxed">
                    Platform belanja cerdas untuk kebutuhan produk fisik maupun digital Anda. Cepat, aman, dan tanpa repot daftar akun.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Layanan</h4>
                <ul class="space-y-2 text-sm text-emerald-200">
                    <li><a href="/" class="hover:text-white transition-colors">Semua Produk</a></li>
                    @foreach(\App\Models\Category::all() as $category)
                        <li><a href="/?category={{ $category->slug }}" class="hover:text-white transition-colors">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Kontak</h4>
                <div class="space-y-4 text-sm text-emerald-200">
                    <p class="flex items-start gap-3">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ \App\Models\Setting::where('key', 'company_address')->value('value') ?? 'Jaga IV, Kel Suwaan Kec Kalawat, Kab Minahasa Utara' }}</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <a href="https://wa.me/{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6285242927535' }}" target="_blank" class="hover:text-white transition-colors">
                            +{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6285242927535' }} (WhatsApp)
                        </a>
                    </p>
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:{{ \App\Models\Setting::where('key', 'company_email')->value('value') ?? 'davidfinance4@gmail.com' }}" class="hover:text-white transition-colors">
                            {{ \App\Models\Setting::where('key', 'company_email')->value('value') ?? 'davidfinance4@gmail.com' }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="max-w-6xl mx-auto px-4 text-center text-xs text-emerald-400 font-medium pt-8 border-t border-emerald-700/50">
            &copy; {{ date('Y') }} Klabat Online. All rights reserved.
        </div>
    </footer>
</body>

</html>