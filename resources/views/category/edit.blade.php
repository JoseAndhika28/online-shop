@extends('layout.main')

@section('content')

<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Kategori</h2>
  
    {{-- <!-- Contoh Pesan Error Dummy -->
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
      <ul class="list-disc list-inside">
        <li>Nama kategori wajib diisi</li>
        <li>Deskripsi harus minimal 10 karakter</li>
      </ul>
    </div> --}}
  
    <!-- Form -->
    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!-- Nama Kategori -->
      <div class="mb-4">
        <label for="name_category" class="block text-sm font-semibold">Nama Kategori</label>
        <input type="text" name="name_category" id="name_category" value="{{ $category->name_category }}" placeholder="Masukan Nama Kategori"
          class="w-full border border-gray-300 rounded px-4 py-2 mt-1" required>
      </div>
  
      <!-- Tombol Aksi -->
      <div class="flex items-center justify-between">
        <a href="{{ route('category.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
          Update
        </button>
      </div>
    </form>
  </div>
  
  @endsection