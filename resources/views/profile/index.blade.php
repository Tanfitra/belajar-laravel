<x-layout>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <!-- User Information Section -->
        <div class="mb-8">
            <h1 class="font-bold text-2xl mb-4">User Information</h1>
            <div class="space-y-2">
                <p class="text-gray-700"><span class="font-semibold">Name:</span> {{ $user->name }}</p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                <p class="text-gray-700"><span class="font-semibold">Joined:</span>
                    {{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- User Posts Section -->
        {{-- <div>
            <h2 class="font-bold text-2xl mb-4">Posts</h2>
            @if ($user->posts->count() > 0)
                <div class="grid gap-8 grid-cols-2">
                    @foreach ($user->posts as $post)
                        <article
                            class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col h-full">
                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($post->categories as $category)
                                        <a href="/posts?category={{ $category->slug }}"
                                            class="bg-{{ $category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="mb-5">
                                @if ($post->image)
                                <img class="object-cover w-full h-48 rounded-lg"
                                src="{{ asset('storage/post-images/' . $post->image) }}"
                                alt="{{ $post->title }}" />
                            
                                @else
                                    <img class="object-cover w-full h-48 rounded-lg"
                                        src="https://cdn.discordapp.com/attachments/831039319547314208/1342392215229698100/bg.png?ex=67b977ac&is=67b8262c&hm=90e15f67ef6838b7d7faa11ba05422bbd534a94a015f00e0c2e77661e4aadad7&"
                                        alt="{{ $post->title }}" />
                                @endif
                            </div>
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="/posts/{{ $post->slug }}" class="hover:underline">{{ $post['title'] }}</a>
                            </h2>
                            <p class="mb-5 font-light text-gray-500 dark:text-gray-400 flex-grow">
                                {{ Str::limit($post['body'], 150) }}
                            </p>
                            <div class="mt-auto flex justify-between items-center">
                                <a href="/posts?author={{ $post->author->username }}">
                                    <div class="flex items-center space-x-3">
                                        <img class="w-7 h-7 rounded-full"
                                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                            alt="{{ $post->author->name }}" />
                                        <span class="font-medium dark:text-white">
                                            {{ $post->author->name }}
                                        </span>
                                    </div>
                                </a>
                                <div class="inline-flex space-x-2">
                                    <div>
                                        <a href="#" class="edit-post" data-id="{{ $post->id }}"
                                            data-title="{{ $post->title }}" data-category="{{ $post->category_id }}"
                                            data-content="{{ $post->body }}">
                                            <svg class="w-6 h-6 text-yellow-500 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#" class="delete-post" data-id="{{ $post->id }}">
                                            <svg class="w-6 h-6 text-red-500 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No posts available.</p>
            @endif
        </div> --}}
    </div>

    <!-- Modal -->
    {{-- <div id="myModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-5 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 xl:w-2/5 shadow-lg rounded-md bg-white">
            <div class="flex justify-end">
                <button id="closeModal"
                    class="text-gray-400 hover:text-gray-500 transition-colors duration-150 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">Edit article</h2>

            <form id="editForm" action="{{ route('posts.update', ['post' => ':id']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Enter blog title">
                </div>

                <div class="mb-2">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        Category
                    </label>
                    <select id="category" name="category" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Select category</option>
                        <option value="1">Web Development</option>
                        <option value="2">Mobile Development</option>
                        <option value="3">Machine Learning</option>
                        <option value="4">UI/UX Design</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="file_input">Upload file</label>
                    <input name="image" @error('image') is-invalid @enderror
                        class="block pt-1.5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="image" type="file" accept="image/*">
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Content
                    </label>
                    <textarea id="content" name="content" rows="5" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Write your blog content here"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Edit Article
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-post').click(function(event) {
                event.preventDefault();
                var postId = $(this).data('id');
                var postTitle = $(this).data('title');
                var postCategory = $(this).data('category');
                var postContent = $(this).data('content');

                $('#editForm').attr('action', $('#editForm').attr('action').replace(':id', postId));
                $('#title').val(postTitle);
                $('#category').val(postCategory);
                $('#content').val(postContent);

                $('#myModal').show();
            });

            $('#closeModal').click(function() {
                $('#myModal').hide();
            });

            $(window).click(function(event) {
                if (event.target.id === "myModal") {
                    $('#myModal').hide();
                }
            });

            $(document).ready(function() {
                $(document).ready(function() {
                    $('.delete-post').click(function(event) {
                        event.preventDefault();
                        var postId = $(this).data('id');

                        if (confirm('Are you sure you want to delete this post?')) {
                            $.ajax({
                                url: '/posts/' + postId,
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    _method: 'DELETE'
                                },
                                success: function(result) {
                                    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    alert('Failed to delete the post.');
                                }
                            });
                        }
                    });
                });

            });

        });
    </script> --}}
</x-layout>
