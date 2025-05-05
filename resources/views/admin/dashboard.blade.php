@extends('layout.main')

@section('content')
    <div class="max-w-7xl mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Halo, {{ Auth::user()->name }} </h1>
            <a class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" href="{{ route('book.create') }}">
                + Tambah Buku
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-sm text-gray-500">Jumlah Buku</h2>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalBooks }}</p>
            </div>
            {{-- <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-sm text-gray-500">Total Kategori</h2>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalCategories }}</p>
            </div> --}}
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-sm text-gray-500">Stok Menipis</h2>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalStocks }}</p>
            </div>
        </div>

        <!-- Tabel Buku Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Buku Terbaru</h2>
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">Cover</th>
                        <th class="px-4 py-2">Judul</th>
                        <th class="px-4 py-2">Penulis</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                                    class="w-16 h-24 object-cover">
                            </td>
                            <td class="px-4 py-2">{{ $book->title }}</td>
                            <td class="px-4 py-2">{{ $book->author }}</td>
                            <td class="px-4 py-2">{{ $book->category->name_category }}</td>
                            <td class="px-4 py-2">{{ $book->stock }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('book.edit', $book->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a  >
                                <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?');">Hapus</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
