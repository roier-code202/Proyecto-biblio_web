<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Biblioteca Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 text-gray-800">
    <div class="relative flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-100 via-white to-blue-100">
        <div class="max-w-3xl px-6 py-12 bg-white shadow-xl rounded-2xl text-center">
            <h1 class="text-4xl font-bold text-blue-800 mb-4">Bienvenido al Sistema de Biblioteca Digital</h1>
            <p class="mb-6 text-lg text-gray-600">Gestiona libros, usuarios y préstamos de forma fácil y rápida.</p>

            @auth
                <a href="{{ url('/dashboard') }}"
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Ir al Panel de Control
                </a>
            @else
                <div class="space-x-4">
                    <a href="{{ route('login') }}"
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-block bg-gray-200 text-blue-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                        Registrarse
                    </a>
                </div>
            @endauth
        </div>
    </div>
</body>
</html>
