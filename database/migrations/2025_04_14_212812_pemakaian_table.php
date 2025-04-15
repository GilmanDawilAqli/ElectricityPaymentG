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
        Schema::create('pemakaian', function (Blueprint $table) {
            $table->year('Tahun');
            $table->unsignedTinyInteger('Bulan');
            $table->char('NoKontrol', 12);
            $table->integer('MeterAwal');
            $table->integer('MeterAkhir');
            $table->decimal('BiayaBebanPemakai', 10, 2);
            $table->decimal('BiayaPemakaian', 12, 2);
            $table->timestamps();
        
            $table->primary(['Tahun', 'Bulan', 'NoKontrol']);
            $table->foreign('NoKontrol')->references('NoKontrol')->on('pelanggan')->onDelete('cascade');
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('pemakaian');
    }
};