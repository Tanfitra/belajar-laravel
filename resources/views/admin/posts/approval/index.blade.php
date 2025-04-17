<x-layout-admin>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Pending Posts</h1>

        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2">Title</th>
                        <th class="border border-gray-300 p-2">Author</th>
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingPosts as $post)
                        <tr class="border border-gray-300">
                            <td class="border border-gray-300 p-2">{{ $post->title }}</td>
                            <td class="border border-gray-300 p-2">{{ $post->author->name }}</td>
                            <td class="border border-gray-300 p-2 text-white">
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

                                <!-- Approve Button -->
                                <form action="{{ route('admin.posts.approve', $post) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-green-500 focus:ring-4 focus:outline-none hover:bg-green-600 focus:ring-green-400 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center">
                                        Approve
                                        <svg class="w-6 h-6 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $pendingPosts->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div id="postModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 overflow-y-auto">
        <div class="relative mx-auto p-4 w-full max-w-4xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow-lg p-12">
                <!-- Modal Header -->
                <div class="mb-4 lg:mb-6 not-format">
                    <div class="flex justify-between items-start">
                        <div>
                            <address class="flex items-center my-4 not-italic">
                                <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                                    <img class="mr-4 w-16 h-16 rounded-full" id="modalAuthorImage" src=""
                                        alt="">
                                    <div class="flex flex-col">
                                        <a id="modalAuthorLink" href="#" rel="author"
                                            class="text-xl font-bold text-gray-900 hover:underline">
                                        </a>
                                        <div id="modalCategories" class="flex flex-wrap gap-1 mb-2">
                                        </div>
                                        <p class="text-base text-gray-500"><time pubdate id="modalTime"
                                                datetime=""></time></p>
                                    </div>
                                </div>
                            </address>
                            <h1 id="modalTitle"
                                class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">
                            </h1>
                        </div>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div id="modalContent" class="prose max-w-none post-content">
                </div>

                <!-- Modal Footer -->
                <div class="mt-8 pt-4 border-t">
                    <form id="approveForm" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 inline-flex text-center items-center rounded hover:bg-green-600">
                            Approve
                            <svg class="w-6 h-6 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>
                        </button>
                    </form>
                    <button onclick="closeModal()"
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(postId) {
            const post = {!! json_encode($pendingPosts->keyBy('id')) !!}[postId];

            document.getElementById('modalTitle').innerText = post.title;
            document.getElementById('modalAuthorLink').innerText = post.author.name;
            document.getElementById('modalAuthorLink').href = `/posts?authors=${post.author.username}`;

            const approveForm = document.getElementById('approveForm');
            approveForm.action = `/admin/posts/${postId}/approve`;

            const authorImage = document.getElementById('modalAuthorImage');
            authorImage.src = post.author.profile_photo_path ?
                `/storage/${post.author.profile_photo_path}` :
                `https://ui-avatars.com/api/?name=${encodeURIComponent(post.author.name)}&background=random`;
            authorImage.alt = post.author.name;

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

            const timeElement = document.getElementById('modalTime');
            const createdAt = new Date(post.created_at);
            timeElement.setAttribute('datetime', post.created_at);
            timeElement.setAttribute('title', createdAt.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            }));
            timeElement.textContent = createdAt.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });

            document.getElementById('modalContent').innerHTML = post.body;

            document.getElementById('postModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('postModal').classList.add('hidden');
        }
    </script>
</x-layout-admin>
