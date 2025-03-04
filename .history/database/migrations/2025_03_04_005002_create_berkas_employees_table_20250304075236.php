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
        Schema::create('berkas_employees', function (Blueprint $table) {
            $table->id();
            $table->ForeignId('id_user')->on('users')->references('id');
            $table->string('nama_lengkap');
            $table->string('foto_user');
            $table->string('');
            $table->string('');
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_employees');
    }
};
