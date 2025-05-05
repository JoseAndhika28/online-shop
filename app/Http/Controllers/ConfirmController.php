<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan sudah install package dompdf
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function index()
    {
        // Mengambil data order beserta user dan item-book relasi
        $orders = Order::with(['user', 'items.book'])->latest()->get();

        return view('admin.confirm', compact('orders'));
    }

    // Mengubah status order
    public function markAsDelivered($id)
    {
        // Mencari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Mengubah status pesanan menjadi terkirim
        $order->status = 'Terkirim';
        $order->save();

        // Mengarahkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Menampilkan halaman konfirmasi pesanan untuk user
    public function history()
    {
        $orders = Order::with(['items.book'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.history', compact('orders'));
    }

    public function downloadNota($id)
    {
        $order = Order::with(['items.book'])->where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'Terkirim') {
            abort(403, 'Nota hanya tersedia jika pesanan sudah terkirim.');
        }

        $pdf = Pdf::loadView('user.nota', compact('order'));

        return $pdf->download('nota_order_' . $order->id . '.pdf');
    }
}
