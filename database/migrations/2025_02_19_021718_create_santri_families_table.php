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
        Schema::create('santri_families', function (Blueprint $table) {
            $table->id();
            $table->string('santri_id')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_birth')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_birth')->nullable();
            $table->string('mother_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri_families');
    }
};
