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
        Schema::create('galery_muas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('admin_mua_type_id')->constrained()->onDelete('cascade');
        $table->string('gambar');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galery_muas');
    }
};
