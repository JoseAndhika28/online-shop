<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Toko Jose</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gray-100">
    <nav class="bg-white text-black p-4 py-2 shadow-md sticky top-0 z-10">
        @guest
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Toko Jose</h1>
                <ul class="flex space-x-4 items-center font-semibold">
                    <li class="border border-gray-500 p-2 rounded-xl"><a href="/login"
                            class="hover:text-gray-400">Masuk</a></li>
                    <li class="bg-blue-600 p-2 rounded-xl hover:bg-blue-400"><a href="/register" class="text-white"">Daftar</a></li>
                </ul>
            </div>
        @endguest

        @auth
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Toko Jose</h1>
                <ul class="flex space-x-4 items-center font-semibold">
                    <li>
                        <input type="text" class="border-2 border-gray-300 rounded-md p-1 w-full"
                            placeholder="Search...">
                    </li>
                    @if (auth()->user()->roles == 'admin')
                        {{-- Admin Menu --}}
                        <li><a href="{{route('dashboard')}}" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('dashboard') ? 'text-gray-800' : '' }}">Dashboard</a></li>
                        <li><a href="{{route('category.index')}}" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('category.index') ? 'text-gray-800' : '' }}">Category</a></li>
                        <li><a href="{{ route('confirm.index') }}" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('#') ? 'text-gray-800' : '' }}">Confirm</a></li>
                    @else
                        {{-- User Menu --}}
                        <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('home') ? 'text-gray-800' : '' }}">Home</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('#') ? 'text-gray-800' : '' }}">About us</a></li>
                        <li><a href="{{ route('user.history') }}" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('user.history') ? 'text-gray-800' : '' }}">History</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-400 {{ request()->routeIs('cart.index') ? 'text-gray-800' : '' }}">Keranjang</a></li>
                    @endif
                    
                    <li class="relative">   
                        <a href="{{ route('account') }}" class="flex items-center space-x-2 text-gray-700">
                            <i class="bi bi-person-circle text-3xl text-gray-400"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endauth
    </nav>

    @yield('content')
</body>

<footer class="text-black p-4 mt-10">
    <div class="container mx-auto text-center">
        <p>&copy; 2025 Toko Jose. All rights reserved.</p>
    </div>
</footer>


</html>
