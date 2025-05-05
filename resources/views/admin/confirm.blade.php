@extends('layout.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Konfirmasi Pesanan</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm font-semibold text-gray-700 uppercase">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Pembeli</th>
                        <th class="px-4 py-3">Buku</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Metode Kirim</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->user->name }}</td>
                            {{-- <td class="px-4 py-3">
                                @foreach ($order->items as $item)
                                <div>
                                    {{ $order->book->title }} (x{{ $item->quantity }}) -
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                </div>
                                @endforeach
                            </td> --}}
                            <td class="px-4 py-3">{{ $order->book->title }}</t>
                                <td class="px-4 py-3">{{ $order->quantity }}</td>
                            <td class="px-4 py-3">{{ $order->shipping_address }}</td>
                            <td class="px-4 py-3">{{ $order->shipping_method }}</td>
                            <td class="px-4 py-3">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 capitalize">
                                <span
                                    class="inline-block px-2 py-1 text-xs rounded 
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if ($order->status === 'pending')
                                    <form action="{{ route('confirmed', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded">
                                            Tandai Terkirim
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">✓ Terkirim</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 py-4">Tidak ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
