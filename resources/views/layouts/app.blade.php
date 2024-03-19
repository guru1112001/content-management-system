<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Title</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Include Tailwind CSS --> --}}
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css','resources/js/app.js'])
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    
</head>
<body class="dark:bg-gray-900 dark:text-white">
   

    {{-- <nav class="dark:bg-gray-800 text-white py-4">
        <!-- Your navigation bar goes here -->
    </nav> --}}

    <main>
        @yield('content') <!-- This is where the content of other views will be injected -->
    </main>

    {{-- <footer class="dark:bg-gray-800 text-white py-4">
        <!-- Your footer content goes here -->
    </footer> --}}
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
