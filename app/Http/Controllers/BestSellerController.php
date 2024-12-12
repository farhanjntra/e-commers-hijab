<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function bestSellers()
    {
        $orders = DB::table('orders')
            ->select('items')
            ->where('status', 'completed')
            ->get();

        $bestSellers = collect();

        foreach ($orders as $order) {
            $items = json_decode($order->items, true);

            if ($items === null) {
                continue;
            }

            $items = collect($items)->map(function ($item) {
                return [
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                ];
            });

            $bestSellers = $bestSellers->merge($items);
        }

        $bestSellers = $bestSellers->groupBy('produk_id')
            ->map(function ($group) {
                return $group->sum('jumlah');
            })
            ->filter(function ($jumlah) {
                return $jumlah > 0;
            })
            ->sortByDesc(function ($jumlah) {
                return $jumlah;
            });

        if ($bestSellers->isEmpty()) {
            return view('best_sellers.index')->with('message', 'No best sellers found.');
        }

        $products = DB::table('barangs')
            ->whereIn('id', $bestSellers->keys())
            ->get();

        $bestSellerProducts = $bestSellers->map(function ($jumlah, $produk_id) use ($products) {
            $product = $products->firstWhere('id', $produk_id);
            return [
                'produk_id' => $produk_id,
                'nama_produk' => $product->nama_produk ?? 'Unknown Product',
                'harga' => $product->harga ?? 0,
                'jumlah_dibeli' => $jumlah,
                'url_gambar' => $product->url_gambar ?? 'default_image_url',
            ];
        });

        // Debug data yang dikirim ke view
        dd($bestSellerProducts);

        return view('best_sellers.index', compact('bestSellerProducts'));
    }
}
