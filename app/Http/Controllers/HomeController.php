<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Cuisine;
use App\Models\Diet;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $diets = Diet::all();
        $cuisines = Cuisine::orderBy('category')->orderBy('name')->get()->groupBy('category');
        $allergens = Allergen::all();

        return view('home', compact('diets', 'cuisines', 'allergens'));
    }
}
