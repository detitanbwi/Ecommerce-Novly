@extends('layouts.catalog')

@section('title', 'Semua Produk')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-3">Belanja Jadi Lebih <span
                class="text-accent">Mudah</span></h1>
        <p class="text-lg font-normal text-slate-600 leading-relaxed max-w-2xl">Pilih produk fisik atau digital, konfirmasi via WhatsApp, dan selesai dalam hitungan menit tanpa perlu daftar akun.</p>
    </div>

    <!-- Category Filter -->
    <div class="flex items-center gap-3 mb-10 overflow-x-auto pb-2 scrollbar-hide" id="category-filters">
        <a href="?category=" data-slug=""
            class="category-btn whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-all {{ !request('category') ? 'bg-accent text-white shadow-md' : 'bg-white text-slate-800 border border-slate-200 hover:border-accent hover:text-accent' }}">
            Semua
        </a>
        @foreach(\App\Models\Category::all() as $category)
            <a href="?category={{ $category->slug }}" data-slug="{{ $category->slug }}"
                class="category-btn whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-all {{ request('category') == $category->slug ? 'bg-accent text-white shadow-md' : 'bg-white text-slate-800 border border-slate-200 hover:border-accent hover:text-accent' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div id="product-section" class="transition-opacity duration-300">
        <!-- Product Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 md:gap-x-8 gap-y-8 md:gap-y-12">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl md:rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-700 overflow-hidden group flex flex-col relative">
                    <!-- Image Slideshow Container -->
                    <div class="aspect-[4/5] bg-slate-100 overflow-hidden relative">
                        @if($product->images && count($product->images) > 0)
                            <div class="flex h-full w-full transition-transform duration-700 products-slideshow"
                                id="slideshow-{{ $product->id }}">
                                @foreach(array_slice($product->images, 0, 3) as $image)
                                    <img src="{{ asset($image) }}" alt="{{ $product->title }}" class="object-cover min-w-full h-full">
                                @endforeach
                            </div>

                            @if(count($product->images) > 1)
                                <!-- Slideshow Dots -->
                                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                                    @foreach(array_slice($product->images, 0, 3) as $index => $image)
                                        <div class="w-1.5 h-1.5 rounded-full bg-white/50 shadow-sm slideshow-dot-{{ $product->id }} {{ $index === 0 ? 'bg-white scale-125' : '' }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="flex items-center justify-center w-full h-full text-slate-300 font-medium">No Image</div>
                        @endif
                    </div>

                    <!-- Info Container -->
                    <div class="px-4 pb-5 pt-3 md:px-7 md:pb-7 flex flex-col flex-1">
                        <div class="mb-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-2 py-0.5 rounded-md">
                                {{ $product->category->name }}
                            </span>
                        </div>

                        <h3 class="text-sm md:text-base font-semibold text-slate-800 leading-tight mb-1 group-hover:text-accent transition-colors line-clamp-2">
                            {{ $product->title }}
                        </h3>

                        <div class="mt-auto pt-2">
                            <span class="text-base md:text-lg font-bold text-accent tracking-tight">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('product.show', $product->slug ?: $product->id) }}" class="absolute inset-0"></a>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="bg-slate-50 inline-flex p-6 rounded-full mb-4">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-slate-500 max-w-xs mx-auto">Maaf, kami tidak dapat menemukan produk yang Anda cari. Coba kata kunci atau kategori lain.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-6 text-accent font-bold hover:underline">Lihat Semua Produk</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center ajax-pagination">
            {{ $products->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSection = document.getElementById('product-section');
            const categoryFilters = document.getElementById('category-filters');

            // Simple Auto-Slideshow Handler
            function initSlideshows() {
                const slideshows = document.querySelectorAll('.products-slideshow');
                slideshows.forEach(container => {
                    const id = container.id.split('-')[1];
                    const imgs = container.querySelectorAll('img');
                    if (imgs.length <= 1) return;

                    const dots = document.querySelectorAll(`.slideshow-dot-${id}`);
                    let current = 0;

                    if (container.dataset.interval) clearInterval(container.dataset.interval);

                    const interval = setInterval(() => {
                        current = (current + 1) % imgs.length;
                        container.style.transform = `translateX(-${current * 100}%)`;

                        dots.forEach((dot, idx) => {
                            if (idx === current) {
                                dot.classList.add('bg-white', 'scale-125');
                                dot.classList.remove('bg-white/40');
                            } else {
                                dot.classList.remove('bg-white', 'scale-125');
                                dot.classList.add('bg-white/40');
                            }
                        });
                    }, 3500 + Math.random() * 1000); // Varied timing for natural feel

                    container.dataset.interval = interval;
                });
            }

            function loadSection(url) {
                productSection.style.opacity = '0.5';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.getElementById('product-section').innerHTML;

                        productSection.innerHTML = newContent;
                        productSection.style.opacity = '1';

                        window.history.pushState({}, '', url);
                        updateActiveButton(url);
                        bindPagination();
                        initSlideshows(); // Re-init
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    })
                    .catch(err => {
                        console.error('Error loading section:', err);
                        productSection.style.opacity = '1';
                    });
            }

            function updateActiveButton(url) {
                const params = new URLSearchParams(new URL(url).search);
                const currentCategory = params.get('category') || '';

                document.querySelectorAll('.category-btn').forEach(btn => {
                    const btnSlug = btn.getAttribute('data-slug');
                    if (btnSlug === currentCategory) {
                        btn.classList.add('bg-accent', 'text-white', 'shadow-md');
                        btn.classList.remove('bg-white', 'text-slate-800', 'border', 'border-slate-200', 'hover:border-accent', 'hover:text-accent');
                    } else {
                        btn.classList.remove('bg-accent', 'text-white', 'shadow-md');
                        btn.classList.add('bg-white', 'text-slate-800', 'border', 'border-slate-200', 'hover:border-accent', 'hover:text-accent');
                    }
                });
            }

            function bindPagination() {
                document.querySelectorAll('.ajax-pagination a').forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        loadSection(this.href);
                    });
                });
            }

            categoryFilters.addEventListener('click', function (e) {
                const link = e.target.closest('.category-btn');
                if (link) {
                    e.preventDefault();
                    loadSection(link.href);
                }
            });

            bindPagination();
            initSlideshows();
        });
    </script>

@endsection