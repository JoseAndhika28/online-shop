<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    //Menampilkan halaman checkout
    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        return view('user.checkout', compact('cart'));
    }

    public static function store(Request $request)
    {
        Log::info($request->all());
        try {
            // Validate the request data
            $request->validate([
                'shipping_address' => 'required|string|max:255',
                'shipping_method' => 'required|string|max:255',
                'total_price' => 'required|numeric',
                // 'payment_method' => 'required|string|max:255',
            ]);

            // $cart = session()->get('cart', []);
            // if (empty($cart)) {
            //     return redirect()->back()->with('error', 'Your cart is empty.');
            // }

            $order = Order::create([
                'user_id' => Auth::id(),
                'book_id' => $request->input('book_id'),
                'quantity' => $request->input('quantity'),
                'shipping_address' => $request->input('shipping_address'),
                'shipping_method' => $request->input('shipping_method'),
                'total_price' => $request->input('total_price'),
                'status' => 'pending',
                // 'payment_method' => $request->input('payment_method'),
            ]);

            // foreach ($cart as $item) {
            //     OrderItem::create([
            //         'order_id' => $order->id,
            //         'book_id' => $item['book_id'],
            //         'quantity' => $item['quantity'],
            //         'total_price' => $item['total_price'],
            //     ]);
            // }

            return redirect()->route('home')->with('success', 'Order placed successfully.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while placing the order.');
        }
    }
}
