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

        Schema::table('users', function(Blueprint $table){
            $table->string('id', 36)->change();
        });

        Schema::table('users' , function(Blueprint $table){
            $table->foreign('kelas_id')->after('id')->references('id')->on('kelas_santris')->onDelete('cascade')->nullable();
            $table->foreign('departement_id')->after('kelas_id')->references('id')->on('departements')->onDelete('cascade')->nullable();
            $table->foreign('program_stage_id')->after('departement_id')->references('id')->on('program_stages')->onDelete('cascade')->nullable();
        });

        Schema::table('departements', function(Blueprint $table){
            $table->foreign('leader_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('co_leader_id')->after('leader_id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        Schema::table('permissions', function(Blueprint $table){
            $table->foreign('user_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        Schema::table('assessments', function (Blueprint $table){
            $table->foreign('user_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('lesson_id')->after('user_id')->references('id')->on('assessments')->onDelete('cascade')->nullable();
        });

        Schema::table('rapot_santris', function(Blueprint $table){
            $table->foreign('santri_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        Schema::table('leasons', function(Blueprint $table){
            $table->foreign('kelas_santri_id')->after('id')->references('id')->on('leasons')->onDelete('cascade')->nullable();
        });

        Schema::table('kelas_santris', function(Blueprint $table){
            $table->foreign('mentor_id')->after('id')->on('users')->references('id')->onDelete('cascade')->nullable();
        });

        schema::table('santri_families', function(Blueprint $table){
            $table->foreign('santri_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        Schema::table('financial_records', function(Blueprint $table){
            $table->foreign('accounting_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        Schema::table('atendances', function (Blueprint $table){
            $table->foreign('santri_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('activity_id')->after('santri_id')->references('id')->on('atendances')->onDelete('cascade')->nullable();
        });

        Schema::table('news', function(Blueprint $table){
            $table->foreign('autor_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        Schema::table('attachment_santris', function(Blueprint $table){
            $table->foreign('santri_id')->after('id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(  'kelas_id' );
            $table->dropForeign(  'departement_id');
            $table->dropForeign(  'program_stage_id');
        });

        Schema::table('departements', function (Blueprint $table) {
            $table->dropForeign('leader_id');
            $table->dropForeign('co_leader_id');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });

        Schema::table('assessments', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('lesson_id');
        });

        Schema::table('rapot_santris', function (Blueprint $table) {
            $table->dropForeign('santri_id');
        });

        Schema::table('leasons', function (Blueprint $table) {
            $table->dropForeign('kelas_santri_id');
        });

        Schema::table('kelas_santris', function (Blueprint $table) {
            $table->dropForeign('mentor_id');
        });

        Schema::table('santri_families', function (Blueprint $table) {
            $table->dropForeign('santri_id');
        });

        Schema::table('financial_records', function (Blueprint $table) {
            $table->dropForeign('accounting_id');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('santri_id');
            $table->dropForeign('activity_id');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('autor_id');
        });

        Schema::table('attachment_santris', function (Blueprint $table) {
            $table->dropForeign('santri_id');
        });
    }
};
