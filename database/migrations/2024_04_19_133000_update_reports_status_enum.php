<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'di-tinjau', 'di-kerjakan', 'selesai', 'ditolak'])->default('menunggu')->change();
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'terverifikasi', 'diproses', 'selesai', 'ditolak'])->default('menunggu')->change();
        });
    }
};

