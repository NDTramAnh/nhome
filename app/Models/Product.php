<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public $timestamps = false; // Vì bạn dùng create_at & update_at custom, không phải created_at, updated_at

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}