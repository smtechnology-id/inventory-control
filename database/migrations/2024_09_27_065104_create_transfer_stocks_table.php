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
        Schema::create('transfer_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('gudang_awal');
            $table->foreign('gudang_awal')->references('id')->on('gudangs')->onDelete('cascade');
            $table->unsignedBigInteger('gudang_tujuan');
            $table->foreign('gudang_tujuan')->references('id')->on('gudangs')->onDelete('cascade');
            $table->integer('quantity');
            $table->text('keterangan')->nullable();
            $table->string('refrensi')->nullable();
            $table->string('lokasi_kirim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_stocks');
    }
};
