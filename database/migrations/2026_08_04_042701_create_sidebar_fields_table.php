<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sidebar_fields', function (Blueprint $table) {

            $table->id();

            // Relasi ke menu sidebar
            $table->foreignId('sidebar_id')
                ->constrained('sidebars')
                ->cascadeOnDelete();

            // Nama field
            $table->string('nama_field');

            // Jenis field
            $table->enum('tipe_field', [
                'text',
                'textarea',
                'number',
                'email',
                'password',
                'date',
                'datetime',
                'time',
                'image',
                'file',
                'pdf',
                'select',
                'radio',
                'checkbox'
            ]);

            // Apakah wajib diisi
            $table->boolean('required')->default(false);

            // Placeholder
            $table->string('placeholder')->nullable();

            // Nilai default
            $table->string('default_value')->nullable();

            // Urutan field
            $table->integer('urutan')->default(1);

            // Aktif / Nonaktif
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sidebar_fields');
    }
};
