<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create Post</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Content Field (Trix Editor) -->
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor input="content" class="trix-content"></trix-editor>
            </div>

            <!-- Categories Field -->
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700">Categories</p>
                <select name="category[]" id="categories" multiple
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" data-color="{{ $category->color }}-300"
                            {{ isset($post) && in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Image Upload Field -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Create Post
                </button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Select categories",
            allowClear: true,
            width: '100%',
            templateResult: formatCategory,
            templateSelection: formatCategory
        });

        function formatCategory(category) {
            if (!category.id) return category.text;

            // Ambil warna dari atribut data-color
            var colorClass = $(category.element).data('color'); 
            var tailwindColors = {
                "red-300": "#fca5a5", "blue-300": "#93c5fd", "green-300": "#86efac",
                "yellow-300": "#fde047", "purple-300": "#d8b4fe", "pink-300": "#f9a8d4"
            };

            var bgColor = tailwindColors[colorClass] || "#e5e7eb";

            return $('<span style="background-color: ' + bgColor + '; color: black; padding: 4px 8px; border-radius: 4px;">' + category.text + '</span>');
        }
    });
    </script>
</x-layout>
