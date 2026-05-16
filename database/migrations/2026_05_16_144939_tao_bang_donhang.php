<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();

            $table->foreignId('khachhang_id')->nullable()->constrained('khachhang')->nullOnDelete();

            $table->string('ho_ten_nguoi_nhan');
            $table->string('so_dien_thoai', 20);
            $table->string('email')->nullable();

            $table->string('dia_chi');
            $table->string('tinh_thanh')->nullable();
            $table->string('quan_huyen')->nullable();
            $table->string('phuong_xa')->nullable();

            $table->unsignedBigInteger('tong_tien_hang')->default(0);
            $table->unsignedBigInteger('phi_van_chuyen')->default(0);
            $table->unsignedBigInteger('giam_gia')->default(0);
            $table->unsignedBigInteger('tong_thanh_toan')->default(0);

            $table->enum('phuong_thuc_thanh_toan', ['cod', 'chuyen_khoan'])->default('cod');

            $table->enum('trang_thai', [
                'cho_xac_nhan',
                'da_xac_nhan',
                'dang_giao_hang',
                'hoan_thanh',
                'da_huy'
            ])->default('cho_xac_nhan');

            $table->text('ghi_chu')->nullable();

            $table->timestamps();

            $table->index('ma_don_hang');
            $table->index('so_dien_thoai');
            $table->index('trang_thai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};