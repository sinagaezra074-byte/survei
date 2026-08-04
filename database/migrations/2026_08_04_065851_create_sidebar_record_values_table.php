<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sidebar_record_values', function (Blueprint $table) {

            $table->id();

            $table->foreignId('record_id')
                ->constrained('sidebar_records')
                ->cascadeOnDelete();

            $table->foreignId('field_id')
                ->constrained('sidebar_fields')
                ->cascadeOnDelete();

            $table->longText('value')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sidebar_record_values');
    }
};
