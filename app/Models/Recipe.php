<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $fillable = [
        'diet_id', 'cuisine_id', 'name', 'meal_type', 'instructions', 'prep_time',
        'calories', 'protein', 'carbs', 'fat', 'budget_level', 'is_meal_prep_friendly', 'season'
    ];

    protected $casts = [
        'is_meal_prep_friendly' => 'boolean',
    ];

    public function diet(): BelongsTo
    {
        return $this->belongsTo(Diet::class);
    }

    public function cuisine(): BelongsTo
    {
        return $this->belongsTo(Cuisine::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity', 'unit_override')
            ->withTimestamps();
    }

    public function allergens(): BelongsToMany
    {
        return $this->belongsToMany(Allergen::class, 'recipe_allergens')
            ->withTimestamps();
    }
}
