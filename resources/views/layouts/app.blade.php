<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Title</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Include Tailwind CSS --> --}}
    @vite('resources/css/app.css')
    <style>
        /* Override Tailwind CSS for dark mode */
        @media (prefers-color-scheme: dark) {
            .dark\:bg-white {
                background-color: #252f3f;
            }
            .dark\:text-white {
                color: #ffffff;
            }
        }
    </style>
</head>
<body class="dark:bg-gray-900 dark:text-white">
    <header class="dark:bg-gray-800 text-white py-4">
        <!-- Your header content goes here -->
    </header>

    <nav class="dark:bg-gray-800 text-white py-4">
        <!-- Your navigation bar goes here -->
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content') <!-- This is where the content of other views will be injected -->
    </main>

    <footer class="dark:bg-gray-800 text-white py-4">
        <!-- Your footer content goes here -->
    </footer>
</body>
</html>
