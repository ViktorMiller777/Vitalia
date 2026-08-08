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
        Schema::create('interno_familiar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interno_id')->constrained('internos')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->enum('parentesco', ['Hijo(a)', 'Esposo(a)', 'Hermano(a)', 'Tutor(a) legal', 'Cónyuge', 'Otro']);
            $table->date('fecha_asignacion');
            $table->string('estado')->default('active');
            $table->timestamps();

            $table->unique(['interno_id', 'usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interno_familiar');
    }
};
