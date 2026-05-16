<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caidat', function (Blueprint $table) {
            $table->id();
            $table->string('ten_cua_hang');
            $table->string('logo')->nullable();
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('dia_chi')->nullable();
            $table->text('chinh_sach_van_chuyen')->nullable();
            $table->text('chinh_sach_doi_tra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caidat');
    }
};