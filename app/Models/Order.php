<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'name',
        'phone',
        'address',
        'city',
        'postal_code',
        'total',
        'status',
        'payment_status',
        'payment_proof',
        'payment_date',
        'notes'
    ];
    protected $casts = [
        'payment_date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        $date = date('Ymd');
        $lastOrder = self::whereDate('created_at', today())->count();
        $number = str_pad($lastOrder + 1, 4, '0', STR_PAD_LEFT);
        return 'MG-' . $date . '-' . $number;
    }
}
