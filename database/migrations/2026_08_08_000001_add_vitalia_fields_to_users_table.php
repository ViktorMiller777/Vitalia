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
            $table->string('nombre', 50)->nullable()->after('id');
            $table->string('apellido_paterno', 50)->nullable()->after('nombre');
            $table->string('apellido_materno', 50)->nullable()->after('apellido_paterno');
            $table->string('correo', 100)->nullable()->unique()->after('email');
            $table->string('telefono')->nullable()->after('correo');
            $table->string('usuario', 30)->nullable()->unique()->after('telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'telefono', 'usuario']);
        });
    }
};
