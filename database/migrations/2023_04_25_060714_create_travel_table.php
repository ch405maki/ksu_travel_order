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
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->string('ref_num');
            $table->time('time_travel');
            $table->date('date_from_travel');
            $table->date('date_to_travel');
            $table->string('purpose');
            $table->string('source');
            $table->string('destination');
            $table->unsignedBigInteger('nature_id');
            $table->unsignedBigInteger('recommending_id');
            $table->unsignedBigInteger('approving_id');
            $table->timestamp('recommended_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};
