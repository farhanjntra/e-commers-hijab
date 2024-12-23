<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserStatusController;

// Landing Page Routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/admin', [LandingController::class, 'admin'])->middleware('admin')->name('admin.dashboard');
Route::get('/seller', [LandingController::class, 'bestSeller']);
Route::get('/new-arrival', [LandingController::class, 'newArrival']);
Route::get('/tentang', [LandingController::class, 'tentang']);
Route::get('/kategori/{kategori}', [LandingController::class, 'kategori']);
Route::get('/detail/{id}', [LandingController::class, 'detail']);
Route::get('/allproduk', [LandingController::class, 'katalog']);

// Login and Logout Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('registerUser');

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showResetRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Barang Routes
Route::resource('admin/barang', BarangController::class)->middleware('auth'); // Tambahkan middleware auth jika dibutuhkan
Route::resource('admin/kategori', KategoriController::class)->middleware('auth');


// Keranjang Routes
Route::get('/keranjangku', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::get('tambah_keranjang/{id}', [KeranjangController::class, 'tambahKeranjang'])->name('keranjang.tambah')->middleware('auth');
Route::get('produk/{id}', [KeranjangController::class, 'show'])->name('produk.show');
Route::get('hapus_keranjang/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang'])->name('keranjang.kurang');
Route::post('/keranjang/tambahKeranjang/{id}', [KeranjangController::class, 'tambahKeranjang'])->name('keranjang.tambahKeranjang');
Route::post('/update_cart_quantity/{id}', [KeranjangController::class, 'updateQuantity'])->middleware(['auth', 'verified']);

// Menampilkan form checkout
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');

// Proses checkout menggunakan POST
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Halaman success setelah checkout
Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');


use App\Http\Controllers\AdminOrderController;

// Admin Order Routes
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->middleware('admin')->name('admin.orders.index'); // Daftar pesanan
Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->middleware('admin')->name('admin.orders.show'); // Detail pesanan
Route::put('/admin/orders/{order}', [AdminOrderController::class, 'update'])->middleware('admin')->name('admin.orders.update'); // Update status pesanan
Route::post('admin/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
Route::get('/status-pesanan', [UserStatusController::class, 'index'])
    ->middleware('auth')
    ->name('user.orders.index');
//laporan
Route::get('/barang/laporan', [BarangController::class, 'laporan'])->name('barang.laporan');
