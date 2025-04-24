<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - KEMURI</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-poppins">

    @include('layout.header')

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm font-medium">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Admin Login</h2>
                <input id="email" name="email" type="email" placeholder="Email" required autofocus
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <input id="password" name="password" type="password" placeholder="Password" required
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
                Log in
            </button>
        </form>
    </div>

</body>
</html>
