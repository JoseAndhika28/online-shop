@extends('layout.main')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Toko Jose</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>

    <body>
        <div class="">
            <div class="m-auto w-1/3 mt-20 p-5 bg-white rounded-md shadow-md">
                <h1 class="mb-5 text-center font-bold text-3xl">Masuk Akun Toko</h1>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <input type="text" name="email" id="email" placeholder="Email"
                        class="border-2 border-gray-300 rounded-md p-2 mb-4 w-full">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="border-2 border-gray-300 rounded-md p-2 mb-4 w-full">
                    <button type="submit"
                        class="bg-blue-600 text-white rounded-md p-2 w-full hover:bg-blue-400">Login</button>
                    <p class="mt-4 text-center">Belum punya akun? <a class="text-blue-600 underline hover:text-blue-400"
                            href="/register">Daftar</a></p>
                </form>
            </div>
        </div>
    </body>

    </html>
@endsection
