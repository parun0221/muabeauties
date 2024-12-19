<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        // Mengubah kolom total_price dan dp menjadi DECIMAL
        $table->decimal('total_price', 10, 2)->change(); // 10 digit total, 2 digit setelah desimal
        $table->decimal('dp', 10, 2)->change();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        // Mengembalikan ke tipe integer jika perlu rollback
        $table->integer('total_price')->change();
        $table->integer('dp')->change();
    });
}

};
