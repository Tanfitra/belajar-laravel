<!-- Floating Button -->
<div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="{{ route('posts.store') }}" id="openModal" style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background-color: #007bff; color: white; border-radius: 50%; text-decoration: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <i class="fas fa-plus"></i>
    </a>
</div>

<!-- Modal -->
<div id="myModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-5 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 xl:w-2/5 shadow-lg rounded-md bg-white">
        <div class="flex justify-end">
            <button id="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors duration-150 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Post an Article</h2>
        
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Title
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Enter blog title"
                >
            </div>

            <div class="mb-2">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    Category (Hold Ctrl/Cmd to select multiple)
                </label>
                <select 
                    id="category" 
                    name="category[]" 
                    multiple 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                >
                    <option value="1">Web Development</option>
                    <option value="2">Mobile Development</option>
                    <option value="3">Machine Learning</option>
                    <option value="4">UI/UX Design</option>
                </select>
            </div>

            <div class="mb-4">     
                <label class="block text-sm font-medium text-gray-700 mb-2" for="file_input">Upload file</label>
                <input name="image" @error('image') is-invalid @enderror class="block pt-1.5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept="image/*">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror 
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Content
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="5" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Write your blog content here"
                ></textarea>
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                >
                    Publish Post
                </button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#openModal").click(function (event) {
            event.preventDefault();
            $("#myModal").show();
        });

        $("#closeModal").click(function () {
            $("#myModal").hide();
        });

        $(window).click(function (event) {
            if (event.target.id === "myModal") {
                $("#myModal").hide();
            }
        });
    });
</script>
