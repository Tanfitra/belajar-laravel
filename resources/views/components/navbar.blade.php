<nav class="flex justify-between items-center px-4 sm:px-10 py-5 border-b bg-[#fdfaf5]" x-data="{ isOpen: false, isMobileMenuOpen: false }">
    <!-- Logo -->
    <a href="/" class="text-3xl font-semibold">Minima</a>

    <!-- Hamburger Menu (Mobile Only) -->
    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="block sm:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <!-- Navigation Links -->
    <div class="hidden sm:flex space-x-8 items-center">
        <a href="/about" class="text-gray-700 hover:text-gray-950">Our Story</a>
        <a href="/profile/posts/create" class="flex items-center space-x-1 text-gray-700 hover:text-gray-950">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
            </svg>
            <p>Write</p>
        </a>

        <!-- User Dropdown (Authenticated) -->
        @auth
            <div class="relative ml-3">
                <div>
                    <button type="button" @click="isOpen = !isOpen"
                        class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">Open user menu</span>
                        @if (auth()->user()->profile_photo_path)
                            <img class="size-8 rounded-full" src="{{ Storage::url(auth()->user()->profile_photo_path) }}"
                                alt="{{ auth()->user()->name }}" />
                        @else
                            <img class="size-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                alt="{{ auth()->user()->name }}" />
                        @endif
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                        id="user-menu-item-0">Profile</a>
                    @hasrole('admin')
                        <a href="/admin" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-1">Admin Dashboard</a>
                    @endhasrole
                    <a href="/profile/posts" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                        id="user-menu-item-1">Manage Posts</a>
                    <a href="/profile/settings" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                        id="user-menu-item-1">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 text-left"
                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                    </form>
                </div>
            </div>
        @else
            <!-- Sign In Button -->
            <div class="relative ml-3">
                <a href="{{ route('login') }}" class="bg-[#187a15] text-white px-4 py-2 rounded-full">Sign In</a>
            </div>
        @endauth
    </div>

    <!-- Mobile Menu (Hidden on Larger Screens) -->
    <div x-show="isMobileMenuOpen" @click.away="isMobileMenuOpen = false"
        class="sm:hidden absolute top-16 right-0 w-full bg-[#fdfaf5] border-b shadow-lg z-20">
        <div class="px-4 py-2 space-y-2">
            <a href="/about" class="block text-gray-700 hover:text-gray-950">Our Story</a>
            <a href="/profile/posts/create" class="flex items-center space-x-1 text-gray-700 hover:text-gray-950">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
                <p>Write</p>
            </a>

            @auth
                <a href="/profile" class="block text-gray-700 hover:text-gray-950">Profile</a>
                @hasrole('admin')
                    <a href="/admin" class="block text-gray-700 hover:text-gray-950">Admin Dashboard</a>
                @endhasrole
                <a href="/profile/posts" class="block text-gray-700 hover:text-gray-950">Manage Posts</a>
                <a href="/settings" class="block text-gray-700 hover:text-gray-950">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-gray-700 hover:text-gray-950">Sign
                        out</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block bg-[#187a15] text-white px-4 py-2 rounded-full text-center">Sign In</a>
            @endauth
        </div>
    </div>
</nav>
