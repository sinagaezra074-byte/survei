<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sidebars', function (Blueprint $table) {

            $table->id();

            $table->string('nama_menu');

            $table->string('route')->unique();

            $table->integer('urutan')->default(1);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sidebars');
    }
};
