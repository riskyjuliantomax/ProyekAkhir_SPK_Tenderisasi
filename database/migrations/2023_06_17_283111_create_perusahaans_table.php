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
        Schema::create('perusahaan_dokumen', function (Blueprint $table) {
            $table->bigIncrements('id_perusahaan');
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_infoTender');
            $table->foreign('id_infoTender')->references('id_infoTender')->on('info_tenders')->onDelete('cascade');
            $table->unsignedBigInteger('id_pendaftaran_users');
            $table->foreign('id_pendaftaran_users')->references('id_pendaftaran_users')->on('pendaftaran_users')->onDelete('cascade');
            $table->string('nama_perusahaan', 50);
            $table->string('alamat_perusahaan', 50);
            $table->string('npwp_perusahaan', 30);
            $table->bigInteger('harga_penawaran');
            $table->string('dokumen_legalitas')->nullable();
            $table->string('dokumen_akta')->nullable();
            $table->string('dokumen_penawaran')->nullable();
            $table->string('telp_perusahaan', 20)->nullable();
            $table->string('email_perusahaan', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan_dokumen');
    }
};
