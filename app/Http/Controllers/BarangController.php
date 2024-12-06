<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang.
     */
    public function index()
    {
        // Mengambil semua barang dengan relasi kategori
        $barangs = Barang::with('kategori')->get();
        $kategoris = Kategori::all();

        return view('admin.barang.index', compact('barangs','kategoris'));
    }

    /**
     * Menampilkan formulir untuk membuat barang baru.
     */
    public function create()
    {
        // Mengambil semua kategori untuk dropdown
        $kategoris = Kategori::all();

        return view('admin.barang.create', compact('kategoris'));
    }

    /**
     * Menyimpan barang baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validateData = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kode_produk' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'url_gambar' => 'nullable|image|max:2048',
            'id_kategori' => 'required|exists:kategoris,id',
        ]);

        // Menyimpan gambar jika diunggah
        if ($request->hasFile('url_gambar')) {
            $validateData['url_gambar'] = $request->file('url_gambar')->store('products', 'public');
        }

        // Membuat barang baru
        Barang::create($validateData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail barang tertentu.
     */
    public function show(Barang $barang)
    {
        // Opsional: Menampilkan detail barang (jika diperlukan)
        return view('admin.barang.show', compact('barang'));
    }

    /**
     * Menampilkan formulir untuk mengedit barang.
     */
    public function edit(Barang $barang)
    {
        // Mengambil semua kategori untuk dropdown
        $kategoris = Kategori::all();

        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Memperbarui data barang tertentu di database.
     */
    public function update(Request $request, Barang $barang)
    {
        // Validasi data input
        $validateData = $request->validate([
            'nama_produk' => 'required|string|max:100',
            // 'kode_produk' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'url_gambar' => 'nullable|image|max:2048',
            // 'id_kategori' => 'required|exists:kategoris,id',
        ]);

        // Menyimpan gambar baru jika ada
        if ($request->hasFile('url_gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->url_gambar) {
                Storage::delete('public/' . $barang->url_gambar);
            }

            $validateData['url_gambar'] = $request->file('url_gambar')->store('products', 'public');
        }

        // Memperbarui data barang
        $barang->update($validateData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Menghapus barang tertentu dari database.
     */
    public function destroy(Barang $barang)
    {
        // Hapus gambar dari storage jika ada
        if ($barang->url_gambar) {
            Storage::delete('public/' . $barang->url_gambar);
        }

        // Hapus data barang
        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}
