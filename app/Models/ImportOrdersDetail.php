<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrdersDetail extends Model
{
    protected $table = 'import_orders_detail';

    

    public $timestamps = false; 

    protected $fillable = [
        'id_import',
        'id_product',
        'quantity',
        'price',
    ];

   
    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'id');
    }

    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class, 'id_import', 'id_import');
    }
}
