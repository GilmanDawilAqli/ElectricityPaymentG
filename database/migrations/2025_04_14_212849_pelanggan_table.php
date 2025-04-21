<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->char('NoKontrol', 12)->primary();
            $table->string('Nama', 50);
            $table->string('Alamat', 150);
            $table->string('Telepon', 15);
            $table->string('JenisPelanggan');
            $table->timestamps();

            $table->foreign('JenisPelanggan')->references('JenisPelanggan')->on('tarif')->onDelete('cascade');
        });
    }

    public function down(): void
    {
         Schema::dropIfExists('pelanggan');
    }
};