@extends('layout.main')

@section('content')
    <div class="container mx-auto grid grid-cols-2 gap-4 mt-20 px-4">
        <div class="w-full">
            <div class="bg-white shadow-md rounded-lg">
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h4 class="text-xl font-semibold">Cart</h4>
                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                        onclick="submitDelete()">
                        <i class="bi bi-trash"></i> Delete selected items
                    </button>
                </div>
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="deleteForm" action="{{ route('cart.delete') }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-100 text-left">
                                    <tr>
                                        <th class="p-3">
                                            <input type="checkbox" id="select-all" class="form-checkbox">
                                        </th>
                                        <th class="p-3">Cover</th>
                                        <th class="p-3">Title</th>
                                        <th class="p-3">Quantity</th>
                                        <th class="p-3">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carts as $cart)
                                        <tr class="border-t">
                                            <td class="p-3">
                                                <input type="checkbox" name="selected_items[]" value="{{ $cart->id }}"
                                                    class="form-checkbox item-checkbox">
                                            </td>
                                            <td class="p-3">
                                                <img src="{{ asset('storage/' . $cart->book->cover_image) }}"
                                                    alt="{{ $cart->book->title }}" class="w-16 h-24 object-cover rounded">
                                            </td>
                                            <td class="p-3">{{ $cart->book->title }}</td>
                                            <td class="p-3">{{ $cart->quantity }}</td>
                                            <td class="p-3">Rp{{ number_format($cart->book->price, 0, ',', '.') }}</td>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="border-t text-center">
                                            <td colspan="6" class="p-3">No items in cart</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 h-64 rounded-lg shadow">
            <div class="mb-4">
                <h1 class="text-xl font-bold">Ringkasan Belanja</h1>
            </div>
            <h5 class="text-lg font-semibold mb-2 text-gray-600">Total Price: <span id="total-price">Rp. 0</span></h5>
            @csrf
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Checkout <i class="bi bi-cart-check"></i>
            </button>
            </form>

            {{-- <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <label for="shipping" class="block font-semibold mb-2">Shipping Method</label>
                        <select name="shipping" id="shipping"
                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                            @foreach ($shippingOptions as $key => $shippingOption)
                                <option value="{{ $key }}">
                                    {{ $shippingOption['name'] }} -
                                    Rp{{ number_format($shippingOption['cost'], 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            </div> --}}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const selectAll = document.getElementById('select-all');
            const totalElement = document.getElementById('total-price');
            // const shippingSelect = document.getElementById('shipping');

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateTotal();
            });

            function updateTotal() {
                let total = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const row = checkbox.closest('tr');
                        const quantity = parseInt(row.querySelector('td:nth-child(4)').textContent.trim());
                        const priceText = row.querySelector('td:nth-child(5)').textContent
                            .replace(/Rp\s*/, '')
                            .replace(/\./g, '');
                        const price = parseInt(priceText);

                        total += quantity * price;
                    }
                });

                // Ambil biaya pengiriman dari shipping select
                // const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
                // const shippingText = selectedOption.textContent;
                // const shippingCost = parseInt(
                //     shippingText.match(/Rp\s?([\d\.]+)/)?.[1]?.replace(/\./g, '') || 0
                // );

                // total += shippingCost;

                totalElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });

            shippingSelect.addEventListener('change', updateTotal);

            updateTotal(); // Panggil di awal
        });
    </script>
@endsection
