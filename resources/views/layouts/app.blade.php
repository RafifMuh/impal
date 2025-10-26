<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none !important;}</style>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-5xl mx-auto flex justify-between">
            <a href="{{ route('home') }}" class="font-bold text-lg">Resepin</a>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-500">Login</a>
            @endauth
        </div>
    </nav>

    <div class="max-w-5xl mx-auto">
        {{ $slot }}
    </div>

</body>
</html>
