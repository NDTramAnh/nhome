<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = ['name', 'category', 'price', 'quantity', 'status'];
    public $timestamps = true;

    public function exportOrderDetails()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_product');
    }
}
