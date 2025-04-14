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
// {
//     Schema::create('pelanggans', function (Blueprint $table) {
//         $table->char('NoKontrol', 12)->primary();
//         $table->string('Nama', 50);
//         $table->string('Alamat', 150);
//         $table->string('Telepon', 15);
//         $table->string('Jenis_Plg');
//         $table->timestamps();
//     });
// }