@extends('layout.main')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Pesanan</h1>

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <!-- Detail Buku -->
        <div class="flex items-center gap-4">
            <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-28 h-40 object-cover rounded shadow">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $book->title }}</h2>
                <p class="text-sm text-gray-600">Jumlah: {{ $quantity }} buku</p>
                <p class="text-sm text-gray-600">Harga per buku: Rp {{ number_format($book->price, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Form Konfirmasi -->
        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">

            <!-- Metode Pengiriman -->
            <div>
                <label for="shipping_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pengiriman</label>
                <select name="shipping_method" id="shipping_method" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="jne">JNE - Rp 20.000</option>
                    <option value="jnt">J&T - Rp 18.000</option>
                    <option value="pos">POS Indonesia - Rp 15.000</option>
                </select>
            </div>

            <!-- Alamat Pengiriman -->
            <div>
                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman</label>
                <textarea name="shipping_address" id="shipping_address" rows="3" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Rincian Harga -->
            @php
                $subtotal = $book->price * $quantity;
            @endphp

            <input type="hidden" name="total_price" value="{{ $subtotal }}" />

        <div class="bg-gray-50 rounded-lg p-4 border text-sm">
            <div class="flex justify-between mb-2">
                <span>Subtotal</span>
                <span id="subtotal_display">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Ongkir</span>
                <span id="shipping_cost_display">Rp 0</span>
            </div>
            <div class="flex justify-between font-semibold text-gray-800">
                <span>Total</span>
                <span name="total_price" value="{{ $subtotal }}" id="total_display">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
        </div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Konfirmasi Pesanan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shippingSelect = document.getElementById('shipping_method');
        const shippingCostDisplay = document.getElementById('shipping_cost_display');
        const totalDisplay = document.getElementById('total_display');
        const subtotal = {{ $subtotal }};

        function updateTotal() {
            let selected = shippingSelect.value;
            let shippingCost = 0;

            if (selected === 'jne') shippingCost = 20000;
            else if (selected === 'jnt') shippingCost = 18000;
            else if (selected === 'pos') shippingCost = 15000;

            let total = subtotal + shippingCost;

            shippingCostDisplay.textContent = 'Rp ' + shippingCost.toLocaleString('id-ID');
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        shippingSelect.addEventListener('change', updateTotal);

        // Jalankan pertama kali
        updateTotal();
    });
</script>

@endsection
