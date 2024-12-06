<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tentukan nama primary key jika bukan 'id'
    protected $primaryKey = 'id_order'; // Ubah menjadi 'id_order'

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data kolom items (misalnya JSON)
    protected $casts = [
        'items' => 'array',  // Menyimpan kolom items sebagai array jika tipe data JSON
    ];

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'nama_pembeli',
        'alamat_pembeli',
        'total_harga',
        'status',
        'items',  // Tambahkan kolom items ke dalam $fillable
    ];
}

