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
        Schema::create('paketkuotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('berat');
            $table->foreignId('satuan_id');
            $table->string('harga');
            $table->string('cabang');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paketkuotas');
    }
};
