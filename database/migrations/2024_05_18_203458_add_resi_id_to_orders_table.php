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
        Schema::table('orders', function (Blueprint $table) {
            $table->uuid('resi_id')->nullable()->after('remaining_amount');
            $table->foreign('resi_id')->references('id')->on('resi')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['resi_id']);
            $table->dropColumn('resi_id');
        });
    }

};
