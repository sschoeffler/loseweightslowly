<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diet extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
