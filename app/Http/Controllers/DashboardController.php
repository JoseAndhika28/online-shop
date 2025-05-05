<?php

namespace App\Http\Controllers;
use App\Models\Book;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        $totalBooks = Book::count(); // jumlah buku (record)
        $totalStocks = Book::sum('stock'); // total stok

        return view('admin.dashboard', [
            'books' => $books,
            'totalBooks' => $totalBooks,
            'totalStocks' => $totalStocks,
        ]);
    }
}
