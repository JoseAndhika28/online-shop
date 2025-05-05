@extends('layout.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">
            {{ isset($book) ? 'Edit Data Buku' : 'Tambah Data Buku' }}
        </h2>

        <form action="{{ isset($book) ? route('book.update', $book->id) : route('book.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($book))
                @method('PUT')
            @endif

            <!-- Judul Buku -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-700">Judul Buku</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $book->title ?? '') }}"
                       placeholder="Masukkan Judul Buku"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Penulis -->
            <div class="mb-4">
                <label for="author" class="block text-sm font-semibold text-gray-700">Penulis</label>
                <input type="text" name="author" id="author"
                       value="{{ old('author', $book->author ?? '') }}"
                       placeholder="Masukkan Nama Penulis"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Penerbit -->
            <div class="mb-4">
                <label for="publisher" class="block text-sm font-semibold text-gray-700">Penerbit</label>
                <input type="text" name="publisher" id="publisher"
                       value="{{ old('publisher', $book->publisher ?? '') }}"
                       placeholder="Masukkan Nama Penerbit"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Stok -->
            <div class="mb-4">
                <label for="stock" class="block text-sm font-semibold text-gray-700">Stok</label>
                <input type="number" name="stock" id="stock"
                       value="{{ old('stock', $book->stock ?? '') }}"
                       placeholder="Masukkan Stok Buku"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-semibold text-gray-700">Harga</label>
                <input type="number" name="price" id="price"
                       value="{{ old('price', $book->price ?? '') }}"
                       placeholder="Masukkan Harga Buku"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Pilih Kategori -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-semibold">Pilih Kategori</label>
                <select name="category_id" id="category_id"
                        class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Gambar Cover -->
            <div class="mb-6">
                <label for="cover_image" class="block text-sm font-semibold text-gray-700">Gambar Cover</label>
                <input type="file" name="cover_image" id="cover_image"
                       class="w-full mt-1 p-2 border border-gray-300 rounded bg-white focus:ring-2 focus:ring-blue-400">

                @if (isset($book) && $book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Buku" class="w-32 mt-2 rounded">
                @endif
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                    {{ isset($book) ? 'Update Buku' : 'Simpan Buku' }}
                </button>
            </div>
        </form>
    </div>
@endsection
