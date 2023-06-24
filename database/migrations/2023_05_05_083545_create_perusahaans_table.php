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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->bigIncrements('id_perusahaan');
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_infoTender');
            $table->foreign('id_infoTender')->references('id_infoTender')->on('info_tenders')->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->year('tahun_berdiri');
            $table->string('nama_kontak')->nullable();
            $table->bigInteger('harga_penawaran')->nullable();
            $table->string('dokumen_perusahaan')->nullable();
            $table->string('telp_perusahaan')->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
