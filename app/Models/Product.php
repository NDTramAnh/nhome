<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'name_product',
        'category',
        'price',
        'stock_quantity',
        'create_at',
        'update_at',
        'status',
    ];
}
