<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hospital' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
<div class="flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow w-96">
        <h1 class="text-2xl font-bold mb-4">Login</h1>

        @if($errors->any())
            <div class="text-red-500 mb-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">
                Login
            </button>
        </form>
    </div>
</div>

@vite('resources/js/app.js')
</body>

</html>
