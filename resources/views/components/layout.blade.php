@php
    $user = auth()->user();
@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body class="bg-black text-white font-bold font-henken-grotest">
<div class="px-10">
    <nav class="flex justify-between items-center py-4 bg-black text-white border-b border-white/10">
        <div>
            <a href="/" class="flex">
                <div class="h-10 w-10 bg-white"></div>
                <div class="h-5 w-5 bg-blue-800"></div>
            </a>
        </div>
        <div class="space-x-5">
            <a href="/">Jobs</a>
            <a href="/salary">Salaries</a>
            <a href="/employers">Companies</a>
        </div>

        @auth

            <div class="relative flex items-center space-x-5">
                <a href="/job/create">Post Job</a>

                <!-- Profile Dropdown Button -->
                <button class="profile-dropdown-button flex items-center space-x-2 text-white">
                    <div class="h-8 w-8 bg-blue-500 rounded-full"></div> <!-- Placeholder for Profile Icon -->
                    <span>Profile</span>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-36 w-48 bg-white text-black rounded-md shadow-lg hidden" id="profile-dropdown">
                    <div class="py-2 px-4">
                        <!-- Align the content to the left -->
                        <a href="{{ route('profile.dashboard', $user) }}" class="block text-sm hover:bg-gray-100 px-4 py-2 text-left">Profile Setting</a>
                        <form method="POST" action="/logout">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-sm text-red-600 hover:bg-gray-100 px-4 py-2 text-left">Log Out</button>
                        </form>
                    </div>
                </div>

            </div>

        @endauth

        @guest
            <div class="space-x-5">
                <a href="/register">Sign Up</a>
                <a href="/login">Login</a>
            </div>
        @endguest
    </nav>

    <main class="mt-10 max-w-[986px] mx-auto">
        {{ $slot }}
    </main>
</div>

<script>
    // JavaScript for toggling the dropdown visibility
    document.querySelector('.profile-dropdown-button').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click event from bubbling up
        const dropdown = document.getElementById('profile-dropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close the dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profile-dropdown');
        const profileButton = document.querySelector('.profile-dropdown-button');
        if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
</body>
</html>
