@extends('layout.main')

@section('content')
    <div class="max-w-7xl mx-auto p-4">
        <div class="flex justify-between">
            {{-- <h1 class="text-3xl font-bold text-black">Halo, {{ Auth::user()->name }} </h1> --}}
        </div>
    </div>

        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Daftar Buku</h1>
            <div class="">
              
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden pt-5">
                        @if ($book->cover_image)
                            <img src="{{ Storage::url($book->cover_image) }}" class="w-30 h-48 object-cover center mx-auto"
                                alt="{{ $book->title }}">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif
                        <div class="p-5">
                            <h2 class="text-lg font-bold">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($book->author, 80) }}</p>
                            <p class="text-sm text-gray-500 mb-2">Stock : {{ Str::limit($book->stock, 80) }}</p>
                            <p class="text-black-600 text-lg font-semibold mb-3">Rp
                                {{ number_format($book->price, 0, ',', '.') }}</p>
                                <div class="flex justify-center">
                                    <div class=" bg-green-500 px-20 rounded-md text-white hover:bg-green-600">
                                        <a class="font-semibold" href="{{ route('book.detail', $book) }}">Lihat detail</a>
                                    </div>
                                </div>
                            {{-- <div class="grid grid-cols-2 gap-1">
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="border border-blue-500 font-semibold text-blue-500 px-3 py-1 rounded">Beli
                                        Langsung</button>
                                </form>
                                <form action="{{ route('cart.add', $book->id) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                        Keranjang
                                    </button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

@endsection
