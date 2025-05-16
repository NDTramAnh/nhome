<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
    }
}
