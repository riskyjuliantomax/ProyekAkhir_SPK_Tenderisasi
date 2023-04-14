<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_alamat', function (Blueprint $table) {
            $table->bigIncrements('id_useralamat');
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->string('kenegaraan');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('kodepos');
            $table->string('alamat');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_alamat');
    }
};
