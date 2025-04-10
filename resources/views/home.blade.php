<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#fdfaf5] text-black flex flex-col min-h-screen">

    <!-- Navigation -->
    <header>
        <x-navbar></x-navbar>
    </header>

    <!-- Main Content (Hero Section) -->
    <main class="flex-grow flex flex-col items-center justify-center text-center px-10">
        <h2 class="text-6xl font-bold leading-tight">Human stories & ideas</h2>
        <p class="text-lg text-gray-600 mt-4">
            A place to read, write, and deepen your understanding.
        </p>
        <a href="/posts" class="mt-6 bg-[#187a15] text-white px-6 py-3 rounded-full text-lg">
            Start Reading
        </a>
    </main>

    <!-- Footer -->
    <footer class="border-t py-6 text-center text-gray-600">
        <p>© 2025 <a href="https://tanfitra.vercel.app/" class="hover:underline">Adhim Tanfitra</a>. All Rights Reserved.
            <nav class="flex justify-center space-x-6 mt-2">
            <a href="#" class="hover:underline">Help</a>
            <a href="#" class="hover:underline">Privacy</a>
            <a href="#" class="hover:underline">Terms</a>
            <a href="#" class="hover:underline">Blog</a>
        </nav>
    </footer>

</body>

</html>
