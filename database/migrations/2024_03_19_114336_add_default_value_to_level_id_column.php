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
        Schema::table('useri', function (Blueprint $table) {
            $table->unsignedBigInteger('level_id')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('useri', function (Blueprint $table) {
            $table->unsignedBigInteger('level_id')->default(null)->change();
        });
    }
};
