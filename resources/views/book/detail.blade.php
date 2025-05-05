@extends('layout.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <a href="{{ route('home') }}"
            class="inline-block mb-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden md:flex">
            <!-- Gambar Buku -->
            <div class="flex-shrink-0 flex items-center justify-center  p-4 bg-gray-100">
                <img src="{{ Storage::url($book->cover_image) }}" class="w-30 h-48 object-cover rounded shadow"
                    alt="{{ $book->title }}">
            </div>

            <!-- Detail Buku -->
            <div class="p-6 md:w-2/3">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h2>
                        <p class="text-sm text-gray-600 mb-2"> {{ $book->author }} | {{ $book->category->name_category }}
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <p class="text-sm text-gray-600">Stock</p>
                        <p class="font-medium">{{ $book->stock }} Buku</p>
                    </div>
                    <div class="mt-5">
                        <p class="font-medium text-2xl">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <form action="{{ route('book.action', $book->id) }}" method="POST" class="flex flex-col gap-4">
                            @csrf

                            <div class="w-full mt-2">
                                <label for="quantity" class="block text-lg font-semibold text-gray-800">Quantity :</label>
                                <input type="number" id="quantity" name="quantity" max="{{ $book->stock }}"
                                    min="1" required
                                    class="mt-1 w-80 rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="flex gap-4 mt-2">
                                <button type="submit" name="action" value="checkout"
                                    class="border border-green-500 text-green-500 font-bold px-6 py-2 rounded">
                                    Checkout
                                </button>

                                <button type="submit" name="action" value="cart"
                                    class="background bg-green-500 text-white px-6 py-2 rounded font-bold hover:bg-green-400">+Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- @auth
            @if (auth()->user()->role === 'pembeli')
            <form action="{{ route('order.action', $book->id) }}" method="POST" class="flex flex-col gap-4">
              @csrf
          
              <div class="w-full md:w-1/2">
                  <label for="quantity" class="block text-lg font-semibold text-gray-800">Quantity :</label>
                  <input 
                      type="number" 
                      id="quantity" 
                      name="quantity" 
                      max="{{ $book->stock }}" 
                      min="1" 
                      required
                      class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  >
              </div>
          
              <div class="flex gap-4 mt-2">
                  <button 
                      type="submit" 
                      name="action" 
                      value="checkout" 
                      class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition duration-200"
                  >
                      Checkout
                  </button>
                  <button 
                      type="submit" 
                      name="action" 
                      value="cart" 
                      class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200"
                  >
                      Add to Cart
                  </button>
              </div>
          </form>                  
            @endif
        @else
            <div class="mt-8">
                <a href="{{ route('login') }}" 
                    class="block text-center bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">
                    Login untuk pesan
                </a>
            </div>
        @endauth --}}
            </div>
        </div>
    </div>
@endsection
