<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('update_proses', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->uuid('id_order');
            $table->enum('nama_proses', ['pesanan_ditambahkan','pembayaran' ,'packing','diantar'])
            ->nullable();
            $table->string('order_number',10);
            $table->enum('kelengkapan', ['Lengkap', 'Belum Lengkap','masuk','selesai'])->nullable();
            $table->text('keterangan', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_proses');
    }
};
