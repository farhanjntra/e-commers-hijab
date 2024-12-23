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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->string('nama_pembeli', 100);
            $table->text('alamat_pembeli')->nullable();
            $table->timestamp('tanggal_pembelian')->useCurrent();
            $table->decimal('total_harga', 10, 2);
            $table->string('status', 20);
            $table->string('bukti_pembayaran', 255)->nullable();
            // $table->decimal('ongkir', 10, 2)->default();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
