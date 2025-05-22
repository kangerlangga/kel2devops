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
        Schema::create('beranda', function (Blueprint $table) {
            $table->string('id_beranda')->primary();
            $table->string('judul_beranda');
            $table->string('desk_beranda');
            $table->string('foto_beranda');
            $table->string('link_beranda');
            $table->string('visib_beranda');
            $table->string('created_by');
            $table->string('modified_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beranda');
    }
};
