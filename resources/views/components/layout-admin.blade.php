@php
    $employer = auth()->user()->employer;  // Lazy load the employer relationship
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: You can add custom styles here */
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<!-- Sidebar and Main Layout -->
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-gray-800 text-white h-screen p-6  border-e transition-all duration-300 ease-in-out">
        <h3 class="text-2xl font-semibold text-center mb-8">Admin Panel</h3>
        <ul>
            <li class="mb-4"><a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-700 px-4 py-2 rounded block">Dashboard</a></li>
            <li class="mb-4"><a href="{{ route('admin.users') }}" class="hover:bg-gray-700 px-4 py-2 rounded block">Users</a></li>
            <li class="mb-4"><a href="{{ route('admin.jobs') }}" class="hover:bg-gray-700 px-4 py-2 rounded block">Jobs</a></li>
            <li class="mb-4"><a href="{{ route('admin.employers') }}" class="hover:bg-gray-700 px-4 py-2 rounded block">Employers</a></li>
            <li class="mb-4"><a href="#" class="hover:bg-gray-700 px-4 py-2 rounded block">Reports</a></li>
            <li class="mb-4"><a href="#" class="hover:bg-gray-700 px-4 py-2 rounded block">Settings</a></li>
            @auth

                <div class="space-x-5 flex items-center">
                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')
                        <x-forms.button-danger >Log Out</x-forms.button-danger>
                    </form>
                </div>

            @endauth

            @guest
                <div class="space-x-5">
                    <a href="/register">Sign Up</a>
                    <a href="/login">Login</a>
                </div>
            @endguest
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Header with Logo and User Name -->
        <div class="flex justify-between items-center mb-8 bg-gray-800 p-2">
            <!-- Logo (Replace with your own logo) -->
            <div class="flex items-center">
                <span class="text-2xl font-semibold text-gray-100">Admin Panel</span>
            </div>

            <!-- User Information -->
            <div class="flex items-center">
                <span class="text-lg font-semibold text-gray-100 mr-4">Hello, {{ auth()->user()->name }}</span>
                <!-- Check if employer and logo exist -->
                @if ($employer && $employer->logo)
                    <img src="{{ URL::asset('storage/lsGu87aD1OedWbLnpZPYtAmLQCLvOlWlievbKyaz.png') }}" alt="User Avatar" class="w-10 h-10 rounded-full">
                @else
                    <img src="{{ URL::asset('storage/lsGu87aD1OedWbLnpZPYtAmLQCLvOlWlievbKyaz.png') }}" alt="Default Avatar" class="w-10 h-10 rounded-full">
                @endif
            </div>

            <!-- Toggle Sidebar Button (Hamburger Icon) -->
            <button id="toggle-sidebar" class="lg:hidden text-gray-100 p-2 rounded hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Main Content Slot -->
        <div class="m-10">
            {{ $slot }}
        </div>
    </div>

</div>

<!-- JavaScript to Toggle Sidebar -->
<script>
    document.getElementById('toggle-sidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('w-16');  // Toggle between collapsed and expanded width
    });
</script>

</body>
</html>
