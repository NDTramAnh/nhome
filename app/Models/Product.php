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
        'id_category', // sử dụng đúng theo cột trong DB
        'price',
        'stock_quantity',
        'create_at',
        'update_at',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_cate');
    }

    public function importDetails()
    {
        return $this->hasMany(ImportOrdersDetail::class, 'id_product', 'id_product');
    }

    public function exportDetails()
    {
        return $this->hasMany(ExportOrdersDetail::class, 'id_product', 'id_product');
    }
}
