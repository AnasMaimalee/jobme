@php
    $user = auth()->user();
@endphp

<x-layout>
    <div class="max-w-4xl mx-auto p-8 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-white mb-6">Welcome, {{ $user->name }}</h2>

        <!-- Navigation Menu -->
        <div class="space-y-6">
            <!-- Profile Section -->
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-4">Profile Settings</h3>
                <p class="text-gray-300 mb-4">You can update your profile, email, and logo here.</p>
{{--                <a href="{{ route('profile.edit', $user) }}" class="text-blue-500 hover:text-blue-300">Edit Profile</a>--}}
            </div>

            <!-- Change Password Section -->
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-4">Change Password</h3>
                <p class="text-gray-300 mb-4">Update your account password here.</p>
{{--                <a href="{{ route('password.edit', $user) }}" class="text-blue-500 hover:text-blue-300">Change Password</a>--}}
            </div>

            <!-- Change Email Section -->
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-4">Change Email</h3>
                <p class="text-gray-300 mb-4">Change your registered email address here.</p>
{{--                <a href="{{ route('email.edit', $user) }}" class="text-blue-500 hover:text-blue-300">Change Email</a>--}}
            </div>

            <!-- Deactivate/Delete Account Section -->
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-4">Account Deactivation or Deletion</h3>
                <p class="text-gray-300 mb-4">You can deactivate or permanently delete your account here.</p>
{{--                <a href="{{ route('account.deactivate', $user) }}" class="text-red-500 hover:text-red-300">Deactivate Account</a>--}}
{{--                <a href="{{ route('account.delete', $user) }}" class="text-red-600 hover:text-red-400 mt-2 block">Delete Account</a>--}}
            </div>
        </div>
    </div>
</x-layout>
