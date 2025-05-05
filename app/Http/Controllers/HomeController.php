<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('user.home', compact('books'));
    }

    public function orderDetail(Request $request)
    {
        try {
            $cart = Cart::where('id', $request->cart_id)
                ->where('user_id', Auth::id())
                ->with('book')
                ->first();

            if (!$cart) {
                return redirect()->route('home')->with('error', 'Cart tidak ditemukan.');
            }

            return view('order.detail', [
                'quantity' => $request->input('quantity'),
                'book' => $cart->book
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    public function account()
    {
        return view('user.account');
    }

    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('book.detail', compact('book'));
    }

    public function handleAction(Request $request, Book $book)
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
            }

            $quantity = $request->input('quantity');
            $action = $request->input('action');

            if ($quantity < 1 || $quantity > $book->stock) {
                return back()->with('error', 'Jumlah tidak valid.');
            }

            // Cek apakah user sudah punya cart untuk buku ini
            $cart = Cart::where('user_id', Auth::id())
                        ->where('book_id', $book->id)
                        ->with('book')
                        ->first();

            if ($action === 'checkout') {
                if (!$cart) {
                    // Jika belum ada cart, buat dulu
                    $cart = Cart::create([
                        'user_id' => Auth::id(),
                        'book_id' => $book->id,
                        'quantity' => $quantity,
                        'total_price' => $quantity * $book->price
                    ]);
                } else {
                    // Update cart yang ada
                    $cart->quantity = $quantity;
                    $cart->total_price = $quantity * $book->price;
                    $cart->save();
                }

                return redirect()->route('order.detail', [
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                ])->with('success', 'Lanjut ke checkout!');
            }

            if ($action === 'cart') {
                if ($cart) {
                    $cart->quantity += $quantity;
                    $cart->total_price += $quantity * $book->price;
                    $cart->save();
                } else {
                    Cart::create([
                        'user_id' => Auth::id(),
                        'book_id' => $book->id,
                        'quantity' => $quantity,
                        'total_price' => $quantity * $book->price
                    ]);
                }

                return redirect()->route('book.detail', $book->id)->with('success', 'Berhasil ditambahkan ke keranjang.');
            }

            return back()->with('error', 'Aksi tidak dikenal.');
        } catch (\Throwable $th) {
            Log::error('Error di handleAction HomeController: ' . $th->getMessage());
            return back()->with('error', 'Terjadi kesalahan.');
        }
    }
}
