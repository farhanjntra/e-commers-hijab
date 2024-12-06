<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori');
            $table->string('kode_produk');
            $table->string('nama_produk', 100);
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi')->nullable();
            $table->string('url_gambar')->nullable();
            $table->integer('stok');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}

