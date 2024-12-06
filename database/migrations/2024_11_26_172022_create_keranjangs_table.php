<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            // Mengganti nama kolom 'Kode_product' menjadi 'id_barang'
            $table->renameColumn('Kode_product', 'id_barang');
        });

        // Update foreign key constraint jika diperlukan
        // Jika sebelumnya ada relasi ke 'products' berdasarkan 'Kode_product', ubah menjadi 'id_barang'
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropForeign(['id_barang']);  // Menghapus foreign key sebelumnya
            $table->foreign('id_barang')->references('id')->on('barangs')->onUpdate('cascade'); // Menambahkan foreign key baru dengan nama kolom yang baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            // Mengembalikan nama kolom 'id_barang' menjadi 'Kode_product'
            $table->renameColumn('id_barang', 'Kode_product');
        });

        // Update foreign key constraint jika diperlukan
        // Jika sebelumnya ada relasi ke 'products' berdasarkan 'Kode_product', ubah menjadi 'Kode_product'
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropForeign(['Kode_product']);  // Menghapus foreign key sebelumnya
            $table->foreign('Kode_product')->references('Kode_product')->on('products')->onUpdate('cascade'); // Menambahkan foreign key baru dengan nama kolom yang lama
        });
    }
};
