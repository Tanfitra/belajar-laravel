<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Manage Posts</h1>
        <a href="{{ url('/profile/posts/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Post</a>
    
        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Title</th>
                    <th class="border border-gray-300 p-2">Category</th>
                    <th class="border border-gray-300 p-2">Status</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->posts as $post)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 p-2">{{ $post->title }}</td>
                        <td class="border border-gray-300 p-2">{{ $post->categories->pluck('name')->join(', ') }}</td>
                        <td class="border border-gray-300 p-2">
                            @if ($post->status == 'pending')
                                <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Pending</span>
                            @else
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Published</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2 space-x-2 text-white">
                            <button onclick="openModal('{{ $post->id }}')"
                                class="bg-blue-500 focus:ring-4 focus:outline-none hover:bg-blue-600 focus:ring-blue-400 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center">
                                View
                                <svg class="w-6 h-6 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                            
                            @if($post->status == 'pending')
                                <a href="{{ url('/profile/posts/' . $post->id . '/edit') }}" class="bg-yellow-400 focus:ring-4 focus:outline-none hover:bg-yellow-500 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center">
                                    Edit
                                    <svg class="w-6 h-6 ml-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </a>
                            @else
                                <button class="bg-gray-400 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center cursor-not-allowed" disabled>
                                    Edit
                                    <svg class="w-6 h-6 ml-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </button>
                            @endif
                            
                            <form action="{{ url('/profile/posts/' . $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 focus:ring-4 focus:outline-none hover:bg-red-600 focus:ring-red-400 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center"
                                    onclick="return confirm('Delete this post?')">
                                    Delete
                                    <svg class="w-6 h-6 ml-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="postModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 overflow-y-auto">
        <div class="relative mx-auto p-4 w-full max-w-2xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="text-xl font-semibold" id="modalTitle"></h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="p-4">
                    <div id="modalCategories" class="flex flex-wrap gap-1 mb-2">
                    </div>
                    <div id="modalContent" class="prose"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const posts = {!! json_encode($user->posts->load('author')->keyBy('id')) !!};
    
        function openModal(postId) {
            const post = posts[postId];
    
            if (!post) return;
    
            document.getElementById('modalTitle').innerText = post.title;
            const categoriesContainer = document.getElementById('modalCategories');
            categoriesContainer.innerHTML = '';
            post.categories.forEach(category => {
                const categoryLink = document.createElement('a');
                categoryLink.href = `/posts?category=${category.slug}`;
                categoryLink.className =
                    `bg-${category.color}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded`;
                categoryLink.textContent = category.name;
                categoriesContainer.appendChild(categoryLink);
            });
            document.getElementById('modalContent').innerHTML = post.body;
    
            document.getElementById('postModal').classList.remove('hidden');
        }
    
        function closeModal() {
            document.getElementById('postModal').classList.add('hidden');
        }
    </script>    
</x-layout>
