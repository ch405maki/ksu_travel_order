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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')
            ->constrained('trips')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('employee_id')
            ->constrained('employees')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('position_id')
            ->constrained('positions')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
