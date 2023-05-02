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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->time('time_travel');
            $table->date('date_from_travel');
            $table->date('date_to_travel');
            $table->string('purpose');
            $table->string('source');
            $table->string('destination');
            $table->foreignId('travel_id')
            ->constrained('travel')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('recommending_id')
            ->constrained('recommendings')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('approving_id')
            ->constrained('approvings')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('nature_id')
            ->constrained('natures')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->string('recommended_at')->nullable();
            $table->string('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
