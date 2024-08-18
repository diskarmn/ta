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
        Schema::create('info_pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->uuid('order_id')->nullable();
            $table->integer('jumlah_dana')->default(0);
            $table->enum('kelengkapan', ['Ada', 'Tidak Ada'])->nullable();
            $table->string('link')->nullable();
            $table->string('gambar',100)->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
        // DB::statement('ALTER TABLE info_pembayaran ADD CONSTRAINT info_pembayaran_order_id_foreign FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE SET NULL;');
    }

    public function down(): void
    {
        Schema::dropIfExists('info_pembayaran');
    }
};
