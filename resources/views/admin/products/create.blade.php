<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Tambah Produk Baru') }}
            </h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Form Produk Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}"
                                           placeholder="Contoh: Masker Wajah Glowing"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                            id="category" 
                                            name="category" 
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Masker Wajah" {{ old('category') == 'Masker Wajah' ? 'selected' : '' }}>Masker Wajah</option>
                                        <option value="Cream Wajah" {{ old('category') == 'Cream Wajah' ? 'selected' : '' }}>Cream Wajah</option>
                                        <option value="Kosmetik" {{ old('category') == 'Kosmetik' ? 'selected' : '' }}>Kosmetik</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Produk <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="6"
                                              placeholder="Jelaskan detail produk, manfaat, cara pakai, dll..."
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Harga & Stok -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   class="form-control @error('price') is-invalid @enderror" 
                                                   id="price" 
                                                   name="price" 
                                                   value="{{ old('price') }}"
                                                   placeholder="150000"
                                                   min="0"
                                                   step="1000"
                                                   required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   class="form-control @error('stock') is-invalid @enderror" 
                                                   id="stock" 
                                                   name="stock" 
                                                   value="{{ old('stock', 0) }}"
                                                   placeholder="100"
                                                   min="0"
                                                   required>
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Upload Gambar -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Produk</label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image"
                                           accept="image/jpeg,image/png,image/jpg"
                                           onchange="previewImage(event)">
                                    <small class="text-muted">Max 2MB (JPG, PNG)</small>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview Image -->
                                <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                                    <img id="preview" 
                                         src="" 
                                         alt="Preview" 
                                         class="img-fluid rounded"
                                         loading="lazy"
                                         style="max-height: 300px; object-fit: cover;">
                                </div>

                                <!-- Info -->
                                <div class="alert alert-info mt-3">
                                    <small>
                                        <i class="fas fa-info-circle"></i> 
                                        <strong>Tips:</strong> Gunakan gambar berkualitas tinggi dengan ukuran minimal 500x500px untuk hasil terbaik.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary-red">
                                <i class="fas fa-save"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>