<x-layout>
    <h1 class="text-4xl font-bold mb-8">Settings</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- User Profile Settings -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">Profile Settings</h2>
        <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#187a15] focus:ring-[#187a15]">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ auth()->user()->username }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#187a15] focus:ring-[#187a15]">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#187a15] focus:ring-[#187a15]">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Picture -->
            <div class="mb-4">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                <div class="flex items-center mt-1 space-x-4">
                    <!-- Current Profile Photo -->
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-lg overflow-hidden shadow-sm border border-gray-200 relative">
                            @if (auth()->user()->profile_photo_path)
                                <img class="w-full h-full object-cover"
                                    src="{{ Storage::url(auth()->user()->profile_photo_path) }}"
                                    alt="{{ auth()->user()->name }}" />
                            @else
                                <img class="w-full h-full object-cover"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                    alt="{{ auth()->user()->name }}" />
                            @endif
                            <!-- Overlay for Upload Indicator -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-sm font-medium">Change Photo</span>
                            </div>
                        </div>
                    </div>
                    <!-- File Input -->
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden">
                    <label for="profile_photo"
                        class="cursor-pointer bg-[#187a15] text-white px-4 py-2 rounded-full hover:bg-[#135c11] transition-colors">
                        Upload New Photo
                    </label>
                </div>
                @error('profile_photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- File Info (shown after selection) -->
            <div id="file-info" class="text-sm text-gray-500 hidden">
                <span id="file-name"></span>
                <span id="file-size" class="ml-2"></span>
            </div>
            <p class="text-xs text-gray-500 mb-2">Max file size: 3MB. Supported formats: JPEG, PNG, JPG, GIF, WEBP.</p>
            <!-- Save Button -->
            <button type="submit"
                class="bg-[#187a15] text-white px-4 py-2 rounded-full hover:bg-[#135c11] transition-colors">
                Save Profile Changes
            </button>
        </form>
    </div>

    <!-- Account Security Settings -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Account Security</h2>
        <form action="{{ route('settings.password') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#187a15] focus:ring-[#187a15]">
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" id="new_password" name="new_password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#187a15] focus:ring-[#187a15]">
                @error('new_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                    Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#187a15] focus:ring-[#187a15]">
            </div>

            <!-- Save Button -->
            <button type="submit"
                class="bg-[#187a15] text-white px-4 py-2 rounded-full hover:bg-[#135c11] transition-colors">
                Update Password
            </button>
        </form>
    </div>
</x-layout>
