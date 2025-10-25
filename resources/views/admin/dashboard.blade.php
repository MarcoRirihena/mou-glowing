<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #DC143C 0%, #b01030 100%);">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-2">Total Produk</h6>
                                    <h2 class="mb-0">{{ $totalProducts }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-box fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-2">Total Stok</h6>
                                    <h2 class="mb-0">{{ $totalStock }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-boxes fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20873a 100%);">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-2">Total Pesanan</h6>
                                    <h2 class="mb-0">{{ $totalOrders }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-2">Pending</h6>
                                    <h2 class="mb-0">{{ $pendingOrders }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-clock fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">📊 Statistik Penjualan (7 Hari Terakhir)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">📦 Status Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders & Top Products -->
            <div class="row g-4 mb-4">
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">🔥 Produk Terlaris</h5>
                        </div>
                        <div class="card-body">
                            @if($topProducts->count() > 0)
                                @foreach($topProducts as $product)
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <div class="me-3">
                                            @if($product->product->image)
                                                <img src="{{ asset('storage/' . $product->product->image) }}" 
                                                     alt="{{ $product->product->name }}"
                                                     class="rounded"
                                                     loading="lazy"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded" style="width: 50px; height: 50px;"></div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $product->product->name }}</h6>
                                            <small class="text-muted">{{ $product->total_sold }} terjual</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-success">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center">Belum ada data penjualan</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">🕒 Pesanan Terbaru</h5>
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            @if($recentOrders->count() > 0)
                                @foreach($recentOrders as $order)
                                    <div class="mb-3 pb-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{{ $order->order_number }}</strong><br>
                                                <small class="text-muted">{{ $order->user->name }}</small>
                                            </div>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'confirmed' => 'info',
                                                    'processing' => 'primary',
                                                    'shipped' => 'success',
                                                    'delivered' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$order->status] }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small><br>
                                            <strong class="text-primary-red">Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center">Belum ada pesanan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">⚡ Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('products.create') }}" class="btn btn-primary-red w-100 py-3">
                                <i class="fas fa-plus-circle me-2"></i>
                                Tambah Produk Baru
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-dark w-100 py-3">
                                <i class="fas fa-list me-2"></i>
                                Lihat Semua Produk
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-receipt me-2"></i>
                                Lihat Pesanan
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="/" class="btn btn-outline-secondary w-100 py-3">
                                <i class="fas fa-home me-2"></i>
                                Ke Landing Page
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Sales Chart (7 days)
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesDates) !!},
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: {!! json_encode($salesData) !!},
                    borderColor: '#DC143C',
                    backgroundColor: 'rgba(220, 20, 60, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Order Status Chart (Pie)
        const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($orderStatusLabels) !!},
                datasets: [{
                    data: {!! json_encode($orderStatusData) !!},
                    backgroundColor: [
                        '#ffc107',
                        '#17a2b8',
                        '#007bff',
                        '#28a745',
                        '#28a745',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>