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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->uuid('kd')->nullable();
            $table->string('barang', 25)->nullable();
            $table->integer('harga')->nullable();
            $table->enum('ukuran', ['S','M', 'L', 'XL', 'XXL', 'XXXL'])->nullable();
            $table->integer('qty')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('ongkir')->nullable();
            $table->string('jasa_ongkir', 25)->nullable();
            $table->integer('biaya_lain')->nullable();
            $table->string('jasa_biaya_lain', 25)->nullable();
            $table->integer('total')->nullable();
            $table->string('nama', 25)->nullable();
            $table->uuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
