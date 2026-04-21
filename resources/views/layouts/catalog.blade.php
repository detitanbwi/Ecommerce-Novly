<!DOCTYPE html>
<html lang="en">

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

<body class="bg-slate-50 min-h-screen text-slate-800 flex flex-col">

    <!-- Minimalist Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold tracking-tight text-indigo-600">Klabat Online.</a>
            <!-- Minimal Nav or Contact -->
            <a href="https://wa.me/{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '' }}"
                target="_blank" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">
                Hubungi Kami
            </a>
        </div>
    </header>

    <!-- Main Directory Content -->
    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto py-8">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm text-slate-500 font-medium">
            &copy; {{ date('Y') }} Klabat Online. All rights reserved.
        </div>
    </footer>
</body>

</html>