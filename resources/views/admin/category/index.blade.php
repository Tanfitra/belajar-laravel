<x-layout-admin>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Categories</h1>
        <a href="{{ route('admin.category.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Category</a>
    
        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2">Name</th>
                        <th class="border border-gray-300 p-2">Color</th>
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 p-2">{{ $category->name }}</td>
                        <td class="border border-gray-300 p-2">
                            <span class="px-2 py-1 text-white bg-{{ $category->color }}-400 rounded">{{ $category->color }}</span>
                        </td>
                        <td class="border border-gray-300 p-2 text-white">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="bg-yellow-400 focus:ring-4 focus:outline-none hover:bg-yellow-500 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center">
                                    Edit
                                    <svg class="w-6 h-6ml-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 focus:ring-4 focus:outline-none hover:bg-red-600 focus:ring-red-400 font-medium rounded-lg text-sm px-3 py-1.5 text-center inline-flex items-center" onclick="return confirm('Are you sure?')">
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
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        {{ $categories->links() }}
    </div>
</x-layout-admin>