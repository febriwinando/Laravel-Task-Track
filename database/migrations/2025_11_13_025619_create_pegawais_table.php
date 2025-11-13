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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik')->unique();
            $table->string('employee_id')->unique();
            $table->string('email')->unique();
            $table->string('nomor_wa');
            $table->enum('level', ['officer', 'verifier']);
            $table->enum('status', ['active', 'inactive']);
            $table->string('password');
            $table->string('foto')->nullable(); // menyimpan nama file gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
