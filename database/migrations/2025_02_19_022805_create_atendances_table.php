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
        Schema::create('atendances', function (Blueprint $table) {
            $table->id();
            $table->string('santri_id')->nullable();
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->string('activity')->nullable();
            $table->boolean('status');
            $table->string('keterangan')->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendances');
    }
};
