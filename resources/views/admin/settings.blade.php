@extends('layouts.admin')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Settings</h1>
    <p class="text-slate-500 font-normal mt-1">Konfigurasi pengaturan global marketplace Anda.</p>
</div>

<div class="max-w-2xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-8 mb-10">
        @csrf
        
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Nomor WhatsApp Admin</label>
            <div class="relative">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">+</span>
                <input type="text" name="whatsapp_number" required value="{{ old('whatsapp_number', $whatsappNumber) }}" placeholder="628123456789" class="w-full pl-8 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-semibold text-slate-900">
            </div>
            <p class="mt-3 text-[11px] text-slate-400 leading-relaxed italic">Gunakan kode negara (contoh: 62 untuk Indonesia) tanpa tanda "+" atau spasi. Nomor ini akan digunakan untuk tombol "Pesan via WhatsApp".</p>
        </div>

        <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[2rem] font-bold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 flex items-center justify-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            Simpan Perubahan
        </button>
    </form>

    <div class="mb-10 mt-16">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Keamanan</h2>
        <p class="text-slate-500 font-normal mt-1">Ubah password akun admin Anda secara berkala.</p>
    </div>

    <form action="{{ route('admin.settings.password') }}" method="POST" class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-8">
        @csrf
        
        <div>
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Password Saat Ini</label>
            <input type="password" name="current_password" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-rose-500 focus:bg-white transition-all font-semibold text-slate-900 @error('current_password') border-rose-500 @enderror">
            @error('current_password')
                <p class="mt-2 text-xs text-rose-500 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Password Baru</label>
                <input type="password" name="password" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-semibold text-slate-900 @error('password') border-rose-500 @enderror">
                @error('password')
                    <p class="mt-2 text-xs text-rose-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-semibold text-slate-900">
            </div>
        </div>

        <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-bold hover:bg-black transition-all shadow-xl shadow-slate-100 flex items-center justify-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            Ubah Password
        </button>
    </form>
</div>
@endsection
