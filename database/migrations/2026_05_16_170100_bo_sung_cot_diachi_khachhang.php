<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('khachhang', function (Blueprint $table) {
            if (! Schema::hasColumn('khachhang', 'tinh_thanh')) {
                $table->string('tinh_thanh')->nullable()->after('dia_chi');
            }

            if (! Schema::hasColumn('khachhang', 'quan_huyen')) {
                $table->string('quan_huyen')->nullable()->after('tinh_thanh');
            }

            if (! Schema::hasColumn('khachhang', 'phuong_xa')) {
                $table->string('phuong_xa')->nullable()->after('quan_huyen');
            }
        });
    }

    public function down(): void
    {
        Schema::table('khachhang', function (Blueprint $table) {
            if (Schema::hasColumn('khachhang', 'phuong_xa')) {
                $table->dropColumn('phuong_xa');
            }

            if (Schema::hasColumn('khachhang', 'quan_huyen')) {
                $table->dropColumn('quan_huyen');
            }

            if (Schema::hasColumn('khachhang', 'tinh_thanh')) {
                $table->dropColumn('tinh_thanh');
            }
        });
    }
};