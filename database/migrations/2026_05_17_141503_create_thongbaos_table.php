<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thongbao', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->text('noi_dung');
            $table->string('loai')->default('he_thong');
            $table->json('du_lieu')->nullable();
            $table->boolean('da_doc')->default(false);
            $table->timestamps();

            $table->index('da_doc');
            $table->index('loai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thongbao');
    }
};