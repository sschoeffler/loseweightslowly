<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $diets = Diet::all();

        return view('home', compact('diets'));
    }
}
