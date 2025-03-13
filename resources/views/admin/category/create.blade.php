<x-layout-admin>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create New Category</h1>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                <select name="color" id="color" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @foreach ($colors as $color)
                        <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>
</x-layout-admin>