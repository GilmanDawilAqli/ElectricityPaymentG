<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemakaian', function (Blueprint $table) {
            $table->id();
            $table->year('Tahun');
            $table->unsignedTinyInteger('Bulan');
            $table->string('NoKontrol', 12);
            $table->integer('MeterAwal');
            $table->integer('MeterAkhir');
            $table->integer('JumlahPakai');
            $table->decimal('BiayaBebanPemakai', 10, 2);
            $table->decimal('BiayaPemakaian', 12, 2);
            $table->enum('Status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->timestamps();
        
            $table->foreign('NoKontrol')->references('NoKontrol')->on('pelanggan')->onDelete('cascade');
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('pemakaian');
    }
};