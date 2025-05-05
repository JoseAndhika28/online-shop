<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 30px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tfoot td {
            font-weight: bold;
            border-top: 2px solid #999;
        }

        .total {
            text-align: right;
            margin-top: 30px;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Nota Pembelian</h2>

    <div class="info">
        <p><strong>Nama:</strong> {{ $order->user->name }}</p>
        <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
        <p><strong>Metode Pengiriman:</strong> {{ $order->shipping_method }}</p>
        <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($orders as $order) --}}
                <tr>
                    <td>{{ $order->book->title }}</td>
                    <td>{{ $order->quantity }}</td>
                    {{-- <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td> --}}
                </tr>
            {{-- @endforeach --}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:right;">Total</td>
                <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
