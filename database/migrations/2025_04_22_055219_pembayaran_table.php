<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->unsignedBigInteger('pemakaian_id')->after('id');
            $table->unsignedBigInteger('petugas_id')->after('pemakaian_id');
            $table->string('PetugasNama')->after('petugas_id');
            $table->string('MetodePembayaran')->after('PetugasNama');
            $table->decimal('JumlahTagihan', 15, 2)->after('MetodePembayaran');
            $table->decimal('JumlahBayar', 15, 2)->after('JumlahTagihan');
            $table->decimal('kembalian', 15, 2)->after('JumlahBayar');
            $table->timestamps();

            // Tambahkan foreign key jika diperlukan
            $table->foreign('pemakaian_id')->references('id')->on('pemakaian')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('pembayaran');
    }
};
