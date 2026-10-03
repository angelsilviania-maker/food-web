<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id', 
        'food_id', 
        'quantity', 
        'subtotal'
    ];

    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }
}