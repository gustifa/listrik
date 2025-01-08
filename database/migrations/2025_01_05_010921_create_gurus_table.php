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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nuptk')->nullable();;
            $table->string('nip')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('nik', 16)->nullable();
            $table->integer('jenis_ptk_id')->nullable();
            $table->integer('agama_id');
            $table->integer('status_kepegawaian_id')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa_kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kode_wilayah')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->primary('guru_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
