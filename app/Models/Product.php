<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD

    protected $fillable = ['name', 'category', 'price', 'quantity', 'status'];
    public $timestamps = true;

    public function exportOrderDetails()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_product');
    }
=======

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

>>>>>>> import_crud
}

