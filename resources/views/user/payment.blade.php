<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Pembayaran Pesanan
            </h2>
        </div>
    </x-slot>

    <div class="py-12" style="background: #f8f9fa;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Order Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary-red text-white py-3">
                    <h5 class="mb-0">📋 Informasi Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p class="mb-1"><strong>No. Pesanan:</strong></p>
                            <p class="h5 text-primary-red">{{ $order->order_number }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1"><strong>Total Pembayaran:</strong></p>
                            <p class="h4 text-primary-red">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status Pesanan:</strong></p>
                            @php
                                $statusColors = ['pending' => 'warning', 'confirmed' => 'info', 'processing' => 'primary', 'shipped' => 'success', 'delivered' => 'success', 'cancelled' => 'danger'];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$order->status] }}">{{ ucfirst($order->status) }}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status Pembayaran:</strong></p>
                            @php
                                $paymentColors = ['pending' => 'warning', 'paid' => 'success', 'failed' => 'danger'];
                            @endphp
                            <span class="badge bg-{{ $paymentColors[$order->payment_status] }}">
                                {{ $order->payment_status == 'pending' ? 'Menunggu' : ($order->payment_status == 'paid' ? 'Sudah Dibayar' : 'Gagal') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bank Account Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">🏦 Informasi Rekening</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Silakan transfer ke salah satu rekening berikut:</strong>
                    </div>

                    {{-- <div class="card bg-light border-primary mb-3">
                        <div class="card-body">
                            <h6 class="text-primary mb-3">Bank BCA</h6>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-2"><strong>No. Rekening:</strong></p>
                                    <h4 class="text-primary-red mb-0">1234567890</h4>
                                </div>
                                <div class="col-6">
                                    <p class="mb-2"><strong>Atas Nama:</strong></p>
                                    <h5 class="mb-0">Mou Glowing 13</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light border-success mb-3">
                        <div class="card-body">
                            <h6 class="text-success mb-3">Bank Mandiri</h6>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-2"><strong>No. Rekening:</strong></p>
                                    <h4 class="text-primary-red mb-0">0987654321</h4>
                                </div>
                                <div class="col-6">
                                    <p class="mb-2"><strong>Atas Nama:</strong></p>
                                    <h5 class="mb-0">Mou Glowing 13</h5>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card bg-light border-info">
                        <div class="card-body">
                            <h6 class="text-info mb-3">BLU by BCA Digital</h6>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-2"><strong>No. Rekening:</strong></p>
                                    <h4 class="text-primary-red mb-0">003313331313</h4>
                                </div>
                                <div class="col-6">
                                    <p class="mb-2"><strong>Atas Nama:</strong></p>
                                    <h5 class="mb-0">Diago</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Payment Proof -->
            @if($order->payment_status == 'pending')
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">📤 Upload Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment.upload', $order) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="payment_proof" class="form-label">Pilih Foto Bukti Transfer</label>
                                <input type="file"
                                       class="form-control @error('payment_proof') is-invalid @enderror"
                                       id="payment_proof"
                                       name="payment_proof"
                                       accept="image/jpeg,image/png,image/jpg"
                                       required>
                                <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-warning">
                                <strong>⚠️ Perhatian:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Pastikan foto bukti transfer jelas dan terbaca</li>
                                    <li>Nominal transfer harus sesuai: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></li>
                                    <li>Setelah upload, admin akan melakukan verifikasi dalam 1x24 jam</li>
                                </ul>
                            </div>

                            <button type="submit" class="btn btn-primary-red w-100 py-3">
                                <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">✅ Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="alert alert-success">
                            <strong>Bukti pembayaran sudah diupload!</strong><br>
                            <small>Tanggal: {{ $order->payment_date->format('d M Y, H:i') }}</small>
                        </div>
                        @if($order->payment_proof)
                            <img src="{{ asset('storage/' . $order->payment_proof) }}"
                                 alt="Payment Proof"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px;">
                        @endif
                        <p class="text-muted mt-3">Menunggu konfirmasi admin...</p>
                    </div>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Detail Pesanan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
