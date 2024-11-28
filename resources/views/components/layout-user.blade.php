@php
    $user = auth()->user();
@endphp

    <!DOCTYPE html>

<!-- Dashboard Container -->
<div class="flex">
    <!-- Sidenav -->
    <div class="w-64 bg-gray-900 p-6">
        <div class="flex flex-col space-y-4">
            <div class="flex justify-center mb-8">
                <div class="h-16 w-16 bg-blue-500 rounded-full"></div> <!-- Profile Picture Placeholder -->
            </div>

            <h3 class="text-xl font-semibold text-white text-center">{{ $user->name }}</h3>
            <p class="text-gray-400 text-center">{{ $user->email }}</p>

            <div class="mt-6 space-y-4">
                <a href="{{ route('dashboard.profile') }}" class="block py-2 px-4 text-white hover:bg-gray-700 rounded-md">Profile</a>
                <a href="{{ route('dashboard.jobs') }}" class="block py-2 px-4 text-white hover:bg-gray-700 rounded-md">My Jobs</a>
                <a href="{{ route('dashboard.password') }}" class="block py-2 px-4 text-white hover:bg-gray-700 rounded-md">Change Password</a>
                <a href="{{ route('dashboard.email') }}" class="block py-2 px-4 text-white hover:bg-gray-700 rounded-md">Change Email</a>
                <a href="{{ route('dashboard.deactivate') }}" class="block py-2 px-4 text-white hover:bg-gray-700 rounded-md">Deactivate Account</a>
                <a href="{{ route('dashboard.delete') }}" class="block py-2 px-4 text-white hover:bg-gray-700 rounded-md">Delete Account</a>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-white mb-6">Dashboard</h1>
        <!-- Dynamic Slot Content -->
        {{ $slot }}
    </div>

</div>

