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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_users');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nip')->unique();
            $table->string('no_hp')->nullable();
            $table->string('tentang')->nullable();
            $table->date('tgl_lahir')->format('d/m/Y')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('img_profile')->nullable();
            $table->enum('kelamin', ['', 'laki-laki', 'perampuan'])->nullable();
            $table->enum('role', ['user', 'pokja', 'admin'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
