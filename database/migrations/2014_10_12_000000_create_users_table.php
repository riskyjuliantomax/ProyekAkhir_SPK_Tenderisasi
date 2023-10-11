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
            $table->string('nama', 50);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('nip', 50)->unique();
            $table->string('no_hp', 50)->nullable();
            $table->longText('tentang')->nullable();
            $table->date('tgl_lahir')->format('d/m/Y')->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->string('img_profile')->nullable();
            $table->enum('kelamin', ['', 'laki-laki', 'perempuan'])->nullable();
            //Role 0 = User, 1 = Pokja, 2 = Admin
            $table->tinyInteger('role')->default(0);
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
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
