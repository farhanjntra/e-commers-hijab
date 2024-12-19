<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang.
     */
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        $kategoris = Kategori::all();

        return view('admin.barang.index', compact('barangs', 'kategoris'));
    }

    /**
     * Menampilkan formulir untuk membuat barang baru.
     */
    public function create()
    {
        $kategoris = Kategori::all();

        return view('admin.barang.create', compact('kategoris'));
    }

    /**
     * Menyimpan barang baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kode_produk' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'url_gambar' => 'nullable|image|max:2048',
            'id_kategori' => 'required|exists:kategoris,id',
        ]);

        if ($request->hasFile('url_gambar')) {
            $validateData['url_gambar'] = $request->file('url_gambar')->store('products', 'public');
        }

        Barang::create($validateData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail barang tertentu.
     */
    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    /**
     * Menampilkan formulir untuk mengedit barang.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();

        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Memperbarui data barang tertentu di database.
     */
    public function update(Request $request, Barang $barang)
    {
        $validateData = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'url_gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('url_gambar')) {
            if ($barang->url_gambar) {
                Storage::delete('public/' . $barang->url_gambar);
            }

            $validateData['url_gambar'] = $request->file('url_gambar')->store('products', 'public');
        }

        $barang->update($validateData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Menghapus barang tertentu dari database.
     */
    public function destroy(Barang $barang)
    {
        if ($barang->url_gambar) {
            Storage::delete('public/' . $barang->url_gambar);
        }

        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Menampilkan laporan barang dalam format PDF.
     */
    public function laporan()
    {
        $barangs = Barang::with('kategori')->get();

        // Generate PDF
        $pdf = PDF::loadView('admin.barang.laporan', compact('barangs'));

        // Menghasilkan PDF dan mengirimkannya ke browser
        return $pdf->download('laporan-barang.pdf');
    }
}
