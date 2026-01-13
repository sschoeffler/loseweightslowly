<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lose Weight Slowly') - Healthy Meal Planning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            .print-break { page-break-before: always; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-green-600 text-white shadow-lg no-print">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-2xl font-bold">
                    Lose Weight Slowly
                </a>
                <p class="text-green-100 text-sm hidden sm:block">Healthy meals, sustainable results</p>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-gray-300 py-8 mt-12 no-print">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Lose Weight Slowly. Eat well, live better.</p>
        </div>
    </footer>
</body>
</html>
