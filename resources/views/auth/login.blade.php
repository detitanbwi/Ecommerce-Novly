<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klabat Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-green-100 w-full max-w-sm">
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
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required autofocus>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>
