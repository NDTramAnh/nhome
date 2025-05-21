<?php

namespace App\Models;
<<<<<<< HEAD
use App\Models\Category;
=======

>>>>>>> export-order
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    // protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'name_product',
        'id_category',
        'price',
        'stock_quantity',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_cate');
    }
    
    public function importDetails()
    {
        return $this->hasMany(ImportOrdersDetail::class, 'id_product');
    }

    public function exportDetails()
    {
        return $this->hasMany(ExportOrdersDetail::class, 'id_product');
=======
     protected $fillable = ['name', 'category', 'price', 'quantity', 'status'];
    public $timestamps = true;

    public function exportOrderDetails()
    {
        return $this->hasMany(ExportOrderDetail::class, 'id_product');
>>>>>>> export-order
    }
}
