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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('name', 25);
            $table->string('email', 25)->unique();
            $table->date('register_date')->nullable();
            $table->string('phone', 15);
            $table->string('phone2', 15)->nullable();
            $table->text('address');
            $table->string('provinsi', 25);
            $table->string('kabupaten', 25);
            $table->string('kecamatan', 25);
            $table->integer('kodepos');
            $table->uuid('cs_id')->nullable();
            $table->timestamps();

            $table->foreign('cs_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['cs_id']);
        });
        Schema::dropIfExists('customers');
    }
};
