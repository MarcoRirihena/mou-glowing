<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Berhasil') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <h2 class="mb-3">Pesanan Berhasil Dibuat!</h2>
                    <p class="text-muted mb-4">Terima kasih telah berbelanja di Mou Glowing 13</p>

                    <div class="alert alert-success">
                        <h5>No. Pesanan: <strong>{{ $order->order_number }}</strong></h5>
                        <p class="mb-0">Status: <span class="badge bg-warning">{{ ucfirst($order->status) }}</span></p>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body text-start">
                            <h6 class="mb-3">Detail Pengiriman:</h6>
                            <p class="mb-1"><strong>Nama:</strong> {{ $order->name }}</p>
                            <p class="mb-1"><strong>Telepon:</strong> {{ $order->phone }}</p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->postal_code }}</p>
                            @if($order->notes)
                                <p class="mb-0"><strong>Catatan:</strong> {{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-credit-card"></i>
                        <strong>Langkah Selanjutnya:</strong> Silakan lakukan pembayaran dan upload bukti transfer!
                    </div>

                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('payment.show', $order) }}" class="btn btn-primary-red btn-lg">
                            <i class="fas fa-credit-card"></i> Lanjut ke Pembayaran
                        </a>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-dark">
                            <i class="fas fa-eye"></i> Lihat Detail Pesanan
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home"></i> Kembali Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>