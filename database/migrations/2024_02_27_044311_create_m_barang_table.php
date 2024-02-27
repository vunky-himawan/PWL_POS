<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id('barang_id')->nullable(false);
            $table->unsignedBigInteger('kategori_id')->nullable(false);
            $table->string('barang_kode', 10)->nullable(false);
            $table->string('barang_nama', 100)->nullable(false);
            $table->integer('harga_beli')->nullable(false);
            $table->integer('harga_jual')->nullable(false);
            $table->timestamps();

            $table->foreign('kategori_id')->on('m_kategori')->references('kategori_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
