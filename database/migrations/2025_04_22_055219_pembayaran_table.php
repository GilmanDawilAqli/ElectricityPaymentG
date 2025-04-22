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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id(); // ID pembayaran
            $table->unsignedBigInteger('petugas_id')->after('id'); // ID petugas
            $table->string('NoKontrol')->after('petugas_id'); // NoKontrol pelanggan
            $table->enum('MetodePembayaran', ['tunai', 'bank'])->after('NoKontrol'); // Metode pembayaran
            $table->decimal('JumlahTagihan', 15, 2)->after('MetodePembayaran'); // Jumlah tagihan
            $table->decimal('JumlahBayar', 15, 2)->after('JumlahTagihan'); // Jumlah bayar
            $table->decimal('kembalian', 15, 2)->after('JumlahBayar')->default(0); // Tambahkan kolom kembalian
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
