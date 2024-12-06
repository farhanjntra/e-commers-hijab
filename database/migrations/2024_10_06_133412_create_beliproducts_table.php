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
        Schema::create('beliproducts', function (Blueprint $table) {
            $table->id('id_pembelian_produk');
            $table->foreignId('id_pembelian');
            $table->foreignId('id_produk');
            $table->integer('jumlah');
            $table->decimal('harga',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beliproducts');
    }
};
