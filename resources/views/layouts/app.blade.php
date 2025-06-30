<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Sphere Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'Inter', sans-serif; }
      .animated-bg {
        background: linear-gradient(120deg, #e0e7ff, #f0fdfa, #fef9c3, #f0fdfa, #e0e7ff);
        background-size: 200% 200%;
        animation: gradientMove 8s ease-in-out infinite;
      }
      @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }
    </style>
</head>
<body class="animated-bg min-h-screen relative">
    <!-- Background Image -->
    <!-- Removed the unsplash image -->

<nav class="sticky top-0 z-30 w-full bg-gradient-to-r from-indigo-600 to-blue-500 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-2.686-3-6-3s-6 1.343-6 3m12 0c0-1.657 2.686-3 6-3s6 1.343 6 3m-12 0v7m0 0c0 1.657 2.686 3 6 3s6-1.343 6-3m-12 0c0 1.657-2.686 3-6 3s-6-1.343-6-3" /></svg>
            <span class="text-white text-xl font-bold tracking-wide">Job Sphere Dashboard</span>
        </div>
        <div class="flex items-center space-x-2">
            @yield('navbar-links')
        </div>
    </div>
</nav>

<main class="py-8">
    @yield('content')
</main>

<footer class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white mt-12">
    <div class="max-w-7xl mx-auto px-4 py-8 flex flex-col md:flex-row items-center md:justify-between gap-4">
        <div class="text-center md:text-left">
            <div class="font-bold text-lg">Job Sphere</div>
            <div class="text-sm mt-1">Connecting top talent with the best companies worldwide.</div>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6 text-sm">
            <div>
                <span class="font-semibold">Contact:</span> info@jobsphere.com
            </div>
            <div>
                <span class="font-semibold">Phone:</span> +1 (555) 123-4567
            </div>
            <div>
                <a href="/about" class="hover:underline">About</a>
            </div>
        </div>
        <div class="text-xs text-center md:text-right mt-2 md:mt-0">&copy; {{ date('Y') }} Job Sphere. All rights reserved.</div>
    </div>
</footer>

</body>
</html>
