<x-layout>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-6 lg:px-6">
        <div class="mx-auto max-w-screen-md sm:text-center">
            <form>
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <label for="search"
                            class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input
                            class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search for article" type="search" id="search" name="search"
                            autocomplete="off">
                    </div>
                    <div>
                        <button type="submit"
                            class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-[#187a15] border-[#187a15] sm:rounded-none sm:rounded-r-lg hover:bg-[#156D12] focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                    </div>
                </div>
            </form>

            <!-- Filter Category -->
            <div class="flex flex-wrap justify-center gap-2 mt-4">
                <a href="/posts" class="px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    All Categories
                </a>
                @foreach ($categories as $category)
                    <a href="/posts?category={{ $category->slug }}" class="px-4 py-2 text-sm font-medium text-white bg-{{ $category->color }}-400 rounded-lg ease-in-out hover:opacity-75 hover:underline">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-0">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

            @forelse ($posts as $post)
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
                                src="{{ asset( $post->image) }}" alt="{{ $post->title }}" />
                        @else
                            <img class="object-cover w-full h-48 rounded-lg"
                                src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxjb2xsZWN0aW9uLXBhZ2V8MXxGaE5GRWhuTUZPRXx8ZW58MHx8fHx8"
                                alt="{{ $post->title }}" />
                        @endif
                    </div>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="{{ route('post.show', ['username' => $post->author->username, 'post' => $post]) }}" class="hover:underline">{{ $post['title'] }}</a>
                    </h2>
                    <div class="mb-5 font-lightflex-grow">
                        {{ Str::limit(strip_tags(preg_replace('/<figcaption\b[^>]*>.*?<\/figcaption>/i', '', $post['body'])), 150) }}
                    </div>
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
                        <a href="{{ route('post.show', ['username' => $post->author->username, 'post' => $post]) }}""
                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </article>

            @empty
                <div class="mx-auto max-w-screen-md ">
                    <p class="font-semibold text-xl my-4">Article not found!</p>
                    <a href="/posts" class="block font-medium text-blue-500 hover:underline">Back to all posts
                        &laquo;</a>
                </div>
            @endforelse

        </div>
    </div>

    {{ $posts->links() }}

</x-layout>
