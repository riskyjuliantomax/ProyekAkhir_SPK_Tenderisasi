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
        Schema::create('user_perusahaans', function (Blueprint $table) {
            $table->bigIncrements('id_users_perusahaan');
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->string('nama_perusahaan', 100);
            $table->string('npwp_perusahaan', 30);
            $table->string('telp_perusahaan', 20)->nullable();
            $table->string('email_perusahaan', 50)->nullable();
            $table->longText('alamat_perusahaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_perusahaans');
    }
};
