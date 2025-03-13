<x-layout-admin>
    <div class="container p-4  space-y-4">
        <h1 class="text-black font-semibold text-2xl">Overview</h1>
        <div class="flex space-x-4 p-4">
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white p-6 flex-1">
                <div class="font-bold text-xl mb-2">Total Posts</div>
                <p class="text-gray-700 text-base">
                    {{ $totalPosts }} posts
                </p>
            </div>

            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white p-6 flex-1">
                <div class="font-bold text-xl mb-2">Total Category</div>
                <p class="text-gray-700 text-base">
                    {{ $totalCategories }} categories
                </p>
            </div>

            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white p-6 flex-1">
                <div class="font-bold text-xl mb-2">Total Users</div>
                <p class="text-gray-700 text-base">
                    {{ $totalUsers }} users
                </p>
        </div>
    </div>
</x-layout-admin>
