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
            $table->unsignedBigInteger('product_awal');
            $table->foreign('product_awal')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_tujuan');
            $table->foreign('product_tujuan')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('quantity', 10, 2);
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
