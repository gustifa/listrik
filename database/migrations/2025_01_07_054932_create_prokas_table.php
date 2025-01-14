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
        Schema::create('prokas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proka');
            $table->integer('proka_id');
            $table->string('logo_proka')->nullable();
            $table->string('kode_proka')->nullable();
            $table->enum('status', ['1', '0'])->default('0');
            $table->string('slug_proka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokas');
    }
};