<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Checkout') }}
            </h2>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <!-- Form Informasi Pengiriman -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-shipping-fast text-primary-red"></i> 
                                    Informasi Pengiriman
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', auth()->user()->name) }}"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="phone" class="form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                                        <input type="tel" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone') }}"
                                               placeholder="Contoh: 081234567890"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" 
                                                  name="address" 
                                                  rows="3"
                                                  placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan"
                                                  required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('city') is-invalid @enderror" 
                                               id="city" 
                                               name="city" 
                                               value="{{ old('city') }}"
                                               placeholder="Contoh: Jakarta"
                                               required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="postal_code" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('postal_code') is-invalid @enderror" 
                                               id="postal_code" 
                                               name="postal_code" 
                                               value="{{ old('postal_code') }}"
                                               placeholder="Contoh: 12345"
                                               required>
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                                  id="notes" 
                                                  name="notes" 
                                                  rows="2"
                                                  placeholder="Catatan tambahan untuk pengiriman...">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Produk -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-box text-primary-red"></i> 
                                    Detail Pesanan
                                </h5>
                            </div>
                            <div class="card-body">
                                @foreach($carts as $cart)
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <div class="me-3">
                                            @if($cart->product->image)
                                                <img src="{{ asset('storage/' . $cart->product->image) }}" 
                                                     alt="{{ $cart->product->name }}" 
                                                     class="rounded"
                                                     loading="lazy"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded" style="width: 60px; height: 60px;"></div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                            <small class="text-muted">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</small>
                                        </div>
                                        <div>
                                            <strong>Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Summary & Submit -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                            <div class="card-header bg-primary-red text-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-receipt"></i> Ringkasan Pesanan
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim</span>
                                    <span class="text-muted">Dihitung saat konfirmasi</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <h5>Total</h5>
                                    <h5 class="text-primary-red">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                                </div>

                                <button type="submit" class="btn btn-primary-red w-100 py-3 mb-3">
                                    <i class="fas fa-check-circle"></i> Buat Pesanan
                                </button>

                                {{-- <a href="{{ route('checkout.whatsapp') }}" class="btn btn-success w-100 py-3">
                                    <i class="fab fa-whatsapp"></i> Checkout via WhatsApp
                                </a> --}}

                                <div class="alert alert-info mt-3 mb-0">
                                    <small>
                                        <i class="fas fa-info-circle"></i> 
                                        Pesanan akan dikonfirmasi oleh admin dalam 1x24 jam.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>