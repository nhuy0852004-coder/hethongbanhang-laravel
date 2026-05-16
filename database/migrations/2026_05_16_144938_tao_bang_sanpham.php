<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danhmuc_id')->constrained('danhmuc')->cascadeOnDelete();

            $table->string('ten_san_pham');
            $table->string('duong_dan')->unique();
            $table->string('ma_san_pham')->unique();
            $table->string('anh_dai_dien')->nullable();

            $table->unsignedBigInteger('gia_ban');
            $table->unsignedBigInteger('gia_khuyen_mai')->nullable();
            $table->unsignedInteger('so_luong_ton')->default(0);

            $table->text('mo_ta_ngan')->nullable();
            $table->longText('mo_ta_chi_tiet')->nullable();

            $table->enum('trang_thai', ['hien_thi', 'an', 'het_hang'])->default('hien_thi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};