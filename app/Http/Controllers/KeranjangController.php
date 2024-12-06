<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $keranjang = Keranjang::where('user_id', Auth::user()->id)->get();
        return view('user.keranjang.index', compact('keranjang'));
    }

    // Menambahkan produk ke keranjang
    public function tambahKeranjang($id)
    {
        $produk = Barang::find($id);
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $stok = $produk->stok;

        // Cek jika stok kosong
        if ($stok <= 0) {
            return response()->json(['error' => 'Stok produk habis'], 400);
        }

        $keranjang = Keranjang::where('user_id', Auth::user()->id)
                              ->where('produk_id', $id)
                              ->first();

        if ($keranjang) {
            // Cek jika jumlah di keranjang masih kurang dari stok
            if ($keranjang->jumlah < $stok) {
                DB::beginTransaction(); // Mulai transaksi
                try {
                    $keranjang->jumlah += 1;
                    $keranjang->save();

                    $produk->stok -= 1; // Kurangi stok
                    $produk->save();

                    // Refresh produk untuk memastikan stok terbaru
                    $produk->refresh();

                    DB::commit(); // Commit transaksi
                    return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang']);
                } catch (\Exception $e) {
                    DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
                    return response()->json(['error' => 'Terjadi kesalahan. Coba lagi.'], 500);
                }
            } else {
                return response()->json(['error' => 'Stok produk tidak cukup'], 400);
            }
        } else {
            if ($stok > 0) {
                DB::beginTransaction(); // Mulai transaksi
                try {
                    Keranjang::create([
                        'user_id' => Auth::user()->id,
                        'produk_id' => $id,
                        'jumlah' => 1,
                    ]);

                    $produk->stok -= 1; // Kurangi stok
                    $produk->save();

                    // Refresh produk untuk memastikan stok terbaru
                    $produk->refresh();

                    DB::commit(); // Commit transaksi
                    return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang']);
                } catch (\Exception $e) {
                    DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
                    return response()->json(['error' => 'Terjadi kesalahan. Coba lagi.'], 500);
                }
            } else {
                return response()->json(['error' => 'Stok produk tidak cukup'], 400);
            }
        }
    }

    // Tambah jumlah produk di keranjang
    public function tambah($id)
    {
        $keranjang = Keranjang::where('user_id', Auth::user()->id)
                              ->where('produk_id', $id)
                              ->first();

        if (!$keranjang) {
            return redirect()->route('keranjang.index')->with('error', 'Produk tidak ditemukan di keranjang');
        }

        $produk = Barang::find($id);
        if (!$produk) {
            return redirect()->route('keranjang.index')->with('error', 'Produk tidak ditemukan');
        }

        $stok = $produk->stok;

        // Cek apakah jumlah produk yang ada di keranjang kurang dari stok
        if ($keranjang->jumlah < $stok) {
            DB::beginTransaction(); // Mulai transaksi
            try {
                $keranjang->jumlah += 1;
                $keranjang->save();

                $produk->stok -= 1;
                $produk->save();

                // Refresh produk untuk memastikan stok terbaru
                $produk->refresh();

                DB::commit(); // Commit transaksi
                return redirect()->route('keranjang.index')->with('success', 'Jumlah produk berhasil ditambahkan.');
            } catch (\Exception $e) {
                DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
                return redirect()->route('keranjang.index')->with('error', 'Terjadi kesalahan. Coba lagi.');
            }
        } else {
            return redirect()->route('keranjang.index')->with('error', 'Stok produk tidak cukup.');
        }
    }

    // Kurangi jumlah produk di keranjang
    public function kurang($id)
    {
        $keranjang = Keranjang::where('user_id', Auth::user()->id)
                              ->where('produk_id', $id)
                              ->first();

        if (!$keranjang) {
            return redirect()->route('keranjang.index')->with('error', 'Produk tidak ditemukan di keranjang');
        }

        $produk = Barang::find($id);
        if (!$produk) {
            return redirect()->route('keranjang.index')->with('error', 'Produk tidak ditemukan');
        }

        if ($keranjang->jumlah > 1) {
            DB::beginTransaction(); // Mulai transaksi
            try {
                $keranjang->jumlah -= 1;
                $keranjang->save();

                $produk->stok += 1; // Tambahkan stok kembali
                $produk->save();

                // Refresh produk untuk memastikan stok terbaru
                $produk->refresh();

                DB::commit(); // Commit transaksi
                return redirect()->route('keranjang.index')->with('success', 'Jumlah produk berhasil dikurangi.');
            } catch (\Exception $e) {
                DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
                return redirect()->route('keranjang.index')->with('error', 'Terjadi kesalahan. Coba lagi.');
            }
        } else {
            // Jika jumlah produk sudah 1, hapus produk dari keranjang
            $keranjang->delete(); // Hapus produk jika jumlahnya 1

            $produk->stok += 1; // Tambahkan stok kembali
            $produk->save();

            // Refresh produk untuk memastikan stok terbaru
            $produk->refresh();

            return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
        }
    }

    // Menghapus produk dari keranjang
    public function hapus($id)
    {
        $keranjang = Keranjang::find($id);
        if (!$keranjang) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $produk = Barang::find($keranjang->produk_id);
        if ($produk) {
            $produk->stok += $keranjang->jumlah; // Menambahkan stok kembali
            $produk->save();
        }

        $keranjang->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    // Perbarui jumlah produk di keranjang menggunakan AJAX
    public function updateQuantity(Request $request, $id)
    {
        $cart = Keranjang::find($id);
        if ($cart) {
            $produk = Barang::find($cart->produk_id);
            $stok = $produk->stok;

            DB::beginTransaction(); // Mulai transaksi
            try {
                if ($request->action == 'increase' && $cart->jumlah < $stok) {
                    $cart->jumlah += 1;
                    $cart->save();

                    $produk->stok -= 1; // Kurangi stok
                    $produk->save();

                    // Refresh produk untuk memastikan stok terbaru
                    $produk->refresh();
                } elseif ($request->action == 'decrease' && $cart->jumlah > 1) {
                    $cart->jumlah -= 1;
                    $cart->save();

                    $produk->stok += 1; // Tambah stok kembali
                    $produk->save();

                    // Refresh produk untuk memastikan stok terbaru
                    $produk->refresh();
                }

                DB::commit(); // Commit transaksi
            } catch (\Exception $e) {
                DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
                return response()->json(['error' => 'Terjadi kesalahan. Coba lagi.'], 500);
            }
        }
        return redirect()->back();
    }
}
