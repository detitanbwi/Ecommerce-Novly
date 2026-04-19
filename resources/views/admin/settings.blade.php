@extends('layouts.admin')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Settings</h1>
    <p class="text-slate-500 font-normal mt-1">Konfigurasi pengaturan global marketplace Anda.</p>
</div>

<div class="max-w-2xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-8">
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
</div>
@endsection
