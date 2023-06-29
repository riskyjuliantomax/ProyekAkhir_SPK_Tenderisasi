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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->bigIncrements('id_penilaian');
            $table->unsignedBigInteger('id_perusahaan')->nullable();
            $table->unsignedBigInteger('id_crips')->nullable();
            $table->unsignedBigInteger('id_infoTender')->nullable();
            $table->timestamps();
            $table->foreign('id_perusahaan')->references('id_perusahaan')->on('perusahaan')->onDelete('cascade');
            $table->foreign('id_crips')->references('id_crips')->on('crips')->onDelete('cascade');
            $table->foreign('id_infoTender')->references('id_infoTender')->on('info_tenders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
