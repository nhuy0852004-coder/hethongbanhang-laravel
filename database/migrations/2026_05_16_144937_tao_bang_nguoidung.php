<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('mat_khau');
            $table->enum('vai_tro', ['quan_tri', 'nhan_vien', 'khach_hang'])->default('khach_hang');
            $table->enum('trang_thai', ['hoat_dong', 'tam_khoa'])->default('hoat_dong');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};