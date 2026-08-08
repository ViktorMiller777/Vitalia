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
        Schema::create('mediciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interno_id')->constrained('internos')->cascadeOnDelete();
            $table->string('presion_arterial', 10)->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->float('temperatura')->nullable();
            $table->float('saturacion_oxigeno')->nullable();
            $table->float('glucosa')->nullable();
            $table->integer('calidad_aire')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediciones');
    }
};
