<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Detail Produk') }}
            </h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded shadow-sm"
                                     loading="lazy"
                                     style="width: 100%; max-height: 500px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 400px;">
                                    <i class="fas fa-image fa-5x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="mb-4">
                                <span class="badge bg-secondary mb-2">{{ $product->category }}</span>
                                <h2 class="mb-3">{{ $product->name }}</h2>
                                <h3 class="text-primary-red mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Deskripsi Produk</h5>
                                <p class="text-muted" style="white-space: pre-line;">{{ $product->description }}</p>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="text-muted mb-2">Stok Tersedia</h6>
                                            @if($product->stock > 0)
                                                <h4 class="text-success mb-0">
                                                    <i class="fas fa-check-circle"></i> {{ $product->stock }} pcs
                                                </h4>
                                            @else
                                                <h4 class="text-danger mb-0">
                                                    <i class="fas fa-times-circle"></i> Habis
                                                </h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="text-muted mb-2">Ditambahkan</h6>
                                            <h6 class="mb-0">{{ $product->created_at->format('d M Y') }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning text-white">
                                    <i class="fas fa-edit"></i> Edit Produk
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus Produk
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>