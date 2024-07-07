<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YourSaaSStartup')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles can be added here */
    </style>
</head>
<body class="bg-gray-900 text-gray-200 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-gray-800 shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div>
                    <a href="/" class="font-bold text-xl text-white">YourSaaS</a>
                </div>
                <div class="flex space-x-4">
                    <a href="#features" class="text-gray-400 hover:text-gray-200">Features</a>
                    <a href="#pricing" class="text-gray-400 hover:text-gray-200">Pricing</a>
                    <a href="#about" class="text-gray-400 hover:text-gray-200">About Us</a>
                    <a href="/login" class="text-gray-400 hover:text-gray-200">Login</a>
                    <a href="/register" class="text-gray-400 hover:text-gray-200">Signup</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 YourSaaS. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Custom JavaScript code can be added here
        });
    </script>
</body>
</html>
