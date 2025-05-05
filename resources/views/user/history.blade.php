@extends('layout.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Riwayat Pesanan</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm font-semibold text-gray-700 uppercase">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Buku</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Metode Kirim</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $order->id }}</td>
                            {{-- <td class="px-4 py-3">
                                @foreach ($order->items as $item)
                                    <div>{{ $item->book->title }} (x{{ $item->quantity }})</div>
                                @endforeach
                            </td> --}}
                            <td class="px-4 py-3">{{ $order->book->title }}</td>
                            <td class="px-4 py-3">{{ $order->quantity }}</td>
                            {{-- <td class="px-4 py-3">{{ $order->shipping_address }}</td> --}}
                            {{-- <td class="px-4 py-3">{{ $order->shipping_method }}</td> --}}
                            {{-- <td class="px-4 py-3">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td> --}}
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
                                @if ($order->status === 'Terkirim')
                                    <a href="{{ route('user.downloadNota', $order->id) }}"
                                        class="text-white text-sm bg-blue-500 py-2 px-5 rounded-md hover:bg-blue-600">Download Nota</a>
                                @else
                                    <span class="text-gray-400 text-sm">Menunggu konfirmasi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
