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
                                <!-- View Button -->
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
                    <p id="modalAuthor" class="text-gray-600 mb-2"></p>
                    <div id="modalContent" class="prose">{!! $post->body !!}</div>
                </div>
                <!-- Modal Footer -->
                <div class="p-4 border-t">
                    <form action="{{ route('admin.posts.approve', $post) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 inline-flex text-center items-center rounded">
                            Approve
                        </button>
                    </form> <button onclick="closeModal()"
                        class="bg-blue-500 text-white px-4 py-2 rounded">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to open the modal and populate it with post data
        function openModal(postId) {
            // Fetch post details (you can use AJAX or pass data directly)
            const post = {!! json_encode($pendingPosts->keyBy('id')) !!}[postId];

            // Populate modal with post data
            document.getElementById('modalTitle').innerText = post.title;
            document.getElementById('modalAuthor').innerText = `By: ${post.author.name}`;
            document.getElementById('modalContent').innerHTML = post.body;

            // document.getElementById('modalApproveButton').href = `/admin/posts/${postId}/approve`;

            // Show the modal
            document.getElementById('postModal').classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('postModal').classList.add('hidden');
        }
    </script>
</x-layout-admin>
