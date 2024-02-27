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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('pembeli', 50)->nullable(false);
            $table->string('penjualan_kode', 50)->nullable(false)->unique();
            $table->dateTime('penjualan_tanggal')->nullable(false);
            $table->timestamps();

            $table->foreign('user_id')->on('m_user')->references('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};
