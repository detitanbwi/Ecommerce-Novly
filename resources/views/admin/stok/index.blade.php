@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Stok Produk</h1>
        <p class="text-slate-500 font-normal mt-1">Kelola inventaris marketplace Anda di sini.</p>
    </div>
    <a href="{{ route('admin.stok.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
        Tambah Produk
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-200">
                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Produk</th>
                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Harga</th>
                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($products as $product)
            <tr class="hover:bg-slate-50/30 transition-colors">
                <td class="px-8 py-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset($product->images[0]) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <span class="font-bold text-slate-900">{{ $product->title }}</span>
                    </div>
                </td>
                <td class="px-8 py-5">
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-md uppercase tracking-wider">{{ $product->category->name }}</span>
                </td>
                <td class="px-8 py-5 font-semibold text-slate-700">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </td>
                <td class="px-8 py-5">
                    @if($product->is_active)
                        <span class="flex items-center gap-1.5 text-emerald-600 font-bold text-xs uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif
                        </span>
                    @else
                        <span class="flex items-center gap-1.5 text-slate-400 font-bold text-xs uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-slate-300"></span> Nonaktif
                        </span>
                    @endif
                </td>
                <td class="px-8 py-5 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.stok.edit', $product->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.stok.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-20 text-center text-slate-400 font-medium italic">Belum ada produk yang didaftarkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($products->hasPages())
    <div class="px-8 py-5 border-t border-slate-100 bg-slate-50/30">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
