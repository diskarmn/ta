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
        Schema::create('view_tulis_order', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('order_number',10)->nullable();
            $table->uuid('kd')->nullable();
            $table->string('barang', 25)->nullable();
            $table->integer('harga')->nullable();
            $table->enum('ukuran', ['S','M', 'L', 'XL', 'XXL'])->nullable();
            $table->integer('qty')->nullable();
            $table->integer('ongkir')->nullable();
            $table->string('jasa_ongkir', 25)->nullable();
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
        Schema::dropIfExists('view_tulis_order');
    }
};
