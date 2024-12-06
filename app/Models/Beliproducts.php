<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beliproducts extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'beliproducts';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_pembelian_produk',
        'id_pembelian',
        'id_produk',
        'jumlah',
        'harga',
    ];

    // Jika ingin mengatur default timestamps
    public $timestamps = true;
}
