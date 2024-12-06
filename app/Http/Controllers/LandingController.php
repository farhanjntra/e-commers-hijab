<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    // Halaman Admin
    public function admin()
    {
        return view('admin.layout.index');
    }

    // Halaman Beranda
    public function index()
    {
        $produkTerbaru = Barang::latest()->limit(4)->get();
        return view('user.index', ['datas' => $produkTerbaru]);
    }

    // Halaman Best Seller
    public function bestSeller()
    {
        return view('user.best-seller.index');
    }

    // Halaman Katalog dengan pencarian
    public function katalog(Request $request)
    {
        $query = $request->input('q'); // Ambil kata kunci pencarian
        $dataProduk = Barang::query();

        if ($query) {
            // Pencarian berdasarkan nama produk, deskripsi, atau kategori
            $dataProduk->where('nama_produk', 'LIKE', '%' . $query . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $query . '%')
            ->orWhereHas('kategori', function ($q) use ($query) {
                $q->where('nama_kategori', 'LIKE', '%' . $query . '%');
            });
        }

        $dataProduk = $dataProduk->get();
        $allKategori = Kategori::all(); // Semua kategori untuk filter

        return view('user.katalog.index', [
            'data' => $dataProduk,
            'query' => $query,
            'allKategori' => $allKategori
        ]);
    }

    // Halaman Produk Berdasarkan Kategori
    public function kategori($kategori)
    {
        $kategoriData = Kategori::where('nama_kategori', 'like', '%' . $kategori . '%')->firstOrFail();
        $dataProduk = Barang::where('id_kategori', $kategoriData->id)->get();

        return view('user.kategori.index', [
            'data' => $dataProduk,
            'kategori' => $kategoriData->nama_kategori
        ]);
    }

    // Halaman Produk New Arrival
    public function newArrival()
    {
        $produkTerbaru = Barang::latest()->limit(4)->get();
        return view('user.arrival.index', ['datas' => $produkTerbaru]);
    }

    // Halaman Tentang
    public function tentang()
    {
        return view('user.tentang.index');
    }

    // Halaman Detail Produk
    public function detail($id)
    {
        $produk = Barang::find($id);

        if (!$produk) {
            return redirect()->route('user.index')->with('error', 'Produk tidak ditemukan');
        }

        $stokProduk = $produk->stok;

        return view('user.detail.index', [
            'data' => $produk,
            'stok' => $stokProduk
        ]);
    }
}
