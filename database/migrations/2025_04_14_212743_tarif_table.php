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
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

// public function up(): void
//     {
//         Schema::create('tarifs', function (Blueprint $table) {
//             $table->string('Jenis_Plg')->primary();
//             $table->decimal('BiayaBeban', 10, 2);
//             $table->decimal('TarifKWH', 10, 4);
//             $table->timestamps();
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('tarifs');
//     }

/** PEMBAYARAN */
// public function up(): void
// {
//     Schema::create('pembayarans', function (Blueprint $table) {
//         $table->id();
//         $table->integer('Tahun');
//         $table->tinyInteger('Bulan');
//         $table->char('NoKontrol', 12);
//         $table->decimal('TotalBayar', 12, 2);
//         $table->date('TanggalBayar');
//         $table->unsignedBigInteger('petugas_id');
//         $table->timestamps();

//         $table->foreign('NoKontrol')->references('NoKontrol')->on('pelanggans')->onDelete('cascade');
//         $table->foreign('petugas_id')->references('id')->on('penggunas')->onDelete('cascade');
//     });
// }