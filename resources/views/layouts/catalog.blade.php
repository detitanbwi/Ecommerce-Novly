<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Klabat Online - Platform belanja cerdas untuk produk fisik dan digital di Minahasa Utara. Beli buku, properti, undangan digital, kandang ayam cepat & aman tanpa daftar akun.">
    <meta name="keywords" content="Klabat Online, e-commerce Minahasa Utara, beli produk digital, beli buku online, jual beli properti Minahasa, undangan digital, kandang ayam, belanja tanpa daftar, toko online terpercaya">
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

<body class="bg-slate-50 min-h-screen text-slate-800 flex flex-col">

    <!-- Minimalist Header -->
    <!-- Premium Dark Header -->
    <header class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center gap-8">
            <!-- Logo -->
            <a href="/" class="text-2xl font-extrabold tracking-tight text-white hover:text-emerald-400 transition-colors shrink-0">Klabat Online.</a>
            
            <!-- Right Section -->
            <div class="flex items-center gap-8 flex-1 justify-end">
                <!-- Navigation -->
                <a href="#footer-contact"
                    class="hidden md:inline-block text-sm font-bold text-slate-300 hover:text-white transition-colors">
                    Hubungi Kami
                </a>
                
                <!-- Search Bar -->
                <div class="relative w-full max-w-xs group hidden sm:block">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Cari produk..." 
                        class="block w-full pl-11 pr-4 py-2 bg-white border border-transparent rounded-full text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm">
                </div>

                <!-- Mobile Icons -->
                <div class="flex items-center gap-4 md:hidden">
                    <button class="text-slate-300 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                    <a href="#footer-contact" class="text-slate-300 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Directory Content -->
    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer-contact" class="bg-slate-900 text-slate-300 mt-auto pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-extrabold text-white tracking-tight mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-slate-900 text-sm">KO</span>
                    Klabat Online.
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed max-w-xs">
                    Platform belanja cerdas untuk kebutuhan produk fisik maupun digital Anda. Cepat, aman, dan tanpa repot daftar akun.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-xs font-bold text-white uppercase tracking-widest mb-6">Layanan</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="/" class="hover:text-emerald-400 transition-colors">Semua Produk</a></li>
                    @foreach(\App\Models\Category::all() as $category)
                        <li><a href="/?category={{ $category->slug }}" class="hover:text-emerald-400 transition-colors">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-xs font-bold text-white uppercase tracking-widest mb-6">Kontak</h4>
                <div class="space-y-4 text-sm text-slate-400">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center shrink-0 border border-slate-700">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <span class="pt-1">{{ \App\Models\Setting::where('key', 'company_address')->value('value') ?? 'Jaga IV, Kel Suwaan Kec Kalawat, Kab Minahasa Utara' }}</span>
                    </div>
                    <a href="https://wa.me/{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6285242927535' }}" target="_blank" class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center shrink-0 border border-slate-700 group-hover:border-emerald-500/50 transition-colors">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <span class="group-hover:text-white transition-colors">+{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6285242927535' }} (WhatsApp)</span>
                    </a>
                    <a href="mailto:{{ \App\Models\Setting::where('key', 'company_email')->value('value') ?? 'davidfinance4@gmail.com' }}" class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center shrink-0 border border-slate-700 group-hover:border-emerald-500/50 transition-colors">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="group-hover:text-white transition-colors">{{ \App\Models\Setting::where('key', 'company_email')->value('value') ?? 'davidfinance4@gmail.com' }}</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="max-w-6xl mx-auto px-4 text-center text-xs text-slate-500 font-medium pt-8 border-t border-slate-800/50">
            &copy; {{ date('Y') }} Klabat Online. All rights reserved.
        </div>
    </footer>
</body>

</html>