<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function showCheckoutForm()
    {
        // Ambil data keranjang milik user yang sedang login
        $user = Auth::user();
        $keranjangItems = Keranjang::where('user_id', $user->id)->with('barang')->get();

        // Periksa apakah keranjang kosong
        if ($keranjangItems->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong!');
        }

        // Hitung total harga berdasarkan item di keranjang
        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->barang->harga * $item->jumlah;
        });

        return view('user.checkout.form', compact('keranjangItems', 'totalHarga'));
    }

    // Proses checkout
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat_pembeli' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Ambil item keranjang milik user yang sedang login
        $keranjangItems = Keranjang::where('user_id', $user->id)->with('barang')->get();

        // Periksa apakah keranjang kosong
        if ($keranjangItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        // Hitung total harga berdasarkan data di keranjang
        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->barang->harga * $item->jumlah;
        });

        // Simpan data order
        $order = Order::create([
            'nama_pembeli' => $request->input('nama_pembeli'),
            'alamat_pembeli' => $request->input('alamat_pembeli'),
            'tanggal_pembelian' => now(),
            'total_harga' => $totalHarga,
            'status' => 'pending', // Status default
            'bukti_pembayaran' => null, // Tambahkan nilai default untuk bukti_pembayaran
        ]);

        // Simpan item keranjang ke dalam detail order
        $items = $keranjangItems->map(function ($item) {
            return [
                'produk_id' => $item->barang->id,
                'jumlah' => $item->jumlah,
                'harga' => $item->barang->harga,
            ];
        })->toArray();  // Convert to array

        // Simpan items ke kolom JSON di tabel order
        $order->items = $items;
        $order->save();

        // Hapus data keranjang setelah checkout
        Keranjang::where('user_id', $user->id)->delete();

        // Redirect ke halaman success checkout dengan ID pesanan
        return redirect()->route('checkout.success', ['id' => $order->id])->with('success', 'Pesanan berhasil dibuat!');
    }

    // Menampilkan halaman sukses setelah checkout
    public function success($id)
    {
        // Ambil data order berdasarkan ID
        $order = Order::find($id);

        // Pastikan order ditemukan
        if (!$order) {
            return redirect()->route('keranjang.index')->with('error', 'Pesanan tidak ditemukan!');
        }

        // Tampilkan halaman success dengan data order
        return view('user.checkout.success', compact('order'));
    }
}
