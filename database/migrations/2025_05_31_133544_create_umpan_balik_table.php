<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmpanBalikTable extends Migration
{
    public function up(): void
    {
        Schema::create('umpan_balik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('complaints')->onDelete('cascade');
            $table->tinyInteger('tanggung_jawab'); // 1–5
            $table->tinyInteger('keandalan');
            $table->tinyInteger('jaminan');
            $table->tinyInteger('empati');
            $table->tinyInteger('daya_tanggap');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umpan_balik');
    }
}

