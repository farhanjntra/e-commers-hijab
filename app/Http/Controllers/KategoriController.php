<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fitur pencarian kategori
        $query = $request->input('search');
        $kategoris = Kategori::when($query, function ($q) use ($query) {
            $q->where('nama_kategori', 'like', "%$query%");
        })->get();

        return view('admin.Kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        try {
            Kategori::create($validate);
            return redirect('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kategori');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.Kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        try {
            $kategori->update($validate);
            return redirect('/admin/kategori')->with('success', 'Kategori berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            return back()->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus kategori');
        }
    }
}
