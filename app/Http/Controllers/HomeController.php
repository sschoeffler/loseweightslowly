<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Cuisine;
use App\Models\Diet;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $diets = Diet::all();

        // Only load cuisines and allergens if tables exist
        $cuisines = collect();
        $allergens = collect();

        if (Schema::hasTable('cuisines')) {
            $cuisines = Cuisine::orderBy('category')->orderBy('name')->get()->groupBy('category');
        }

        if (Schema::hasTable('allergens')) {
            $allergens = Allergen::all();
        }

        return view('home', compact('diets', 'cuisines', 'allergens'));
    }
}
