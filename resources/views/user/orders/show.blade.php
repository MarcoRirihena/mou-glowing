<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Detail Pesanan #{{ $order->order_number }}
            </h2>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary mt-2 mt-md-0">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Payment Status Alert -->
                    @if($order->payment_status == 'pending')
                        <div class="alert alert-warning alert-dismissible fade show">
                            <h5><i class="fas fa-exclamation-triangle"></i> Pembayaran Belum Dilakukan</h5>
                            <p class="mb-2">Silakan lakukan pembayaran dan upload bukti transfer agar pesanan dapat diproses.</p>
                            <a href="{{ route('payment.show', $order) }}" class="btn btn-primary-red btn-sm">
                                <i class="fas fa-credit-card"></i> Bayar Sekarang
                            </a>
                        </div>
                    @elseif($order->payment_status == 'paid')
                        <div class="alert alert-success">
                            <h5><i class="fas fa-check-circle"></i> Pembayaran Sudah Diupload</h5>
                            <p class="mb-0">Bukti pembayaran telah diupload pada {{ $order->payment_date->format('d M Y, H:i') }}. Menunggu konfirmasi admin.</p>
                        </div>
                    @endif

                    <!-- Status Order -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Status Pesanan</h5>
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'confirmed' => 'info',
                                    'processing' => 'primary',
                                    'shipped' => 'success',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger'
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu Konfirmasi',
                                    'confirmed' => 'Pesanan Dikonfirmasi',
                                    'processing' => 'Sedang Diproses',
                                    'shipped' => 'Sedang Dikirim',
                                    'delivered' => 'Pesanan Selesai',
                                    'cancelled' => 'Pesanan Dibatalkan'
                                ];
                            @endphp
                            <div class="alert alert-{{ $statusColors[$order->status] }}">
                                <h4><i class="fas fa-info-circle"></i> {{ $statusLabels[$order->status] }}</h4>
                                <p class="mb-0">Tanggal: {{ $order->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Detail Produk</h5>
                        </div>
                        <div class="card-body p-0">
                            @foreach($order->items as $item)
                                <div class="border-bottom p-3 p-md-4">
                                    <div class="row align-items-center g-3">
                                        <div class="col-3 col-md-2">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                     alt="{{ $item->product_name }}" 
                                                     class="img-fluid rounded"
                                                     style="width: 100%; max-width: 80px; height: 80px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 80px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-9 col-md-5">
                                            <h6 class="mb-1">{{ $item->product_name }}</h6>
                                            <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                        </div>
                                        <div class="col-12 col-md-5 text-md-end">
                                            <strong class="text-primary-red">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Informasi Pengiriman -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Informasi Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Nama:</strong> {{ $order->name }}</p>
                            <p class="mb-2"><strong>Telepon:</strong> {{ $order->phone }}</p>
                            <p class="mb-2"><strong>Alamat:</strong> {{ $order->address }}</p>
                            <p class="mb-2"><strong>Kota:</strong> {{ $order->city }}</p>
                            <p class="mb-2"><strong>Kode Pos:</strong> {{ $order->postal_code }}</p>
                            @if($order->notes)
                                <hr>
                                <p class="mb-0"><strong>Catatan:</strong><br>{{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Ringkasan Pembayaran -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary-red text-white py-3">
                            <h5 class="mb-0">Ringkasan Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkos Kirim</span>
                                <span class="text-muted">Termasuk</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h5>Total</h5>
                                <h5 class="text-primary-red">Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                            </div>

                            @if($order->payment_status == 'pending')
                                <a href="{{ route('payment.show', $order) }}" class="btn btn-primary-red w-100 mt-3">
                                    <i class="fas fa-credit-card"></i> Bayar Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>