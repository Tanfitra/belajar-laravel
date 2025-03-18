<x-layout>

    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Verify Your Email Address</h1>
        <p class="text-gray-600">We have sent an email verification link to your email address.</p>

        @if (session('message'))
            <p class="mt-4 text-green-500">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Resend Verification Email
            </button>
        </form>
    </div>
</x-layout>
