<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Keranjang Belanja') }}
            </h2>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary mt-2 mt-md-0">
                <i class="fas fa-arrow-left"></i> Kembali Belanja
            </a>
        </div>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($carts->count() > 0)
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-shopping-cart text-primary-red"></i> 
                                    Item di Keranjang ({{ $carts->count() }})
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                @foreach($carts as $cart)
                                    <div class="border-bottom p-3 p-md-4">
                                        <div class="row align-items-center g-3">
                                            <div class="col-3 col-md-2">
                                                @if($cart->product->image)
                                                    <img src="{{ asset('storage/' . $cart->product->image) }}" 
                                                         alt="{{ $cart->product->name }}" 
                                                         class="img-fluid rounded"
                                                         loading="lazy"
                                                         style="width: 100%; max-width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 80px; height: 80px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-9 col-md-4">
                                                <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                                <small class="text-muted d-block">{{ $cart->product->category }}</small>
                                                <div class="mt-1">
                                                    <span class="badge bg-secondary">Stok: {{ $cart->product->stock }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <strong class="text-primary-red d-block">
                                                    Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                                                </strong>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <form action="{{ route('cart.update', $cart) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" 
                                                               name="quantity" 
                                                               value="{{ $cart->quantity }}" 
                                                               min="1" 
                                                               max="{{ $cart->product->stock }}"
                                                               class="form-control text-center"
                                                               onchange="this.form.submit()">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-12 col-md-2 text-end">
                                                <div class="mb-2">
                                                    <strong>Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</strong>
                                                </div>
                                                <form action="{{ route('cart.destroy', $cart) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Hapus item ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                            <div class="card-header bg-primary-red text-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-receipt"></i> Ringkasan Belanja
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal ({{ $carts->count() }} item)</span>
                                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <h5>Total</h5>
                                    <h5 class="text-primary-red">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                                </div>
                                
                                <a href="{{ route('checkout.form') }}" class="btn btn-primary-red w-100 py-3 mb-2">
                                    <i class="fas fa-shopping-bag"></i> Lanjut ke Checkout
                                </a>

                                <a href="{{ route('checkout.whatsapp') }}" class="btn btn-success w-100 py-3 mb-2">
                                    <i class="fab fa-whatsapp"></i> Checkout via WhatsApp
                                </a>
                                
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-arrow-left"></i> Lanjut Belanja
                                </a>

                                <div class="alert alert-info mt-3 mb-0">
                                    <small>
                                        <i class="fas fa-info-circle"></i> 
                                        Pilih checkout via website untuk tracking pesanan atau WhatsApp untuk respon cepat.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                        <h4 class="mb-3">Keranjang Belanja Kosong</h4>
                        <p class="text-muted mb-4">Yuk, mulai belanja produk favorit kamu!</p>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary-red btn-lg">
                            <i class="fas fa-shopping-bag"></i> Mulai Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>