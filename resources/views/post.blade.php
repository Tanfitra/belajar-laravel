<x-layout>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-[#] dark:bg-gray-900 antialiased my-4">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert bg-white p-12 rounded-lg">
                <header class="mb-4 lg:mb-6 not-format">
                  <a href="/posts" class="font-medium text-sm text-blue-600 hover:underline">&laquo; Back to all posts</a>
                    <address class="flex items-center my-4 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="{{ $post->author->name }}">
                            <div class="flex flex-col">
                                <a href="/posts?authors={{ $post->author->username }}" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white hover:underline">{{ $post->author->name }}
                                </a>
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($post->categories as $category)
                                        <a href="/posts?category={{ $category->slug }}"
                                            class="bg-{{ $category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate
                                        datetime="{{ $post->created_at->format('M jS, Y') }}"
                                        title="{{ $post->created_at->format('M jS, Y') }}">{{ $post->created_at->diffForHumans() }}</time></p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $post->title }}</h1>
                </header>
                <div class="post-content">
                    {!! $post->body !!}
                </div>
            </article>
        </div>
    </main>

</x-layout>
