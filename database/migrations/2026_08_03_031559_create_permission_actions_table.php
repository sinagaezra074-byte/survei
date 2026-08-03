<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_actions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('permission_id');

            $table->string('menu_name');

            $table->boolean('can_view')->default(true);

            $table->boolean('can_create')->default(false);

            $table->boolean('can_edit')->default(false);

            $table->boolean('can_delete')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_actions');
    }
};
