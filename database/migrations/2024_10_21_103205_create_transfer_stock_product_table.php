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
        Schema::create('transfer_stock_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_stock_id');
            $table->foreign('transfer_stock_id')->references('id')->on('transfer_stocks')->onDelete('cascade');
            $table->unsignedBigInteger('product_gudang_awal_id');
            $table->foreign('product_gudang_awal_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_gudang_tujuan_id');
            $table->foreign('product_gudang_tujuan_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('qty', 10, 2);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_stock_product');
    }
};
