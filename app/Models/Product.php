<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id_product', 'name_product', 'category', 'price', 'stock_quanlity', 'create_at', 'update_at', 'status'];
    public $timestamps = true;
}
