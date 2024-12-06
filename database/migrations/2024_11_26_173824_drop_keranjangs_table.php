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
        // Menghapus tabel 'keranjangs'
        Schema::dropIfExists('keranjangs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika rollback, buat ulang tabel 'keranjangs' (opsional)
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_barang');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('products')->onUpdate('cascade');
            $table->timestamps();
        });
    }
};
