<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['name_product', 'category', 'price', 'stock_quanlity', 'create_at', 'update_at', 'status'];
    public $timestamps = true;
    public function exportOrderDetails()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_product');
    }
}
