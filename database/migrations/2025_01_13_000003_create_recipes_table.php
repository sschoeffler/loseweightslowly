<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner']);
            $table->text('instructions');
            $table->integer('prep_time')->nullable(); // minutes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
