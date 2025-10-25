<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Edit Produk') }}
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
                    <h5 class="mb-0">Edit: {{ $product->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $product->name) }}"
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
                                        <option value="Facial Wash" {{ old('category', $product->category) == 'Facial Wash' ? 'selected' : '' }}>Facial Wash</option>
                                        <option value="Facial Toner" {{ old('category', $product->category) == 'Facial Toner' ? 'selected' : '' }}>Facial Toner</option>
                                        <option value="Serum" {{ old('category', $product->category) == 'Serum' ? 'selected' : '' }}>Serum</option>
                                        <option value="Moisturizer" {{ old('category', $product->category) == 'Moisturizer' ? 'selected' : '' }}>Moisturizer</option>
                                        <option value="Sunscreen" {{ old('category', $product->category) == 'Sunscreen' ? 'selected' : '' }}>Sunscreen</option>
                                        <option value="Masker Wajah" {{ old('category', $product->category) == 'Masker Wajah' ? 'selected' : '' }}>Masker Wajah</option>
                                        <option value="Eye Cream" {{ old('category', $product->category) == 'Eye Cream' ? 'selected' : '' }}>Eye Cream</option>
                                        <option value="Lip Care" {{ old('category', $product->category) == 'Lip Care' ? 'selected' : '' }}>Lip Care</option>
                                        <option value="Makeup" {{ old('category', $product->category) == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                                        <option value="Body Care" {{ old('category', $product->category) == 'Body Care' ? 'selected' : '' }}>Body Care</option>
                                        <option value="Hair Care" {{ old('category', $product->category) == 'Hair Care' ? 'selected' : '' }}>Hair Care</option>
                                        <option value="Lainnya" {{ old('category', $product->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                              required>{{ old('description', $product->description) }}</textarea>
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
                                                   value="{{ old('price', $product->price) }}"
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
                                                   value="{{ old('stock', $product->stock) }}"
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
                                <!-- Gambar Saat Ini -->
                                @if($product->image)
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid rounded"
                                             loading="lazy"
                                             style="max-height: 250px; object-fit: cover;">
                                    </div>
                                @endif

                                <!-- Upload Gambar Baru -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Ganti Gambar</label>
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

                                <!-- Preview Image Baru -->
                                <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                                    <label class="form-label">Preview Gambar Baru</label>
                                    <img id="preview" 
                                         src="" 
                                         alt="Preview" 
                                         class="img-fluid rounded"
                                         style="max-height: 250px; object-fit: cover;">
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
                                <i class="fas fa-save"></i> Update Produk
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