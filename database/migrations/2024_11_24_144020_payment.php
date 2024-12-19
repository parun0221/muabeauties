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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Relasi ke tabel orders
            $table->string('payment_method'); // Metode pembayaran (bank, dana, dll)
            $table->string('payment_type'); // Jenis pembayaran (dp/full)
            $table->string('payment_proof')->nullable(); // Path file bukti pembayaran
            $table->string('status')->default('pending'); // Status pembayaran: pending, verified, rejected
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
