<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/recipes') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/fasting') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/fasting/timer') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @foreach(['16-8', '18-6', '20-4', 'omad', '5-2', 'eat-stop-eat'] as $slug)
    <url>
        <loc>{{ url('/fasting/' . $slug) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
    @foreach($recipes as $recipe)
    <url>
        <loc>{{ url('/recipe/' . $recipe->slug) }}</loc>
        <lastmod>{{ $recipe->updated_at->toW3cString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
