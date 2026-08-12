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
        Schema::create('administracion_medicamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescripcion_id')->constrained('interno_medicamento')->cascadeOnDelete();
            $table->foreignId('cuidador_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('fecha');
            $table->string('dosis_administrada')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administracion_medicamento');
    }
};
