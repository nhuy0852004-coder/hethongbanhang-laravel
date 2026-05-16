<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donhang_id')->constrained('donhang')->cascadeOnDelete();
            $table->foreignId('sanpham_id')->nullable()->constrained('sanpham')->nullOnDelete();

            $table->string('ten_san_pham');
            $table->string('anh_san_pham')->nullable();

            $table->unsignedBigInteger('gia_ban');
            $table->unsignedInteger('so_luong');
            $table->unsignedBigInteger('thanh_tien');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chitietdonhang');
    }
};