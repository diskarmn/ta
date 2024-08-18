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
        Schema::create('barang_order', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_order')->nullable();
            $table->string('order_number', 10);
            $table->uuid('id_produk');
            $table->enum('size', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_order');
    }
};
