<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function showCheckoutForm()
    {
        $user = Auth::user();

        // Ambil item keranjang milik user
        $keranjangItems = Keranjang::where('user_id', $user->id)->with('barang')->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong!');
        }

        // Hitung total harga
        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->barang->harga * $item->jumlah;
        });

        return view('user.checkout.form', compact('keranjangItems', 'totalHarga'));
    }

    // Proses checkout
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pembeli'     => 'required|string|max:255',
            'alamat_pembeli'   => 'required|string|max:255',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048', // File bukti pembayaran
        ]);

        $user = Auth::user();

        // Ambil item keranjang user
        $keranjangItems = Keranjang::where('user_id', $user->id)->with('barang')->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        // Hitung total harga
        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->barang->harga * $item->jumlah;
        });

        // Proses upload file bukti pembayaran
        $fileName = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/bukti_pembayaran', $fileName, 'public'); // Simpan ke penyimpanan publik
        }

        // Simpan order ke database
        $order = Order::create([
            'nama_pembeli'      => $request->input('nama_pembeli'),
            'alamat_pembeli'    => $request->input('alamat_pembeli'),
            'tanggal_pembelian' => now(),
            'total_harga'       => $totalHarga,
            'status'            => 'pending',
            'bukti_pembayaran'  => $fileName,
            'items'             => json_encode($keranjangItems->map(function ($item) {
                return [
                    'produk_id' => $item->barang->id,
                    'jumlah'    => $item->jumlah,
                    'harga'     => $item->barang->harga,
                ];
            })),
        ]);

        // Debug: Pastikan ID order tidak null
        // $orders = Order::all();
        // dd($order->id_order);

        if (!$order) {
            return redirect()->back()->with('error', 'Gagal menyimpan pesanan. Silakan coba lagi.');
        }

        // Hapus data keranjang setelah checkout berhasil
        Keranjang::where('user_id', $user->id)->delete();

        // Redirect ke halaman success
        return redirect()->route('checkout.success', ['id' => $order->id_order])
                         ->with('success', 'Pesanan berhasil dibuat!');
    }

    // Menampilkan halaman sukses
    public function success($id)
    {
        // Ambil data order berdasarkan ID
        $order = Order::find($id);

        // Jika order tidak ditemukan
        if (!$order) {
            return redirect()->route('keranjang.index')->with('error', 'Pesanan tidak ditemukan!');
        }

        return view('user.checkout.success', compact('order'));
    }
}
