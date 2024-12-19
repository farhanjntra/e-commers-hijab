<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function bestSellers()
    {
        // Ambil semua orders dengan status 'completed'
        $orders = DB::table('orders')
            ->select('items')
            ->where('status', 'completed')
            ->get();

        $bestSellers = collect(); // Kumpulan untuk menyimpan produk_id dan jumlah

        // Proses setiap order untuk mengumpulkan produk dan jumlahnya
        foreach ($orders as $order) {
            $items = json_decode($order->items, true);

            // Lewati jika items tidak valid
            if ($items === null) {
                continue;
            }

            // Ambil hanya 'produk_id' dan 'jumlah'
            $items = collect($items)->map(function ($item) {
                return [
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                ];
            });

            $bestSellers = $bestSellers->merge($items);
        }

        // Hitung total jumlah untuk setiap produk dan filter hanya produk dengan jumlah > 2
        $bestSellers = $bestSellers->groupBy('produk_id')
            ->map(function ($group) {
                return $group->sum('jumlah');
            })
            ->filter(function ($jumlah) { // Filter produk dengan jumlah di atas 2
                return $jumlah > 2;
            })
            ->sortByDesc(function ($jumlah) { // Urutkan secara descending
                return $jumlah;
            });

        // Jika tidak ada produk yang memenuhi kondisi
        if ($bestSellers->isEmpty()) {
            return view('best_sellers.index')->with('message', 'No best sellers found with orders above 2.');
        }

        // Ambil data produk dari tabel 'barangs' sesuai produk_id
        $products = DB::table('barangs')
            ->whereIn('id', $bestSellers->keys())
            ->get();

        // Gabungkan data produk dengan jumlah yang dihitung
        $bestSellerProducts = $bestSellers->map(function ($jumlah, $produk_id) use ($products) {
            $product = $products->firstWhere('id', $produk_id);
            return [
                'id_barang' => $produk_id,
                'nama_produk' => $product->nama_produk ?? 'Unknown Product',
                'harga' => $product->harga ?? 0,
                'jumlah_dibeli' => $jumlah,
                'url_gambar' => $product->url_gambar ?? 'images/default.png',
            ];
        });

        // Kirim data ke view
        return view('best_sellers.index', compact('bestSellerProducts'));
    }
}
