<x-app-layout>
    <x-slot name="title">Blog</x-slot>
    <x-slot name="metaDescription">Tips, science, and strategies for sustainable weight loss. Healthy recipes, meal planning advice, and nutrition insights from Lose Weight Slowly.</x-slot>
    <x-slot name="headExtra">
        <meta property="og:title" content="Blog | Lose Weight Slowly">
        <meta property="og:description" content="Tips, science, and strategies for sustainable weight loss. Healthy recipes, meal planning advice, and nutrition insights.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/blog') }}">
        <meta property="og:image" content="{{ route('og-image.default') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ route('og-image.default') }}">
        <link rel="canonical" href="{{ url('/blog') }}">
    </x-slot>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Blog</h2>
            <p class="text-gray-500 text-sm mt-1">Science-backed tips for sustainable weight loss</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @forelse($posts as $post)
                <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-4">
                        @if(!empty($post['tag']))
                            @php
                                $tagColors = match($post['tag']) {
                                    'Science' => 'bg-emerald-50 text-emerald-700',
                                    'Nutrition' => 'bg-indigo-50 text-indigo-700',
                                    'Strategy' => 'bg-orange-50 text-orange-700',
                                    default => 'bg-gray-50 text-gray-700',
                                };
                            @endphp
                            <span class="text-xs {{ $tagColors }} px-2.5 py-1 rounded-full font-medium">{{ $post['tag'] }}</span>
                        @endif
                        <span class="text-sm text-gray-400">{{ $post['publish_date_formatted'] }}</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 leading-snug">{{ $post['title'] }}</h2>
                    {!! $post['content'] !!}
                </article>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Coming Soon</h3>
                    <p class="text-gray-500">We're working on new articles. Check back soon!</p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
