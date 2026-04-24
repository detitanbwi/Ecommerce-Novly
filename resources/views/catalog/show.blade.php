@extends('layouts.catalog')

@section('title', $product->title)

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm font-medium text-slate-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition-colors">Home</a>
            <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <a href="{{ route('home', ['category' => $product->category->slug]) }}"
                class="hover:text-accent transition-colors">{{ $product->category->name }}</a>
            <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="text-accent">{{ $product->title }}</span>
        </nav>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">

            <!-- Image Gallery -->
            <div class="space-y-6">
                <div
                    class="aspect-square bg-slate-100 rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm relative">
                    <img id="main-image" src="{{ asset($product->images[0] ?? 'img/placeholder.png') }}"
                        alt="{{ $product->title }}" class="w-full h-full object-cover transition-all duration-500">
                </div>

                @if($product->images && count($product->images) > 1)
                    <div class="flex gap-4">
                        @foreach($product->images as $image)
                            <button onclick="document.getElementById('main-image').src='{{ asset($image) }}'"
                                class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-transparent focus:border-brand-800 transition-all">
                                <img src="{{ asset($image) }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <span
                        class="inline-block px-4 py-1.5 bg-accent/10 text-accent text-[11px] font-bold rounded-full uppercase tracking-widest">{{ $product->category->name }}</span>
                </div>

                <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight mb-6">{{ $product->title }}</h1>

                <div class="flex items-center mb-8">
                    <span class="text-3xl lg:text-4xl font-bold text-accent tracking-tighter">Rp
                        {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                <div class="prose prose-slate max-w-none mb-10">
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Deskripsi Produk</h3>
                    <p class="text-slate-500 leading-relaxed font-normal whitespace-pre-line text-[15px]">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4 mt-auto">
                    @php
                        $waNumber = \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '';
                        $message = "Halo Klabat Online, saya tertarik untuk memesan produk ini:\n\n*{$product->title}*\nHarga: Rp " . number_format($product->price, 0, ',', '.') . "\nLink: " . route('product.show', $product->slug ?: $product->id);
                        $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
                    @endphp

                    <a href="{{ $waLink }}" target="_blank"
                        class="flex items-center justify-center gap-3 w-full bg-accent hover:bg-accent/90 text-white font-bold py-5 rounded-2xl transition-all shadow-lg shadow-accent/20">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.031 6.172c-3.181 0-5.767 2.586-5.767 5.767 0 1.267.405 2.436 1.096 3.391l-1.082 3.104 3.303-1.066c.8.384 1.69.605 2.62.605 3.181 0 5.767-2.586 5.767-5.767 0-3.181-2.586-5.767-5.767-5.767zm3.39 8.199c-.147-.073-.871-.43-1.007-.48-.137-.048-.235-.073-.335.073-.1.147-.384.48-.47.579-.085.1-.173.111-.32.037-.147-.073-.623-.23-1.185-.732-.438-.39-.733-.871-.819-1.019-.085-.147-.009-.227.065-.301.067-.066.147-.171.221-.257.073-.085.098-.147.147-.245.048-.1.024-.185-.011-.257-.037-.073-.335-.807-.459-1.104-.121-.29-.243-.251-.335-.256-.086-.005-.185-.005-.284-.005-.1 0-.261.037-.397.185-.137.147-.52.508-.52 1.239s.533 1.436.607 1.535c.073.1 1.05 1.603 2.541 2.247.354.154.631.246.847.315.356.113.679.098.934.06.284-.043.871-.356 1.007-.7zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.168L2.054 22l4.958-1.598A9.975 9.975 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z">
                            </path>
                        </svg>
                        Pesan via WhatsApp
                    </a>

                    @if($product->external_links)
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($product->external_links as $platform => $url)
                                @if($url)
                                    <a href="{{ $url }}" target="_blank"
                                        class="flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-accent hover:text-accent text-slate-700 font-bold py-4 rounded-2xl transition-all">
                                        {{ ucfirst($platform) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection