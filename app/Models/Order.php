<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'shipping_method',
        'shipping_address',
        'total_price',
        'status'
    ];

    // Removed duplicate user method

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmation()
    {
        $orders = Order::with(['user', 'items.book'])->get();

        return view('admin.confirm', compact('orders'));
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
