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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id')->nullable(false);
            $table->unsignedBigInteger('penjualan_id')->nullable(false);
            $table->unsignedBigInteger('barang_id')->nullable(false);
            $table->integer('harga')->nullable(false);
            $table->integer('jumlah')->nullable(false);
            $table->timestamps();

            $table->foreign('penjualan_id')->on('t_penjualan')->references('penjualan_id');
            $table->foreign('barang_id')->on('m_barang')->references('barang_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};
