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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('name', 25);
            $table->string('email', 25)->unique();
            $table->string('password', 100);
            $table->string('profile_image', 100)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->enum('role', ['cs', 'admin', 'ceo']);
            $table->uuid('juragan_id')->nullable();
            $table->foreign('juragan_id')->references('id')->on('juragans')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
