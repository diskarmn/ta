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
        Schema::create('update_status_proses', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->unsignedBigInteger('id_status');
            $table->string('order_number',10);
            $table->enum('kelengkapan', ['Lengkap', 'Belum Lengkap','masuk','selesai'])->nullable();
            $table->text('keterangan', 255)->nullable();
            $table->timestamps();
            $table->foreign('id_status')->references('id')->on('status_proses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_status_proses');
    }
};
