<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $primaryKey = 'id_product';
    protected $fillable = ['name_product', 'category', 'price', 'quantity', 'status'];
    public $timestamps = true;

    public function exportOrderDetails()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_product');
    }


   


    

   protected $casts = [
    'create_at' => 'datetime',
    'update_at' => 'datetime',
];


}

