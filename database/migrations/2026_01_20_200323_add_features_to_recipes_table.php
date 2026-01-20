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
        Schema::table('recipes', function (Blueprint $table) {
            $table->foreignId('cuisine_id')->nullable()->after('diet_id')->constrained()->nullOnDelete();
            $table->integer('calories')->nullable()->after('prep_time');
            $table->decimal('protein', 5, 1)->nullable()->after('calories');
            $table->decimal('carbs', 5, 1)->nullable()->after('protein');
            $table->decimal('fat', 5, 1)->nullable()->after('carbs');
            $table->enum('budget_level', ['budget', 'moderate', 'premium'])->default('moderate')->after('fat');
            $table->boolean('is_meal_prep_friendly')->default(false)->after('budget_level');
            $table->enum('season', ['spring', 'summer', 'fall', 'winter', 'all'])->default('all')->after('is_meal_prep_friendly');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign(['cuisine_id']);
            $table->dropColumn(['cuisine_id', 'calories', 'protein', 'carbs', 'fat', 'budget_level', 'is_meal_prep_friendly', 'season']);
        });
    }
};
