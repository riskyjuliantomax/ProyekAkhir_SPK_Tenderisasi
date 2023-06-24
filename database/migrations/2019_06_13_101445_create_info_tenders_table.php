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
        Schema::create('info_tenders', function (Blueprint $table) {
            $table->bigIncrements('id_infoTender');
            $table->string('nama_infoTender');
            $table->bigInteger('harga_infoTender');
            $table->longText('syarat_infoTender');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_tenders');
    }
};
