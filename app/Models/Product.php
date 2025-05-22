<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps = true; // Nếu bạn dùng $table->timestamps()


    protected $primaryKey = 'id_product';

    protected $fillable = [
        'name_product',
        'category',
        'stock_quantity',
        'price',
        'status',
        'user_id',
       'create_at',
        'update_at',
    ];

   protected $casts = [
    'create_at' => 'datetime',
    'update_at' => 'datetime',
];

}

