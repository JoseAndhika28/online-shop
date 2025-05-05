@extends('layout.main')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Kategori</h1>

    <a href="{{ route('category.create') }}"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">Tambah Kategori</a>

    <!-- Pesan Sukses Dummy -->
    {{-- <div class="bg-green-100 text-green-700 p-3 my-4 rounded">
        Kategori berhasil ditambahkan.
    </div> --}}

    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Nama Kategori</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="border border-gray-300 text-center">
                    <td class="px-4 py-2">{{ $category->name_category }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('category.edit', $category->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>                    
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection