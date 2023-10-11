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
            $table->string('provinsi', 50)->nullable();
            $table->string('kabupaten', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('kodepos', 20)->nullable();
            $table->longText('alamat')->nullable();
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
