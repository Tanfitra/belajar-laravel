<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Manage Posts</h1>
        <a href="{{ url('/profile/posts/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Post</a>

        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Title</th>
                    <th class="border border-gray-300 p-2">Category</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->posts as $post)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 p-2">{{ $post->title }}</td>
                        <td class="border border-gray-300 p-2">{{ $post->categories->pluck('name')->join(', ') }}</td>
                        <td class="border border-gray-300 p-2 space-x-2 text-white">
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
</x-layout>
