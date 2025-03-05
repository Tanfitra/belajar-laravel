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
    <header class="flex justify-between items-center px-10 py-5 border-b">
        <a href="/" class="text-3xl font-semibold">Prabubima</a>
        <nav class="space-x-8 flex items-center" x-data="{ isOpen: false }">
            <a href ="/about" class="text-gray-700 hover:underline">Our Story</a>
            <a href="#" class="text-gray-700 hover:underline">Write</a>
            @auth
                <div class="relative ml-3">
                    <div>
                        <button type="button" @click="isOpen = !isOpen"
                            class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="size-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                alt="{{ auth()->user()->name }}">
                        </button>
                    </div>

                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-0">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-1">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 text-left"
                                role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="relative ml-3">
                    <a href="{{ route('login') }}" class="bg-[#187a15] text-white px-4 py-2 rounded-full">Sign In</a>
                </div>
            @endauth
            </div>
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
        <p>© 2025 Blog Platform - All Rights Reserved</p>
        <nav class="flex justify-center space-x-6 mt-2">
            <a href="#" class="hover:underline">Help</a>
            <a href="#" class="hover:underline">Privacy</a>
            <a href="#" class="hover:underline">Terms</a>
            <a href="#" class="hover:underline">Blog</a>
        </nav>
    </footer>

</body>

</html>
