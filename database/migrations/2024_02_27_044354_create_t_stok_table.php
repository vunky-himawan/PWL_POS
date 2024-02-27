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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id')->nullable(false);
            $table->unsignedBigInteger('barang_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->dateTime('stok_tanggal')->nullable(false);
            $table->integer('stok_jumlah')->nullable(false);
            $table->timestamps();

            $table->foreign('barang_id')->on('m_barang')->references('barang_id');
            $table->foreign('user_id')->on('m_user')->references('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
