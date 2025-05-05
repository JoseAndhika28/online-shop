<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $books = Book::with('category')->get();
    //     return view('admin.dashboard', [
    //         'books' => $books
    //     ]);

    //     $books = Book::with('category')->get();
    //     $totalBooks = Book::count(); // jumlah buku (record)
    //     $totalStock = Book::sum('stock'); // total stok

    //     return view('admin.dashboard', [
    //         'books' => $books,
    //         'totalBooks' => $totalBooks,
    //         'totalStock' => $totalStock,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        Book::create($data);
        return redirect()->route('dashboard')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $book = Book::findOrFail($id); // simpan ke variabel
    //     return view('book.show', compact('book')); // kirim ke view
    // }

    public function handleAction(Request $request, Book $book)
    {
        try {
            $quantity =  $request->input('quantity');
            $action = $request->input('action');
            $cart = Cart::where('user_id', Auth::id())->with('book')->where('book_id', $book->id)->first();
            Log::info($cart);

            if ($quantity < 1 || $quantity > $book->stock) {
                return back()->with('error', 'Invalid quantity');
            }

            if ($action === 'checkout') {
                if ($cart->book->stock < $quantity) {
                    return back()->with('error', 'Not enough stock');
                }
                return redirect()->route('order.detail')->with([
                    'book' => $book,
                    'quantity' => $quantity,
                ]);
            }

            if ($action === 'cart') {
                if ($cart) {
                    $cart->increment('quantity');
                } else {
                    Cart::create([
                        'user_id' => Auth::id(),
                        'book_id' => $book->id,
                        'quantity' => $quantity,
                        'total_price' => $book->price,
                    ]);
                }
                return redirect()->route('book.detail', $book->id)->with('success', 'Added to cart!');
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id); // simpan ke variabel
        $categories = Category::all();
        return view('book.edit', compact('book', 'categories')); // kirim ke view
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        $book->update($data);

        return redirect()->route('dashboard', $book->id)->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('dashboard')->with('success', 'Book deleted successfully.');
    }

    public function byCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $books = Book::where('category_id', $categoryId)->get();
        return view('admin.dashboard', compact('books', 'category'));
    }
}
