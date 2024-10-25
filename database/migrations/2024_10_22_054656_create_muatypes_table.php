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
        Schema::create('muatypes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mua'); // Nama jenis jasa rias make up
            $table->text('deskripsi')->nullable(); // Deskripsi singkat tentang layanan
            $table->decimal('harga_per_jam', 10, 2); // Harga jasa per jam
            $table->string('gambar')->nullable(); // Menyimpan path gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muatypes');
    }
};
