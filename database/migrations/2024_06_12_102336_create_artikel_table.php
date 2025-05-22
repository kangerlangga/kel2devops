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
        Schema::create('artikel', function (Blueprint $table) {
            $table->string('id_artikel')->primary();
            $table->string('id_detail')->unique();
            $table->string('judul_artikel');
            $table->longText('isi_artikel');
            $table->string('foto_artikel');
            $table->string('penulis_artikel');
            $table->string('visib_artikel');
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
        Schema::dropIfExists('artikel');
    }
};
