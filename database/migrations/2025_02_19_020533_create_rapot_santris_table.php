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
        Schema::create('rapot_santris', function (Blueprint $table) {
            $table->id();
            $table->string('santri_id');
            $table->string('academy_year');
            $table->string('overall_score');
            $table->text('streighs');
            $table->text('weaknesses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapot_santris');
    }
};
