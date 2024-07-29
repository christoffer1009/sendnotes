<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <nav class="mb-4 bg-white shadow">
            <div class="container px-4 mx-auto">
                <div class="flex items-center justify-between py-4">
                    <div>
                        <a href="{{ url('/') }}"
                            class="text-lg font-semibold text-gray-700">{{ config('app.name', 'Laravel') }}</a>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('notes.index') }}" class="text-gray-700 hover:text-gray-900">Todas as
                            Notas</a>
                        @auth
                            <a href="{{ route('notes.myNotes') }}" class="text-gray-700 hover:text-gray-900">Minhas
                                Notas</a>
                            <a href="{{ route('notes.create') }}" class="text-gray-700 hover:text-gray-900">Criar Nota</a>
                        @endauth
                    </div>
                    <div>
                        @auth
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            <a href="{{ route('logout') }}" class="ml-4 text-gray-700 hover:text-gray-900"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 text-gray-700 hover:text-gray-900">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="mt-4 bg-white shadow">
            <div class="container px-4 py-4 mx-auto text-center text-gray-600">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
        </footer>
    </div>
</body>

</html>
