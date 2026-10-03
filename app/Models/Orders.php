<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['customer_name', 'table_number', 'total_price', 'status'];

    public function details()
{
    return $this->hasMany(OrderDetail::class, 'order_id'); //jadi mksudnya dari 1 orang yg pesen makanan tapi bisa diliat detail apa aja yg dipesen 
}
}