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
        Schema::create('juragans', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('name_juragan', 25);
            $table->string('alamat', 100)->nullable();
            $table->timestamps();
            // $table->uuid('cs_id')->nullable();
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });

        //  DB::statement('ALTER TABLE juragans ADD CONSTRAINT juragans_cs_id_foreign FOREIGN KEY (cs_id) REFERENCES employees(id) ON DELETE SET NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juragans');
    }
};
