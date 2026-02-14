<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $recipes = Recipe::select('slug', 'updated_at')->orderBy('name')->get();

        return response()
            ->view('sitemap', compact('recipes'))
            ->header('Content-Type', 'application/xml');
    }
}
