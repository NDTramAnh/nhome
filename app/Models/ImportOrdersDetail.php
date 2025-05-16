<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrdersDetail extends Model
{
    // 
    protected $table = 'import_orders_detail';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class, 'id_import');
    }
}
