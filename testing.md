# 🧪 Testing Use Cases - Mou Glowing 13

## Admin Testing

### ✅ Login Admin
1. Buka `/login`
2. Email: `admin@mouglowing.com`
3. Password: `AdminMouGlowing2024!`
4. Klik Login
5. **Expected:** Redirect ke `/admin/dashboard`

### ✅ Dashboard Admin
1. Login sebagai admin
2. **Expected:** 
   - Muncul 4 statistik cards (Total Produk, Stok, Pesanan, Pending)
   - Chart penjualan 7 hari
   - Pie chart status order
   - Top products list
   - Recent orders

### ✅ CRUD Produk

**Create:**
1. Dashboard > "Tambah Produk Baru"
2. Isi form:
   - Nama: Test Masker Glowing
   - Kategori: Masker Wajah
   - Deskripsi: Test deskripsi produk
   - Harga: 150000
   - Stok: 50
   - Upload gambar (max 2MB, JPG/PNG)
3. Klik "Simpan Produk"
4. **Expected:** Success message, redirect ke products list

**Read:**
1. Menu "Produk" > Lihat list produk
2. **Expected:** Tabel produk dengan gambar, nama, kategori, harga, stok
3. Klik icon mata (eye) untuk detail
4. **Expected:** Halaman detail produk lengkap

**Update:**
1. List produk > Klik icon edit (pencil)
2. Ubah data (misal: harga jadi 175000)
3. Klik "Update Produk"
4. **Expected:** Success message, data ter-update

**Delete:**
1. List produk > Klik icon trash
2. Confirm dialog muncul
3. Klik OK
4. **Expected:** Produk terhapus, success message

### ✅ Manajemen Order
1. Menu "Pesanan"
2. **Expected:** List semua pesanan dari customer
3. Klik "Detail" pada order
4. **Expected:** 
   - Info customer lengkap
   - Bukti pembayaran (jika ada)
   - List produk yang dibeli
   - Form update status
5. Update status dari "Pending" ke "Confirmed"
6. **Expected:** Success message

### ✅ Verifikasi Pembayaran
1. Order dengan payment proof uploaded
2. Klik gambar bukti pembayaran
3. **Expected:** Gambar membesar di tab baru
4. Validasi pembayaran
5. Update status jika valid

---

## User Testing

### ✅ Register User
1. Buka `/register`
2. Isi form:
   - Name: Test Customer
   - Email: customer@test.com
   - Password: Test123456
   - Confirm Password: Test123456
3. Klik "Register"
4. **Expected:** 
   - Redirect ke `/user/dashboard`
   - Welcome message (jika email aktif)

### ✅ Login User
1. Buka `/login`
2. Email: customer@test.com
3. Password: Test123456
4. Klik Login
5. **Expected:** Redirect ke `/user/dashboard`

### ✅ Browse Produk
1. Login sebagai user
2. Dashboard menampilkan katalog produk
3. **Expected:**
   - Grid 3 kolom di desktop
   - Search box berfungsi
   - Filter kategori berfungsi
   - Hover effect pada card produk

### ✅ Search & Filter
1. Ketik "masker" di search box
2. **Expected:** Otomatis filter produk dengan kata "masker"
3. Pilih kategori "Cream Wajah"
4. **Expected:** Otomatis filter produk kategori cream
5. Klik "Reset Filter"
6. **Expected:** Kembali tampil semua produk

### ✅ Add to Cart
1. Browse produk
2. Klik "Tambah ke Keranjang"
3. **Expected:** 
   - Success message
   - Badge di menu "Keranjang" bertambah
4. Tambah produk lain
5. Badge counter update

### ✅ Manage Cart
1. Menu "Keranjang"
2. **Expected:** List produk di cart
3. Ubah quantity produk
4. **Expected:** Auto-submit, total update
5. Klik icon trash untuk hapus item
6. **Expected:** Item terhapus

