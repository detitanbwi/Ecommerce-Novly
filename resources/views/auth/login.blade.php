<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klabat Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f4fa',
                            100: '#e1e9f5',
                            200: '#c2d2eb',
                            300: '#94b1dd',
                            400: '#5f89cc',
                            500: '#3d67b0',
                            600: '#2d5191',
                            700: '#254276',
                            800: '#0b234c',
                            900: '#1a2a4d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 w-full max-w-sm">
        <h2 class="text-2xl font-bold text-slate-900 mb-6 text-center">Admin Login</h2>
        
        @if(session('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm font-medium border border-red-100">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-800 focus:border-transparent" required autofocus>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-800 focus:border-transparent" required>
            </div>

            <button type="submit" class="w-full bg-brand-800 hover:bg-brand-900 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>
