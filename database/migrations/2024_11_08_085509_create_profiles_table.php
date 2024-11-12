<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('profile');
            $table->string('namaLengkap');
            $table->string('npm');
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('email');
            $table->string('nomerWhatsapp');
            $table->string('gelar');
            $table->string('inisial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
