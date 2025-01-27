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
        Schema::create('rombels', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id');
            // $table->uuid('id')->primary();
            // $table->integer('kelas_id');
            // $table->integer('kelas_id');
            $table->integer('jurusan_id');
            $table->string('nama_rombel');
            // $table->integer('group_id');
            $table->integer('walas_id');
            // $table->integer('siswa_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
