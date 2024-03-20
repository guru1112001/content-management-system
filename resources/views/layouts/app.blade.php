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
        .dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
  background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
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
   <script src="js\app.js"></script>
</body>
</html>
