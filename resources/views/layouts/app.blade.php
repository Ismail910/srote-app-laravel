<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags and title -->
    <!-- ... -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Include styles from the 'styles' stack -->
    @stack('styles')

    <!-- Vite script for CSS and JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Include navigation from 'layouts.navigation' -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <!-- Display header -->
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('script')

</body>
</html>
