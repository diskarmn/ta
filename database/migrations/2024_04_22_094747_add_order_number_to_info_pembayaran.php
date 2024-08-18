<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('info_pembayaran', function (Blueprint $table) {
            $table->string('order_number',10)->after('order_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_pembayaran', function (Blueprint $table) {
            //
        });
    }
};
