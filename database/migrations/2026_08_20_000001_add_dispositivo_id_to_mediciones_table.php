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
        Schema::table('mediciones', function (Blueprint $table) {
            $table->foreignId('interno_id')->nullable()->change();
            $table->string('dispositivo_id', 50)->nullable()->after('interno_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mediciones', function (Blueprint $table) {
            $table->dropColumn('dispositivo_id');
            $table->foreignId('interno_id')->nullable(false)->change();
        });
    }
};