### ✅ Checkout Process
1. Cart > "Lanjut ke Checkout"
2. Isi form alamat:
   - Nama: Test Customer
   - Phone: 081234567890
   - Alamat lengkap
   - Kota: Jakarta
   - Kode Pos: 12345
   - Catatan (optional)
3. Klik "Buat Pesanan"
4. **Expected:** 
   - Success page
   - Order number generated
   - Button "Lanjut ke Pembayaran"

### ✅ Payment Upload
1. Success page > "Lanjut ke Pembayaran"
2. **Expected:**
   - Info rekening bank BCA & Mandiri
   - Form upload bukti transfer
3. Upload gambar bukti transfer
4. **Expected:**
   - Success message
   - Gambar ter-upload
   - Status "Menunggu konfirmasi"

### ✅ Order History
1. Menu "Pesanan"
2. **Expected:** List semua pesanan user
3. Klik "Detail" pada order
4. **Expected:**
   - Status pesanan
   - Status pembayaran
   - Detail produk
   - Info pengiriman
   - Bukti pembayaran (jika uploaded)

### ✅ Checkout via WhatsApp (Alternative)
1. Cart > "Checkout via WhatsApp"
2. **Expected:**
   - Redirect ke WhatsApp Web/App
   - Pre-filled message dengan detail order
   - Nomor tujuan: +62 882-9366-3097

---

## Guest/Public Testing

### ✅ Landing Page
1. Buka `/`
2. **Expected:**
   - Hero section dengan animasi
   - Features (3 cards)
   - Kategori produk (3 cards)
   - Contact section
   - Floating buttons (WA, IG, Zangi)
3. Scroll smooth
4. Klik floating WA button
5. **Expected:** Open WhatsApp

### ✅ Navigation
1. Landing page > Klik "Login"
2. **Expected:** Redirect ke login page
3. Klik "Daftar Sekarang"
4. **Expected:** Redirect ke register page

---

## Security Testing

### ✅ Unauthorized Access
1. Logout (jika login)
2. Coba akses `/admin/dashboard`
3. **Expected:** Redirect ke login atau 403 error

### ✅ Role-Based Access
1. Login sebagai user
2. Coba akses `/admin/dashboard`
3. **Expected:** 403 Forbidden

### ✅ Cart Ownership
1. Login user A
2. Add produk ke cart
3. Ambil ID cart dari network/inspect
4. Logout, login user B
5. Coba update cart user A via ID
6. **Expected:** 403 Unauthorized

---

## Mobile Responsive Testing

### ✅ Test di Mobile View
1. Open DevTools > Toggle device toolbar
2. Pilih device: iPhone 12 Pro
3. Test semua halaman:
   - Landing page
   - Login/Register
   - Dashboard
   - Cart
   - Checkout
   - Order detail
4. **Expected:**
   - Layout rapi
   - Button accessible
   - Form usable
   - Images proportional
   - Floating buttons tidak menutupi konten

---

## Performance Testing

### ✅ Page Load Speed
1. Open DevTools > Network
2. Hard refresh (Ctrl+Shift+R)
3. **Expected:** Total load < 3 seconds

### ✅ Image Optimization
1. Check image sizes
2. **Expected:** Product images < 500KB each

---

## Browser Compatibility

### ✅ Test Browsers
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

**Expected:** Semua fitur berfungsi di semua browser

---

## Error Handling

### ✅ Invalid Input
1. Form dengan field kosong
2. **Expected:** Validation error message

### ✅ File Upload Error
1. Upload file > 2MB
2. **Expected:** Error message "Max 2MB"

### ✅ Out of Stock
1. Add produk dengan stok 0
2. **Expected:** Button disabled atau error message

---

## Final Checklist Before Production

- [ ] All test cases passed
- [ ] No console errors
- [ ] All images loading
- [ ] Email notification working
- [ ] Payment upload working
- [ ] Admin can verify payments
- [ ] Mobile responsive OK
- [ ] HTTPS enabled
- [ ] .env configured for production
- [ ] Database optimized
- [ ] Cache cleared