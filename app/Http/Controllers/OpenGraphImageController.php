<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Services\OpenGraphImageGenerator;

class OpenGraphImageController extends Controller
{
    public function recipe(Recipe $recipe, OpenGraphImageGenerator $generator)
    {
        $path = $generator->generateForRecipe($recipe);

        return response()->file($path, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800, immutable',
        ]);
    }

    public function default(OpenGraphImageGenerator $generator)
    {
        $path = $generator->generateDefault();

        return response()->file($path, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800, immutable',
        ]);
    }
}
