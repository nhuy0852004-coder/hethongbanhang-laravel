<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danhmuc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danhmuc_cha_id')->nullable()->constrained('danhmuc')->nullOnDelete();
            $table->string('ten_danh_muc');
            $table->string('duong_dan')->unique();
            $table->text('mo_ta')->nullable();
            $table->unsignedInteger('thu_tu')->default(0);
            $table->enum('trang_thai', ['hoat_dong', 'tam_an'])->default('hoat_dong');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danhmuc');
    }
};