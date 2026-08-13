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
        Schema::create('rekruments', function (Blueprint $table) {
            $table->bigIncrements('id_rekrutment');
            // Foreign key 
            $table->unsignedBigInteger('id_lowongan');

            $table->string('nama_lengkap', 150);
            $table->string('email', 100);
            $table->string('nomor_telepon', 20);
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 20);
            $table->string('status_perkawinan', 30);
            $table->integer('jumlah_tanggungan');
            $table->float('gaji_terakhir');
            $table->float('gaji_harapan');
            $table->string('file_cv', 255);
            $table->string('file_ktp', 255);
            $table->string('file_surat_lamaran', 255);
            $table->string('file_portofolio', 255);
            $table->string('status', 50);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongans')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekruments');
    }
};
