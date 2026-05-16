<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email')->nullable()->unique();
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('mat_khau')->nullable();
            $table->string('dia_chi')->nullable();
            $table->enum('trang_thai', ['hoat_dong', 'tam_khoa'])->default('hoat_dong');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khachhang');
    }
};
