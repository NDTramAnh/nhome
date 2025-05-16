<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportOrdersDetail extends Model
{
     protected $table = 'export_orders_details';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function exportOrder()
    {
        return $this->belongsTo(ExportOrder::class, 'id_export');
    }
}
