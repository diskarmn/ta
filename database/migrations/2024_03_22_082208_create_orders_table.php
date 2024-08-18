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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('order_number', 10);
            $table->date('order_date');
            $table->uuid('juragan');
            $table->uuid('id_customer')->default(DB::raw('(UUID())'));
            $table->string('payment_method', 25)->nullable();
            $table->string('source', 25);
            $table->uuid('served_by');
            $table->enum('tujuan_bayar', [
                'BRI', 'BCA','COD',
                'BNI', 'Mandiri', 'BSI'
            ])->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->integer('total_quantity')->nullable();
           
            $table->bigInteger('total_amount');
            $table->integer('paid_amount')->nullable();
            $table->integer('remaining_amount')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['belum_proses', 'cek_pembayaran', 'dalam_proses', 'orderan_selesai'])
                ->default('belum_proses');
            $table->date('deadline')->nullable();
            $table->timestamps();


            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('served_by')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('juragan')->references('id')->on('juragans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_customer']);
            $table->dropForeign(['served_by']);
            $table->dropForeign(['id_produk']);
            $table->dropForeign(['juragan']);
            $table->dropForeign(['keterangan_status_id']);
        });

        Schema::dropIfExists('orders');
    }
};
