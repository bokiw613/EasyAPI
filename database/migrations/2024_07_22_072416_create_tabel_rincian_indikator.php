<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelRincianIndikator extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabel_rincian_indikator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabel_data_id')->constrained('tabel_data')->onDelete('cascade');
            $table->string('rincian_indikator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_rincian_indikator');
    }
};
