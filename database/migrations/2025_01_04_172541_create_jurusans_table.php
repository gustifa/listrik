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
        Schema::create('jurusans', function (Blueprint $table) {
            $table->id();
            $table->integer('proka_id');
            // $table->integer('walas_id');
            $table->string('nama_jurusan');
            $table->string('kode_jurusan')->nullable();
            $table->string('logo_jurusan')->nullable();
            $table->enum('status', ['1', '0'])->default('0');
            // $table->string('slug_jurusan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusans');
    }
};
