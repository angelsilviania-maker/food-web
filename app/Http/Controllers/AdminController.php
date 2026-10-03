<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya dipatok tegas ke 'orders'
    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'table_number',
        'total_price',
        'status',
    ];

    // Relasi ke detail pesanan
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}