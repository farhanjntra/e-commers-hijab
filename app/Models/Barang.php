<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi
    protected $fillable = [
        'nama_produk', 'kode_produk', 'harga', 'deskripsi', 'stok', 'url_gambar', 'id_kategori'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    /**
     * Scope untuk mengambil produk terbaru
     */
    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc'); // Menampilkan produk terbaru berdasarkan created_at
    }
}
