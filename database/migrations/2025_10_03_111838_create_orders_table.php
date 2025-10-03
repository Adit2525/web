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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('kode_invoice')->unique();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status', ['Pesanan Diterima', 'Sedang Dijemput', 'Sedang Dicuci', 'Selesai', 'Sudah Diantar'])->default('Pesanan Diterima');
            $table->dateTime('tanggal_pesan')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
