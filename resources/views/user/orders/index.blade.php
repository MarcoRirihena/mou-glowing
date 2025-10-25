<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($orders->count() > 0)
                <div class="row g-4">
                    @foreach($orders as $order)
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-3">
                                            <small class="text-muted d-block">No. Pesanan</small>
                                            <strong>{{ $order->order_number }}</strong>
                                            <div class="mt-1">
                                                <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <small class="text-muted d-block">Status</small>
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
                                                    'pending' => 'Menunggu',
                                                    'confirmed' => 'Dikonfirmasi',
                                                    'processing' => 'Diproses',
                                                    'shipped' => 'Dikirim',
                                                    'delivered' => 'Selesai',
                                                    'cancelled' => 'Dibatalkan'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$order->status] }}">
                                                {{ $statusLabels[$order->status] }}
                                            </span>
                                        </div>
                                        <div class="col-md-2">
                                            <small class="text-muted d-block">Total Items</small>
                                            <strong>{{ $order->items->count() }} produk</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block">Total Bayar</small>
                                            <h5 class="text-primary-red mb-0">Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary-red">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-receipt fa-5x text-muted mb-4"></i>
                        <h4 class="mb-3">Belum Ada Pesanan</h4>
                        <p class="text-muted mb-4">Yuk, mulai belanja dan buat pesanan pertama kamu!</p>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary-red btn-lg">
                            <i class="fas fa-shopping-bag"></i> Mulai Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>