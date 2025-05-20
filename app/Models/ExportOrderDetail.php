<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportOrderDetail extends Model
{
    protected $table = 'export_order_details'; // tên bảng

    protected $fillable = [
        'id_export',    
        'id_product',           
        'quantity', 
          'price',      
        'subtotal', 
        'id_customer',     
        'created_at',
        'id_user',     
    ];

    public $timestamps = true;
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function exportOrder()
    {
        return $this->belongsTo(ExportOrder::class, 'id_export');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
