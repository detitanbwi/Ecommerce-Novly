@extends('layouts.admin')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.stok') }}" class="flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Produk: {{ $product->title }}</h1>

    @if ($errors->any())
        <div class="mt-6 p-6 bg-rose-50 border border-rose-100 rounded-3xl">
            <div class="flex items-center gap-3 text-rose-600 font-bold mb-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Ada kesalahan pada input Anda:
            </div>
            <ul class="list-disc list-inside text-sm text-rose-500 space-y-1 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<form action="{{ route('admin.stok.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    @csrf
    @method('PUT')
    
    <!-- Left Column: Primary Details -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-6">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Judul Produk</label>
                <input type="text" name="title" required value="{{ old('title', $product->title) }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-semibold text-slate-900">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Deskripsi Produk</label>
                <textarea name="description" required rows="6" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-medium text-slate-700 leading-relaxed">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Kategori</label>
                    <select name="category_id" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-semibold text-slate-900 appearance-none">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Harga (IDR)</label>
                    <input type="number" name="price" required value="{{ old('price', $product->price) }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-semibold text-slate-900">
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-900">Marketplace & External Links</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Link Shopee (Opsional)</label>
                    <input type="url" name="external_links[shopee]" value="{{ old('external_links.shopee', $product->external_links['shopee'] ?? '') }}" placeholder="https://shopee.co.id/..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-medium text-slate-700">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Link Tokopedia (Opsional)</label>
                    <input type="url" name="external_links[tokopedia]" value="{{ old('external_links.tokopedia', $product->external_links['tokopedia'] ?? '') }}" placeholder="https://tokopedia.com/..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-medium text-slate-700">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Link Marketplace Lainnya (Opsional)</label>
                    <input type="url" name="external_links[others]" value="{{ old('external_links.others', $product->external_links['others'] ?? '') }}" placeholder="https://..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-medium text-slate-700">
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="space-y-8">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm space-y-6">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Edit Foto Produk (Max 3)</label>
                <div class="grid grid-cols-3 gap-4" id="image-slots">
                    @for($i = 0; $i < 3; $i++)
                        @php $existingImage = $product->images[$i] ?? null; @endphp
                        <div class="relative aspect-square group">
                            <!-- Slot Empty -->
                            <div id="slot-empty-{{ $i }}" onclick="document.getElementById('input-{{ $i }}').click()" class="{{ $existingImage ? 'hidden' : '' }} w-full h-full border-2 border-dashed border-slate-200 rounded-3xl flex flex-col items-center justify-center text-slate-400 hover:border-indigo-400 hover:text-indigo-500 transition-all cursor-pointer bg-slate-50/50">
                                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Upload</span>
                            </div>
                            
                            <!-- Slot Filled -->
                            <div id="slot-filled-{{ $i }}" class="{{ $existingImage ? '' : 'hidden' }} w-full h-full rounded-3xl overflow-hidden border border-slate-200 bg-slate-100 relative">
                                <img id="preview-{{ $i }}" src="{{ $existingImage ? asset($existingImage) : '' }}" class="w-full h-full object-cover">
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                    <button type="button" onclick="previewLarge({{ $i }})" class="p-2.5 bg-white text-indigo-600 rounded-full hover:scale-110 transition-transform shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button type="button" onclick="removeImage({{ $i }})" class="p-2.5 bg-rose-500 text-white rounded-full hover:scale-110 transition-transform shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>
                            
                            <input type="file" name="images[{{ $i }}]" id="input-{{ $i }}" class="hidden" accept="image/*" onchange="handleImage(this, {{ $i }})">
                            <!-- Field used to track existing images if not changed -->
                            <input type="hidden" name="existing_images[{{ $i }}]" id="existing-{{ $i }}" value="{{ $existingImage }}">
                        </div>
                    @endfor
                </div>
                <p class="mt-4 text-[11px] text-slate-400 leading-tight italic">Maksimal 3 foto. Gambar baru akan otomatis dioptimasi agar ringan.</p>
            </div>

            <!-- Preview Modal -->
            <div id="preview-modal" class="fixed inset-0 z-[100] hidden bg-slate-900/90 backdrop-blur-sm flex items-center justify-center p-10 cursor-zoom-out" onclick="closePreview()">
                <div class="relative max-w-4xl max-h-full">
                    <img id="modal-image" class="rounded-[2.5rem] shadow-2xl max-h-full mx-auto shadow-indigo-500/20">
                    <button type="button" class="absolute -top-12 right-0 text-white flex items-center gap-2 font-bold hover:text-indigo-400 transition-colors">
                        Tutup [ESC]
                    </button>
                </div>
            </div>

            <script>
                function handleImage(input, index) {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('preview-' + index).src = e.target.result;
                            document.getElementById('slot-empty-' + index).classList.add('hidden');
                            document.getElementById('slot-filled-' + index).classList.remove('hidden');
                            document.getElementById('existing-' + index).value = ''; // Clear existing marker
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                function removeImage(index) {
                    const input = document.getElementById('input-' + index);
                    input.value = ''; 
                    document.getElementById('slot-empty-' + index).classList.remove('hidden');
                    document.getElementById('slot-filled-' + index).classList.add('hidden');
                    document.getElementById('existing-' + index).value = ''; // Remove from save list
                }

                function previewLarge(index) {
                    const src = document.getElementById('preview-' + index).src;
                    document.getElementById('modal-image').src = src;
                    document.getElementById('preview-modal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closePreview() {
                    document.getElementById('preview-modal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') closePreview();
                });
            </script>

            <div class="pt-6 border-t border-slate-50">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-200 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">Aktifkan di Katalog</span>
                </label>
            </div>
        </div>

        <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[2rem] font-bold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            Perbarui Produk
        </button>
    </div>
</form>
@endsection
