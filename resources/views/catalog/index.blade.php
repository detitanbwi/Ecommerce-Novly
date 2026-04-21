@extends('layouts.catalog')

@section('title', 'Semua Produk')

@section('content')
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-slate-900 tracking-tight mb-3">Belanja Jadi Lebih <span
                class="text-indigo-600">Mudah</span></h1>
        <p class="text-lg font-normal text-slate-500 leading-relaxed max-w-2xl">Pilih produk fisik atau digital, konfirmasi via WhatsApp, dan selesai dalam hitungan menit tanpa perlu daftar akun.</p>
    </div>

    <!-- Category Filter -->
    <div class="flex items-center gap-3 mb-10 overflow-x-auto pb-2 scrollbar-hide" id="category-filters">
        <a href="?category=" data-slug=""
            class="category-btn whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-slate-800 border border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }}">
            Semua
        </a>
        @foreach(\App\Models\Category::all() as $category)
            <a href="?category={{ $category->slug }}" data-slug="{{ $category->slug }}"
                class="category-btn whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-all {{ request('category') == $category->slug ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-slate-800 border border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div id="product-section" class="transition-opacity duration-300">
        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-12">
            @forelse($products as $product)
                <a href="{{ route('product.show', $product->slug ?: $product->id) }}" class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-700 overflow-hidden group flex flex-col relative">

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
                                        <div
                                            class="w-1.5 h-1.5 rounded-full bg-white/50 shadow-sm slideshow-dot-{{ $product->id }} {{ $index === 0 ? 'bg-white scale-125' : '' }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="flex items-center justify-center w-full h-full text-slate-300 font-medium">No Image</div>
                        @endif
                    </div>

                    <!-- Info Container -->
                    <div class="px-7 pb-7 pt-3 flex flex-col flex-1">
                        @php
                            $badgeClasses = [
                                'books' => 'bg-blue-100 text-blue-700',
                                'property' => 'bg-orange-100 text-orange-700',
                                'digital-invitations' => 'bg-purple-100 text-purple-700',
                                'chicken-coops' => 'bg-slate-100 text-slate-600',
                            ];
                            $currentBadge = $badgeClasses[$product->category->slug] ?? 'bg-slate-100 text-slate-600';
                        @endphp

                        <div class="mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $currentBadge }}">
                                {{ $product->category->name }}
                            </span>
                        </div>

                        <h3
                            class="text-base font-semibold text-slate-800 leading-tight mb-1 group-hover:text-indigo-600 transition-colors">
                            {{ $product->title }}</h3>

                        <div class="mt-auto pt-2">
                            <span class="text-lg font-bold text-indigo-600 tracking-tight">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-32 bg-white rounded-3xl border border-dotted border-slate-200">
                    <p class="text-slate-400 text-lg font-medium">Belum ada produk untuk kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center ajax-pagination">
            {{ $products->appends(['category' => request('category')])->links('pagination::tailwind') }}
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
                        btn.classList.add('bg-indigo-600', 'text-white', 'shadow-md');
                        btn.classList.remove('bg-white', 'text-slate-800', 'border', 'border-slate-200');
                    } else {
                        btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md');
                        btn.classList.add('bg-white', 'text-slate-800', 'border', 'border-slate-200');
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