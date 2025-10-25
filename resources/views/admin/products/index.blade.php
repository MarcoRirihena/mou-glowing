<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Manajemen Produk') }}
            </h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary-red">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Daftar Produk</h5>
                </div>
                <div class="card-body">
                    @if($products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                @if($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="rounded"
                                                         loading="lazy"
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $product->name }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $product->category }}</span>
                                            </td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>
                                                @if($product->stock > 0)
                                                    <span class="badge bg-success">{{ $product->stock }} pcs</span>
                                                @else
                                                    <span class="badge bg-danger">Habis</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('products.show', $product) }}" 
                                                       class="btn btn-sm btn-info text-white">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('products.edit', $product) }}" 
                                                       class="btn btn-sm btn-warning text-white">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('products.destroy', $product) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada produk</h5>
                            <p class="text-muted mb-4">Mulai tambahkan produk pertama Anda!</p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary-red">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>