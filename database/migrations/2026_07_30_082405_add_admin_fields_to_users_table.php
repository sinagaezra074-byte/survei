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
        Schema::table('users', function (Blueprint $table) {

            // Kode unik Admin User
            $table->string('admin_code')
                ->unique()
                ->nullable()
                ->after('id');


            // Nomor HP
            $table->string('phone', 20)
                ->nullable()
                ->after('role');


            // Institusi
            $table->string('institution')
                ->nullable()
                ->after('phone');


            // Status akun
            // Sesuai Controller: active / inactive
            $table->enum('status', [
                'active',
                'inactive'
            ])
                ->default('active')
                ->after('institution');


            // Foto profil
            $table->string('avatar')
                ->nullable()
                ->after('status');


            // ID pembuat akun
            $table->unsignedBigInteger('created_by')
                ->nullable()
                ->after('avatar');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {


            $table->dropColumn([
                'admin_code',
                'phone',
                'institution',
                'status',
                'avatar',
                'created_by'
            ]);
        });
    }
};
