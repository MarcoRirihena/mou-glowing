<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Produk') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Welcome Banner -->
            <div class="card border-0 shadow-sm mb-4"
                 style="background: linear-gradient(135deg, #DC143C 0%, #b01030 100%);">
                <div class="card-body text-white text-center py-5">
                    <h3 class="mb-2">Selamat Datang di Mou Glowing 13! 💄</h3>
                    <p class="mb-0">Temukan produk skincare terbaik untuk kecantikan Anda</p>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('user.dashboard') }}" method="GET" id="filterForm">
                        <div class="row g-3">
                            <!-- Search Box -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text"
                                           name="search"
                                           class="form-control"
                                           placeholder="Cari produk..."
                                           value="{{ request('search') }}"
                                           onchange="document.getElementById('filterForm').submit()">
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-4">
                                <select name="category" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Kategori</option>
                                    <option value="Facial Wash" {{ request('category') == 'Facial Wash' ? 'selected' : '' }}>Facial Wash</option>
                                    <option value="Facial Toner" {{ request('category') == 'Facial Toner' ? 'selected' : '' }}>Facial Toner</option>
                                    <option value="Serum" {{ request('category') == 'Serum' ? 'selected' : '' }}>Serum</option>
                                    <option value="Moisturizer" {{ request('category') == 'Moisturizer' ? 'selected' : '' }}>Moisturizer</option>
                                    <option value="Sunscreen" {{ request('category') == 'Sunscreen' ? 'selected' : '' }}>Sunscreen</option>
                                    <option value="Masker Wajah" {{ request('category') == 'Masker Wajah' ? 'selected' : '' }}>Masker Wajah</option>
                                    <option value="Eye Cream" {{ request('category') == 'Eye Cream' ? 'selected' : '' }}>Eye Cream</option>
                                    <option value="Lip Care" {{ request('category') == 'Lip Care' ? 'selected' : '' }}>Lip Care</option>
                                    <option value="Makeup" {{ request('category') == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                                    <option value="Body Care" {{ request('category') == 'Body Care' ? 'selected' : '' }}>Body Care</option>
                                    <option value="Hair Care" {{ request('category') == 'Hair Care' ? 'selected' : '' }}>Hair Care</option>
                                    <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <!-- Filter Button -->
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary-red w-100">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>

                        @if(request('search') || request('category'))
                            <div class="mt-3">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-times"></i> Reset Filter
                                </a>
                                <span class="text-muted ms-2">
                                    Menampilkan hasil untuk:
                                    @if(request('search'))
                                        <strong>"{{ request('search') }}"</strong>
                                    @endif
                                    @if(request('category'))
                                        <strong>{{ request('category') }}</strong>
                                    @endif
                                </span>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100"
                                 style="transition: all 0.3s; cursor: pointer;"
                                 onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 10px 30px rgba(220,20,60,0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">

                                <!-- Product Image -->
                                <div style="height: 250px; overflow: hidden; border-radius: 8px 8px 0 0; position: relative;">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="card-img-top"
                                             loading="lazy"
                                             style="height: 100%; width: 100%; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                             style="height: 100%;">
                                            <i class="fas fa-image fa-4x text-muted"></i>
                                        </div>
                                    @endif

                                    <!-- Badge Kategori -->
                                    <span class="badge bg-dark position-absolute top-0 start-0 m-3">
                                        {{ $product->category }}
                                    </span>

                                    <!-- Badge Stok -->
                                    @if($product->stock > 0)
                                        <span class="badge bg-success position-absolute top-0 end-0 m-3">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">
                                            Habis
                                        </span>
                                    @endif
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                    <p class="card-text text-muted small flex-grow-1"
                                       style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $product->description }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <h4 class="text-primary-red mb-0">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </h4>
                                        <span class="text-muted small">
                                            <i class="fas fa-box"></i> {{ $product->stock }} pcs
                                        </span>
                                    </div>

                                    <!-- Add to Cart Button -->
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-primary-red w-100 mt-3" 
                                                @if($product->stock == 0) disabled @endif>
                                            <i class="fas fa-cart-plus"></i> 
                                            {{ $product->stock > 0 ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">
                            @if(request('search') || request('category'))
                                Produk tidak ditemukan
                            @else
                                Belum ada produk tersedia
                            @endif
                        </h5>
                        <p class="text-muted">
                            @if(request('search') || request('category'))
                                Coba kata kunci atau kategori lain
                            @else
                                Silakan cek kembali nanti!
                            @endif
                        </p>
                        @if(request('search') || request('category'))
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary-red mt-3">
                                <i class="fas fa-arrow-left"></i> Lihat Semua Produk
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>