<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $fillable = ['diet_id', 'name', 'meal_type', 'instructions', 'prep_time'];

    public function diet(): BelongsTo
    {
        return $this->belongsTo(Diet::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity', 'unit_override')
            ->withTimestamps();
    }
}
