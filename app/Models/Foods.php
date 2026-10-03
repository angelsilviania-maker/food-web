<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;

    protected $table = 'foods';
    protected $fillable = ['name', 'category', 'price', 'description', 'image']; //Kolom-kolom seperti name, category, price, description, dan image diizinkan untuk diisi secara massal lewat data yang dikirimkan oleh admin melalui form input makanan di halaman web.
}