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
            $table->unsignedBigInteger('gudang_awal');
            $table->foreign('gudang_awal')->references('id')->on('gudangs')->onDelete('cascade');
            $table->unsignedBigInteger('gudang_tujuan');
            $table->foreign('gudang_tujuan')->references('id')->on('gudangs')->onDelete('cascade');
            $table->string('nomor_do')->nullable();
            $table->string('attendant')->nullable();
            $table->string('via')->nullable();
            $table->string('carrier')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('refrensi')->nullable();
            $table->string('lokasi_kirim')->nullable();
            $table->string('truck_number')->nullable();
            $table->string('delivered_by')->nullable();
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
