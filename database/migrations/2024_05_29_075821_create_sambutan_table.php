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
        Schema::create('sambutan', function (Blueprint $table) {
            $table->string('id_sambutan')->primary();
            $table->string('nama_sambutan');
            $table->string('jabatan_sambutan');
            $table->longText('isi_sambutan');
            $table->string('foto_sambutan');
            $table->string('visib_sambutan');
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
        Schema::dropIfExists('sambutan');
    }
};
