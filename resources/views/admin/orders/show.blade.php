<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Detail Pesanan #{{ $order->order_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
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

            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Payment Proof Verification -->
                    @if($order->payment_proof)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">💳 Bukti Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Status Pembayaran:</strong></p>
                                    @php
                                        $paymentColors = ['pending' => 'warning', 'paid' => 'success', 'failed' => 'danger'];
                                    @endphp
                                    <span class="badge bg-{{ $paymentColors[$order->payment_status] }} mb-3">
                                        {{ $order->payment_status == 'pending' ? 'Menunggu' : ($order->payment_status == 'paid' ? 'Sudah Dibayar' : 'Gagal') }}
                                    </span>
                                    
                                    @if($order->payment_date)
                                        <p><strong>Tanggal Upload:</strong><br>{{ $order->payment_date->format('d M Y, H:i') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 text-center">
                                    <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                         alt="Payment Proof" 
                                         class="img-fluid rounded shadow"
                                         style="max-height: 300px; cursor: pointer;"
                                         onclick="window.open(this.src, '_blank')">
                                    <p class="text-muted mt-2"><small>Klik untuk memperbesar</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Update Status -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Update Status Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <select name="status" class="form-select" required>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Sedang Dikirim</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary-red w-100">
                                            <i class="fas fa-save"></i> Update Status
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Detail Customer -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Informasi Customer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1"><strong>Nama:</strong></p>
                                    <p>{{ $order->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1"><strong>Email:</strong></p>
                                    <p>{{ $order->user->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1"><strong>Telepon:</strong></p>
                                    <p>{{ $order->phone }}</p>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="fab fa-whatsapp"></i> Hubungi via WA
                                    </a>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1"><strong>Tanggal Pesanan:</strong></p>
                                    <p>{{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1"><strong>Alamat Pengiriman:</strong></p>
                                    <p>{{ $order->address }}, {{ $order->city }}, {{ $order->postal_code }}</p>
                                </div>
                                @if($order->notes)
                                    <div class="col-12">
                                        <p class="mb-1"><strong>Catatan:</strong></p>
                                        <p>{{ $order->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Detail Produk</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->product && $item->product->image)
                                                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                                 alt="{{ $item->product_name }}" 
                                                                 class="rounded me-2"
                                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                                        @endif
                                                        <div>
                                                            <strong>{{ $item->product_name }}</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Ringkasan Pembayaran -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary-red text-white py-3">
                            <h5 class="mb-0">Ringkasan</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <h5>Total</h5>
                                <h5 class="text-primary-red">Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                            </div>
                            <div class="alert alert-info mb-0">
                                <small>
                                    <i class="fas fa-info-circle"></i> 
                                    Status: <strong>{{ ucfirst($order->status) }}</strong><br>
                                    Pembayaran: <strong>{{ ucfirst($order->payment_status) }}</strong>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>