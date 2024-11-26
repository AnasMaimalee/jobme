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
        <nav class="flex justify-between items-center py-4 bg-black  text-white border-b border-white/10">
            <div>
                <a href="/"  class="flex">
                    <div class="h-10 w-10 bg-white">
                    </div>
                    <div class="h-5 w-5 bg-blue-800">
                    </div>
                </a>
            </div>
            <div class="space-x-5">
                <a href="/">Jobs</a>
                <a href="/salary">Salaries</a>
                <a href="/employers">Companies</a>
            </div>

            @auth

                    <div class="space-x-5 flex items-center">
                        <a href="{{ route('jobs.create') }}">Post Job</a>
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

        </nav>
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
