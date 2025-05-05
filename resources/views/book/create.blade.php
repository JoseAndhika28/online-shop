@extends('layout.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Tambah Data Buku</h2>

        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul Buku -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-700">Judul Buku</label>
                <input type="text" name="title" id="title" placeholder="Masukkan Judul Buku"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Penulis -->
            <div class="mb-4">
                <label for="author" class="block text-sm font-semibold text-gray-700">Penulis</label>
                <input type="text" name="author" id="author" placeholder="Masukkan Nama Penulis"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Penerbit -->
            <div class="mb-4">
                <label for="publisher" class="block text-sm font-semibold text-gray-700">Penerbit</label>
                <input type="text" name="publisher" id="publisher" placeholder="Masukkan Nama Penerbit""
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Stok -->
            <div class="mb-4">
                <label for="stock" class="block text-sm font-semibold text-gray-700">Stok</label>
                <input type="text" name="stock" id="stock" placeholder="Masukkan Stok Buku"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-semibold text-gray-700">Harga</label>
                <input type="text" name="price" id="price" placeholder="Masukkan Harga Buku"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-semibold">Pilih Kategori</label>
                <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded px-4 py-2 mt-1"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
@endsection
