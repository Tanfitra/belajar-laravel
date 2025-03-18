<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-[#fdfaf5] hover:text-lime-500 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidenav">
    <div
        class="overflow-y-auto py-5 px-3 h-full bg-lime-500 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <ul class="space-y-2">
            <li>
                <div class="pb-4 border-b border-gray-700">
                    <div class="flex items-center space-x-4">
                        <img class="size-12 rounded-full flex items-center justify-center"
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                            alt="{{ auth()->user()->name }}">
                        <div>
                            <p class="font-semibold">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-white">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-base font-normal text-white rounded-lg hover:bg-[#fdfaf5] hover:text-lime-500 group {{ request()->is('admin') ? 'bg-[#fdfaf5] text-lime-500' : '' }}">
                    <svg aria-hidden="true" class="w-6 h-6 transition duration-75 " fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Overview</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}"
                    class="flex items-center p-2 text-base font-normal text-white rounded-lg dark:text-white hover:bg-[#fdfaf5] hover:text-lime-500 dark:hover:bg-gray-700 group {{ request()->is('admin/category') ? 'bg-[#fdfaf5] text-lime-500' : '' }}">
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-lime-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ml-3">Category</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center p-2 w-full text-base font-normal text-white rounded-lg transition duration-75 group hover:bg-[#fdfaf5] hover:text-lime-500 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                    <svg class="flex-shrink-0 w-6 h-6 text-white transition duration-75 group-hover:text-lime-500 dark:text-white dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Posts</span>
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                    <a href="{{ route('admin.posts.approval.index') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-normal text-white rounded-lg transition duration-75 group hover:bg-[#fdfaf5] hover:text-lime-500 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/posts/approval') ? 'bg-[#fdfaf5] text-lime-500' : '' }}">
                        <svg class="w-6 h-6 text-white group-hover:text-lime-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-3">Approval</span>
                    </a>
            </li>
        </ul>
        </li>
        </ul>
    </div>
    <div
        class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-lime-500 dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
        <a href="/"
            class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            role="menuitem" tabindex="-1" id="user-menu-item-2">
            Home
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200"
                role="menuitem" tabindex="-1" id="user-menu-item-2">
                Sign out
                <svg class="w-6 h-6 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                </svg>
            </button>
        </form>
    </div>
</aside>
